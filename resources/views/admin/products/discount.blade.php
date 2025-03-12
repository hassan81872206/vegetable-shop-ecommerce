@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h2>Add Discount</h2>
            <form action="{{route('products.addDiscount' , $product->productID)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Discount Percentage</label>
                    @error('discountPourcentage')
                        <span id="error" style="color: red">{{$message}}</span>
                    @enderror
                    <input value="{{old('discountPourcentage')}}" type="number" step="1" name="discountPourcentage" class="form-control" id="categorie" aria-describedby="emailHelp">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Start Date</label>
                    @error('startDate')
                        <span id="error" style="color: red">{{$message}}</span>
                    @enderror
                    <input value="{{old('startDate')}}" type="date" name="startDate" class="form-control" id="categorie" aria-describedby="emailHelp">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">End Date</label>
                    @error('endDate')
                        <span id="error" style="color: red">{{$message}}</span>
                    @enderror
                    <input value="{{old('endDate')}}" type="date" name="endDate" class="form-control" id="categorie" aria-describedby="emailHelp">
                </div> 
                <button type="submit" class="btn btn-primary">Add</button>
            </form>    
        </div>
    </div>
@endsection