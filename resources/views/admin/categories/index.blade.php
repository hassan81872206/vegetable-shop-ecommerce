@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h2>Create Categorie</h2>
            <a href="{{route('categories.create')}}"><button type="button" class="btn btn-primary">Create</button></a><br><br>
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                @php
                    $count = 1 
                @endphp
                @forelse ($categories as $categorie)
                    <tr meta-data = "tr-{{$categorie->categorieID}}">
                        <td>{{$count}}</td>
                        <td>{{$categorie->categorieName}}</td>
                        <td>{{ \Carbon\Carbon::parse($categorie->created_at)->toFormattedDateString() }}</td>                       
                        <td>
                            <a href="{{ route("categories.edit" , $categorie->categorieID) }}"><button type="button" class="btn btn-warning">Edit</button></a>
                            <button onclick="deleteCategorie({{$categorie->categorieID}})" type="button" class="btn btn-danger">Delete</button>
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
                        <td>Empty</td>
                    </tr>
                @endforelse
            </table>
            {{$categories->links()}}
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
    function deleteCategorie(categorieID){
        const myHeaders = new Headers();
        myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

        const requestOptions = {
        method: "DELETE",
        headers: myHeaders,
        // redirect: "follow"
        };

        fetch(`/categories/${categorieID}`, requestOptions)
        .then((response) => response.json())
        .then((result) => getData(result , categorieID))
        .catch((error) => console.error(error));
    }
    function getData(result , categorieID){
        if(result.deleted){
            let row = document.querySelector(`tr[meta-data="tr-${categorieID}"]`);
            row.remove();
        }
    }
</script>