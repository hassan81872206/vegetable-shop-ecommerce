@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <form style="display: inline" action="{{route('categories.update' , $categorie->categorieID)}}" method="POST">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Categorie Name</label>
                    @error('categorieName')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                    <input type="text"  value="{{ old('categorieName', $categorie->categorieName) }}" name="categorieName" class="form-control" id="categorie" aria-describedby="emailHelp">
                </div>    
                <button type="submit" class="btn btn-primary">Update</button>    
            </form>
            <a href="{{route('categories.index')}}"><button type="button" class="btn btn-primary">Back</button></a>
            <br><br>
            <div style="display:none" id="success" class="alert alert-primary" role="alert">
            
            </div>
        </div>
    </div>
@endsection