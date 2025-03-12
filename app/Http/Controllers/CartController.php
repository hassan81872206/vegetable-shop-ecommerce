<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class CartController extends Controller
{
    public function addToCart(Product $product){
        if(Auth::check()){
            $session_id = Auth::user()->userID;

            Cart::session($session_id)->add([
                'id' => $product->productID, 
                'name' => $product->productName,
                'price' => $product->price, 
                'quantity' => 1, 
                'attributes' => [
                    'image' => $product->image
                ]
            ]);

            return response()->json(["Added" => "Added Successfuly"]);
        }else{
            return response()->json(["notLogin" => "Please login or register"]);
        } 
    }

    public function cartPage(){
        if(Auth::check()){
            $session_id = Auth::user()->userID;
            $cart = Cart::session($session_id)->getContent();
            return view("cart" , ["cart" => $cart]);
        }
    }

    public function deleteCart($cartID){
        $session_id = Auth::user()->userID;
        if (!Cart::session($session_id)->get($cartID)) {
            return response()->json(["error" => "error"]);
        }
        Cart::session($session_id)->remove($cartID);
        return response()->json(["delete" => "Delete Successfuly"]);        
    }
}
