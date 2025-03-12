<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\User;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class MainController extends Controller
{
    public function welcome(){
        $categories = Categorie::orderBy('created_at', 'desc')->take(4)->get();
        $products = Product::all();
        $topProducts = OrderItems::selectRaw('COUNT(productID) as total_sales, productID')
        ->groupBy('productID')
        ->limit(6)
        ->get();
        $productsID = [] ;
        foreach($topProducts as $topProduct){
            $productsID [] = $topProduct->productID;
        }
        $productsTop = [] ;
        foreach($productsID as $productID){
            $pst = Product::find($productID);
            $productsTop[] = $pst ;
        }
        $feedbacks = Feedback::all();
        // return $productsTop ;
        return view("welcome" , ['categories' => $categories , "products" => $products , "productsTop" => $productsTop , "feedbacks" => $feedbacks]);
    }

    public function shop(){
        $categories = Categorie::paginate(5, ['*'], 'categories_page');
        $products = Product::paginate(9, ['*'], 'products_page');
        $allCategories = Categorie::all();
        $countCategorieID = [];
        foreach($allCategories as $allCategorie){
            $count = Product::where("categorieID" , $allCategorie->categorieID)->count();
            $countCategorieID[] = [$count , $allCategorie->categorieID];
        }
        if(Auth::check()){
            $addedCart = Cart::session(Auth::user()->userID)->getContent();
        }else{
            $addedCart = [];
        }
        // return $countCategorieID ;
        return view("shop" , ["products" => $products , "categories" => $categories , "countCategorieID" => $countCategorieID , "contentCart" => $addedCart]);
    }

    public function shopPage(Categorie $categorie){
        $categories = Categorie::paginate(5, ['*'], 'categories_page');
        $products = Product::where("categorieID" , $categorie->categorieID)->paginate(9, ['*'], 'products_page');
        $allCategories = Categorie::all();
        $countCategorieID = [];
        foreach($allCategories as $allCategorie){
            $count = Product::where("categorieID" , $allCategorie->categorieID)->count();
            $countCategorieID[] = [$count , $allCategorie->categorieID];
        }
        if(Auth::check()){
            $addedCart = Cart::session(Auth::user()->userID)->getContent();
        }else{
            $addedCart = [];
        }
        return view("shop" , ["products" => $products , "categories" => $categories , "countCategorieID" => $countCategorieID , "contentCart" => $addedCart]);
    }

    public function search(Request $request){

        $results = Product::search($request->search)->get();
        if(Auth::check()){
            $addedCart = Cart::session(Auth::user()->userID)->getContent();
        }else{
            $addedCart = [];
        }
        return response()->json(["search" => $results , "carts" => $addedCart]);

    }

    public function shopDetails(Product $product){
        $products = Product::where('categorieID' , $product->categorieID)->get();
        return view("shopDetails" , ["product" => $product , "products" => $products]);
    }

    public function feedback(Request $request , User $user , Product $product){
        // return response()->json(["error" , $request->feedback]);
        if(Auth::user()->userID != $user->userID){
            return response()->json(["error" => "error"]);
        }
        Feedback::create([
            "comment" => $request->feedback ,
            'customerID' => $user->userID ,
            'productID' => $product->productID
        ]);
        return response()->json(["success" => "This Feedback sent successfuly"]);
    }


}
