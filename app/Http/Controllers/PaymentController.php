<?php

namespace App\Http\Controllers;

use App\Models\Inventorie;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItems;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function processPayment(Request $request)
    {
        try {
            foreach(Cart::session(Auth::user()->userID)->getContent() as $item){
                $inventorieID = Product::where("productID", $item->id)->value("inventoryID");
                $inventorie = Inventorie::find($inventorieID);
                if (!$inventorie || $inventorie->quantite < $item->quantity) {
                    return back()->with('error', "Quantity demanded for '{$item->name}' exceeds current inventory");
                }
            }
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Charge::create([
                'amount' => session('price') * 100, // تحويل المبلغ إلى سنت (100 = 1$)
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for Order',
            ]);
            $order = Order::create([
                'customerID' => Auth::user()->userID,
                'totalAmount' => session('price'),
            ]);

            foreach (Cart::session(Auth::user()->userID)->getContent() as $item) {
                OrderItems::create([
                    'orderID' => $order->orderID,
                    'productID' => $item->id,
                    'quantite' => $item->quantity,
                    'price' => $item->price,
                ]);
                $inventorieID = Product::where("productID", $item->id)->value("inventoryID");
                $inventorie = Inventorie::find($inventorieID);
                $inventorie->update([
                    "quantite" => $inventorie->quantite - $item->quantity 
                ]);
            }
            Cart::session(Auth::user()->userID)->clear();
            return back()->with('success', 'Payment successful!');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function savSession($price )
    {
        session(['price' => $price]);
        return response()->json(['success' => $price]);
    } 

    public function saveSession($price , $quantite , Product $product)
    {
        $session_id = Auth::user()->userID;
        Cart::session($session_id)->update($product->productID, [
            'quantity' => [
                'relative' => false, // إذا كان true يتم إضافة الكمية الحالية إلى الكمية الجديدة
                'value' => $quantite, // الكمية الجديدة
            ],
        ]);
        session(['price' => $price]);
        return response()->json(['success' => $price]);
    }   
}
