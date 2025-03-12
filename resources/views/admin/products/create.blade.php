@extends('admin.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Name</label>
                <span id="error" style="color: red"></span>
                <input type="text" name="categorieName" class="form-control" id="categorie" aria-describedby="emailHelp">
            </div>  
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Price</label>
                <span id="error2" style="color: red"></span>
                <input step="0.1" type="number" name="categorieName" class="form-control" id="price" aria-describedby="emailHelp">
            </div> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Quantite</label>
                <span id="error6" style="color: red"></span>
                <input step="10" type="number" name="categorieName" class="form-control" id="quantite" aria-describedby="emailHelp">
            </div>   
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Categorie</label>
                <span id="error3" style="color: red"></span>
                <select id="categorieID" class="form-select" aria-label="Default select example">
                    @forelse ($categories as $categorie)
                        <option value="{{$categorie->categorieID}}">{{$categorie->categorieName}}</option>
                    @empty
                        <option value="none">None</option>
                    @endforelse
                </select>
            </div>  
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Supplier Name</label>
                <span id="error4" style="color: red"></span>
                <input type="text" name="categorieName" class="form-control" id="supplierName" aria-describedby="emailHelp">
            </div>  
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Supplier Phone</label>
                <span id="error5" style="color: red"></span>
                <input type="tel" name="categorieName" class="form-control" id="phone" aria-describedby="emailHelp">
            </div> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Image</label>
                <span id="error7" style="color: red"></span>
                <input type="file" name="categorieName" class="form-control" id="file" aria-describedby="emailHelp">
            </div> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Description</label><br>
                <span id="error8" style="color: red"></span><br>
                <textarea name="" id="description" rows="10" cols="70"></textarea>
            </div> 
            <button type="button" onclick="addProduct()" class="btn btn-primary">Submit</button>
            <a href="{{route('products.index')}}"><button type="button" class="btn btn-primary">Back</button></a>
            <br><br>
            <div style="display:none" id="success" class="alert alert-primary" role="alert">
            
            </div>
        </div>
    </div>
    <script>
        function addProduct(){
            let productName = document.getElementById('categorie');
            let price = document.getElementById('price');
            let quantite = document.getElementById('quantite');
            let categorieID = document.getElementById('categorieID');
            let supplierName = document.getElementById('supplierName');
            let phone = document.getElementById('phone');
            let description = document.getElementById('description');
            let image = document.getElementById('file').files[0];

            const myHeaders = new Headers();
            myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");

            const formData = new FormData(); 
            formData.append('productName', productName.value);
            formData.append('price', price.value);
            formData.append('quantite', quantite.value);
            formData.append('categorieID', categorieID.value);
            formData.append('supplierName', supplierName.value);
            formData.append('phone', phone.value);
            formData.append('image', image)
            formData.append('description', description.value)

            const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: formData,
            // redirect: "follow"
            };

            fetch("/products", requestOptions)
            .then((response) => response.json())
            .then((result) =>  getAddProduct(result , productName , price , quantite , categorieID , supplierName , phone , image , description) )
            .catch((error) => console.error(error));
        }
        // getAddProduct(result , productName , price ,categorieID , supplierName , phone)
        function getAddProduct(result , productName , price , quantite , categorieID , supplierName , phone , image , description){
            // console.log(result.errors.categorieName[0]);
            if(result.errors){
                let error = document.getElementById('error');
                let error2 = document.getElementById('error2');
                let error3 = document.getElementById('error3'); 
                let error4 = document.getElementById('error4'); 
                let error5 = document.getElementById('error5'); 
                let error6 = document.getElementById('error6'); 
                let error7 = document.getElementById('error7'); 
                let error8 = document.getElementById('error8'); 
                success.style.display = "none";
                success.innerHTML = "";
                if(result.errors.productName){
                    error.innerHTML = result.errors.productName[0];
                }else{
                    error.innerHTML = "" ;
                }
                if(result.errors.price){
                    error2.innerHTML = result.errors.price[0];
                }else{
                    error2.innerHTML = "" ;
                }
                if(result.errors.categorieID){
                    error3.innerHTML = result.errors.categorieID[0];
                }else{
                    error3.innerHTML = "" ;
                }
                if(result.errors.supplierName){
                    error4.innerHTML = result.errors.supplierName[0];
                }else{
                    error4.innerHTML = "" ;
                }
                if(result.errors.phone){
                    error5.innerHTML = result.errors.phone[0];
                }else{
                    error5.innerHTML = ""
                }
                if(result.errors.quantite){
                    error6.innerHTML = result.errors.quantite[0];
                }else{
                    error6.innerHTML = ""
                }
                if(result.errors.image){
                    error7.innerHTML = result.errors.image[0];
                }else{
                    error7.innerHTML = ""
                }
                if(result.errors.description){
                    error8.innerHTML = result.errors.description[0];
                }else{
                    error8.innerHTML = ""
                }
            }else{
                let success = document.getElementById('success');
                error.innerHTML  = "" ;
                error2.innerHTML = "" ;
                error3.innerHTML = "" ;
                error4.innerHTML = "" ;
                error5.innerHTML = "" ;
                error6.innerHTML = "" ;
                error7.innerHTML = "" ;
                error8.innerHTML = "" ;
                success.style.display = "block";
                success.innerHTML = result.success ;
                productName.value = "" ;
                price.value = "" ;
                supplierName.value = "" ;
                phone.value = "" ;
                quantite.value = "" ;
                image.value = "" ;
                description.value = "" ;
            }
        }
    </script>
@endsection