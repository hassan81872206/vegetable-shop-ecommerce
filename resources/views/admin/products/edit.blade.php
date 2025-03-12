@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <form action="{{route('products.update' , $product->productID)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="inventoryID" value="{{$product->inventory->inventoryID}}" id="">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Product Name</label>
                    @error('productName')
                        <span id="error" style="color: red">{{$message}}</span>
                    @enderror
                    <input value="{{old('productName' , $product->productName)}}" type="text" name="productName" class="form-control" id="categorie" aria-describedby="emailHelp">
                </div>  
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Price</label>
                    @error('price')
                        <span id="error2" style="color: red">{{$message}}</span>
                    @enderror
                    <input step="0.1" value="{{old('price' , $product->price)}}" type="number" name="price" class="form-control" id="price" aria-describedby="emailHelp">
                </div>   
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Quantite</label>
                    @error('quantite')
                        <span id="error2" style="color: red">{{$message}}</span>
                    @enderror
                    <input step="10" value="{{old('quantite' , $product->inventory->quantite)}}" type="number" name="quantite" class="form-control" id="price" aria-describedby="emailHelp">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Image</label>
                    @error('image')
                        <span id="error2" style="color: red">{{$message}}</span>
                    @enderror
                    <input type="file" name="image" class="form-control" id="price" aria-describedby="emailHelp">
                    <img width="300px" height="300px" src="{{asset('storage/images/'.$product->image)}}" alt="">   
                </div> 
                {{-- <br><br> --}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Categorie</label>
                    @error('categorieID')
                        <span id="error3" style="color: red">{{$message}}</span>
                    @enderror
                    <select id="categorieID" name="categorieID" class="form-select" aria-label="Default select example">
                        @forelse ($categories as $categorie)
                            @if ($categorie->categorieID == $product->categorieID)
                                <option selected value="{{$categorie->categorieID}}">{{$categorie->categorieName}}</option>
                            @else
                                <option value="{{$categorie->categorieID}}">{{$categorie->categorieName}}</option>
                            @endif
                            @empty
                            <option value="none">None</option>
                        @endforelse
                    </select>
                </div>   
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Description</label><br>
                    @error('description')
                        <span id="error" style="color: red">{{$message}}</span><br>
                    @enderror
                    <textarea name="description" id="" cols="70" rows="10">{{$product->description}}</textarea>
                </div>  
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{route('products.index')}}"><button type="button" class="btn btn-primary">Back</button></a>  
            </form>
            <br><br>
            <div style="display:none" id="success" class="alert alert-primary" role="alert">
            
            </div>
        </div>
    </div>
@endsection