@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h2>{{$product->productName}}</h2>
                <table style="width: 100%" class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantite</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>image</th>
                        <th>Created At</th>
                    </tr>
                    <tr>
                        <td>{{$product->productID}}</td>
                        <td>{{$product->productName}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->inventory->quantite}}</td>
                        <td>{{$product->categorie->categorieName}}</td>
                        <td>{{$product->supplier->supplierName}}</td>
                        <td><img src="{{asset('storage/images/'.$product->image)}}" alt=""></td>
                        <td>{{ \Carbon\Carbon::parse($product->created_at)->toFormattedDateString() }}</td>                       
                    </tr>
            </table>
        </div>
    </div>
    
@endsection
