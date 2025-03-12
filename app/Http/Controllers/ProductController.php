<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Categorie;
use App\Models\Inventorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductSupplier;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view("admin.products.index" , ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view("admin.products.create" , ["categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'productName' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:2', 'max:30'],
            'price' => ['required','numeric'],
            'quantite' => ['required','numeric'],
            'categorieID' => ['required' , 'numeric' , 'exists:categories,categorieID'],
            'supplierName' => ['required' , 'regex:/^[a-zA-Z\s]+$/', 'min:2', 'max:30'],
            "phone" => ["required" , "digits:8"],
            "image" => ["required"  , 'image' , 'mimes:jpg,jpeg,png,gif' , 'max:1048'],
            "description" => ["required" , 'min:1']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ]);
        }

        $data = $validator->validated();
        $supplier = Supplier::where("phone" , $data['phone'])->first();
        if(!$supplier){
            // return response()->json(["error" => "ff"]);
            $supplierData = [
                'supplierName' => $data['supplierName'],
                'phone' => $data['phone']
            ];
            $supplier = Supplier::create($supplierData);
        }
        // $inventory = Inventorie::where("quantite" , $data["quantite"])->first();
        // if(!$inventory){
            $inventoryData = [
                'quantite' => $data["quantite"]
            ];
            $inventory = Inventorie::create($inventoryData);
        // }
        $stringRandom = Str::random(13);
        $imageName = "IMG_".$stringRandom.".".$data["image"]->extension();
        $data["image"]->storeAs("images" , $imageName);
        $productData = [
            'productName' => $data['productName'],
            'price' => $data['price'],
            'categorieID' => $data['categorieID'],
            'supplierID' => $supplier->supplierID,
            'inventoryID' => $inventory->inventoryID,
            'image' => $imageName ,
            'description' => $data["description"]
        ];
        Product::create($productData);
        return response()->json(["success" => "Added Successfuly"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("admin.products.show" , ["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Categorie::all();
        return view("admin.products.edit" , ["product" => $product , "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $fields = $request->validate([
            'productName' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:2', 'max:30'],
            'price' => ['required','numeric'],
            'quantite' => ['required','numeric'],
            'inventoryID' => ["required" , 'numeric' , 'exists:inventories,inventoryID'],
            "image" => ['image' , 'mimes:jpg,jpeg,png,gif' , 'max:1048'],
            'categorieID' => ['required' , 'numeric' , 'exists:categories,categorieID'],
            'description' => ['required']
        ]);
        $inventory = Inventorie::find($fields["inventoryID"]);
        $inventory->update([
            "quantite" => $fields["quantite"]
        ]);
        if(!isset($fields['image'])){
            $product->update([
                "productName" => $fields['productName'],
                "price" => $fields['price'] ,
                'categorieID' => $fields["categorieID"],
                'description' => $fields["description"]
            ]);
        }else{
            $stringRandom = STR::random(13);
            $imageName = "IMG_".$product->productID."_".$stringRandom.".".$fields["image"]->extension();
            $fields["image"]->storeAs("images" , $imageName);
            $product->update([
                "productName" => $fields['productName'],
                "price" => $fields['price'] ,
                'categorieID' => $fields["categorieID"],
                'description' => $fields['description'],
                'image' => $imageName
            ]);
        }
        return to_route("products.index")->with("success" , "Updated Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(["deleted" => "Delete Successfuly"]);
    }

    public function addDiscountPage(Product $product){
        return view("admin.products.discount" , ["product" => $product]);
    }

    public function addDiscount(Product $product , Request $request){
        $fields = $request->validate([
            "discountPourcentage" => ["required" , 'numeric' , 'max:90'],
            "startDate" => ["required" , "after_or_equal:today"] ,
            "endDate" => ["required" , "after:startDate"]
        ]);
        
        $promotion = Promotion::create($fields);
        $product->update([
            "promotionID" => $promotion->promotionID 
        ]);
        return to_route("products.index")->with("success" , 'Added Discount Successfuly');
    }
}
