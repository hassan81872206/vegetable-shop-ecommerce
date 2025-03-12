@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h2>Create Product</h2>
            <a href="{{route('products.create')}}"><button type="button" class="btn btn-primary">Create</button></a><br><br>
            {{-- <div class="container"> --}}
                <table style="width: 100%" class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        {{-- <th>Price</th> --}}
                        {{-- <th>Quantite</th> --}}
                        {{-- <th>Category</th> --}}
                        {{-- <th>Supplier</th> --}}
                        {{-- <th>Created At</th> --}}
                        <th>Actions</th>
                    </tr>
                    @php
                        $count = 1 
                    @endphp
                    @forelse ($products as $product)
                        <tr meta-data = "tr-{{$product->productID}}">
                            <td>{{$count}}</td>
                            <td>{{$product->productName}}</td>
                            {{-- <td>{{$product->price}}</td>
                            <td>{{$product->inventory->quantite}}</td>
                            <td>{{$product->categorie->categorieName}}</td>
                            <td>{{$product->supplier->supplierName}}</td>
                            <td>{{ \Carbon\Carbon::parse($product->created_at)->toFormattedDateString() }}</td>                        --}}
                            <td>
                                <a href="{{route('products.show' , $product->productID)}}"><button type="button" class="btn btn-info">Show Details</button></a>
                                <a href="{{ route("products.edit" , $product->productID) }}"><button type="button" class="btn btn-warning">Edit</button></a>
                                <button onclick="deleteProduct({{$product->productID}})" type="button" class="btn btn-danger">Delete</button>
                                <a href="{{route('products.addDiscount' , $product->productID)}}"><button type="button" class="btn btn-success">Add Discount</button></a>
                            </td>
                        </tr>
                        @php
                            $count++ 
                        @endphp
                    @empty
                        <tr>
                            <td>Empty</td>
                            <td>Empty</td>
                            <td>Empty</td>
                        </tr>
                    @endforelse
                </table>
            {{-- </div> --}}
            {{$products->links()}}
            <br><br><br><br>
            @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{session('success')}}
                </div>
            @endif
        </div>
    </div>
    
@endsection
<script>
    function deleteProduct(productID){
        const myHeaders = new Headers();
        myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

        const requestOptions = {
        method: "DELETE",
        headers: myHeaders,
        // redirect: "follow"
        };

        fetch(`/products/${productID}`, requestOptions)
        .then((response) => response.json())
        .then((result) => getData(result , productID))
        .catch((error) => console.error(error));
    }
    function getData(result , productID){
        if(result.deleted){
            let row = document.querySelector(`tr[meta-data="tr-${productID}"]`);
            row.remove();
        }
    }
</script>