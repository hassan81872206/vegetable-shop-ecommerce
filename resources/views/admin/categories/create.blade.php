@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Categorie Name</label>
                <span id="error" style="color: red"></span>
                <input type="text" name="categorieName" class="form-control" id="categorie" aria-describedby="emailHelp">
            </div>    
            <button type="button" onclick="addCategorie()" class="btn btn-primary">Submit</button>
            <a href="{{route('categories.index')}}"><button type="button" class="btn btn-primary">Back</button></a>
            <br><br>
            <div style="display:none" id="success" class="alert alert-primary" role="alert">
            
            </div>
        </div>
    </div>
    <script>
        function addCategorie(){
            let categorieName = document.getElementById('categorie');
            const myHeaders = new Headers();
            myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

            const urlencoded = new URLSearchParams();
            urlencoded.append('categorieName' , categorieName.value);

            const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: urlencoded,
            // redirect: "follow"
            };

            fetch("/categories", requestOptions)
            .then((response) => response.json())
            .then((result) => getAddCategorie(result , categorieName))
            .catch((error) => console.error(error));
        }
        function getAddCategorie(result , categorieName){
            // console.log(result.errors.categorieName[0]);
            if(result.errors){
                let error = document.getElementById('error');
                success.style.display = "none";
                success.innerHTML = ""
                error.innerHTML = result.errors.categorieName[0];
            }else{
                let success = document.getElementById('success');
                error.innerHTML = "" ;
                success.style.display = "block";
                success.innerHTML = result.success ;
                categorieName.value = "" ;
            }
        }
    </script>
@endsection