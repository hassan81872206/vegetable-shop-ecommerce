@extends('layout.layout')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh fruits shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input id="search" type="search" onkeyup="search()" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                       
                    </div>
                    <br><br>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            @forelse ($categories as $categorie)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="/shop/{{$categorie->categorieID}}"><i class="fas fa-apple-alt me-2"></i>{{$categorie->categorieName}}</a>
                                                        <span>
                                                            @foreach ($countCategorieID as $c)
                                                                @if ($categorie->categorieID == $c[1])
                                                                    ({{$c[0]}})
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    </div>
                                                </li>
                                            @empty
                                                <h1>empty</h1>
                                            @endforelse
                                            <br>
                                            {{$categories->withQueryString()->links()}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Featured products</h4>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 100px; height: 100px;">
                                            <img src="{{asset('img/featur-1.jpg')}}" class="img-fluid rounded" alt="">
                                        </div>
                                        <div>
                                            <h6 class="mb-2">Big Banana</h6>
                                            <div class="d-flex mb-2">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2">2.99 $</h5>
                                                <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 100px; height: 100px;">
                                            <img src="{{asset('img/featur-2.jpg')}}" class="img-fluid rounded" alt="">
                                        </div>
                                        <div>
                                            <h6 class="mb-2">Big Banana</h6>
                                            <div class="d-flex mb-2">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2">2.99 $</h5>
                                                <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 100px; height: 100px;">
                                            <img src="{{asset('img/featur-3.jpg')}}" class="img-fluid rounded" alt="">
                                        </div>
                                        <div>
                                            <h6 class="mb-2">Big Banana</h6>
                                            <div class="d-flex mb-2">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2">2.99 $</h5>
                                                <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center my-4">
                                        <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="{{asset('img/banner-fruits.jpg')}}" class="img-fluid w-100 rounded" alt="">
                                        <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cont-1" class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                <h1 id="notLogin"></h1>
                                @forelse ($products as $product)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{asset('storage/images/'.$product->image)}}" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{$product->productName}}</h4>
                                                <p>{{$product->description}}</p>
                                                <p class="text-dark fs-5 fw-bold mb-0">${{$product->price}} / kg</p><br>
                                                <div class="d-flex justify-content-between ">
                                                    <a href="{{route('shopDetails' , $product->productID)}}" class="btn border border-secondary rounded-pill px-3 text-primary">View Details</a>
                                                    @php
                                                        $c = 0
                                                    @endphp
                                                    @foreach ($contentCart as $cart)
                                                        @if ($cart->id === $product->productID)
                                                            @php
                                                                $c++    
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    @if ($c == 1)
                                                        <button meta-data = "{{$product->productID}}" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Added </button>
                                                    @else
                                                        <button meta-data = "{{$product->productID}}" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart({{$product->productID}})"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add To cart </button>
                                                    @endif
                                                    {{-- <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    
                                @endforelse
                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        {{$products->withQueryString()->links()}}                                    </div>    
                                </div>    
                            </div>
                        </div>
                        <div id="cont-2" class="col-lg-9">
                            <div id="mini-cont" class="row g-4 justify-content-center">

                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection
<script>
    let debounceTimer;

    function search() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            performSearch(); // استدعاء البحث بعد انتهاء التأخير
        }, 300); // تأخير لمدة 300 مللي ثانية
    }
    function performSearch(){
        let content = document.getElementById("search");
        const myHeaders = new Headers();
        myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");
        
        const urlencoded = new URLSearchParams();
        urlencoded.append("search", content.value);

        const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: urlencoded,
        // redirect: "follow"
        };
        fetch("/search", requestOptions)
        .then((response) => response.json())
        .then((result) => getDataSearch(result , content))
        .catch((error) => console.error(error));
    }
    function getDataSearch(result , content){
        if(content.value != ""){
            if(result.search.length !== 0){
                let cont1 = document.getElementById("cont-1");
                cont1.style.display = "none" ;
                let cont2 = document.getElementById("cont-2");
                cont2.style.display = "block";
                let mini = document.getElementById("mini-cont");
                mini.innerHTML = "" ;
                let c = 0 ;
                // let div1 = document.createElement('div');
                // div1.classList.add('col-md-6' , 'col-lg-6' , 'col-xl-4');
                // console.log(result.search[0].image)
                for(let i = 0 ; i < result.search.length ; i++){
                    mini.innerHTML += `
                        <div class="col-md-6 col-lg-6 col-xl-4">
                          <div class="rounded position-relative fruite-item">
                                <div class="fruite-img">
                                    <img src="storage/images/${result.search[i].image}" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4>${result.search[i].productName}</h4>
                                    <p>${result.search[i].description}</p>
                                    <p class="text-dark fs-5 fw-bold mb-0">$${result.search[i].price} / kg</p><br>
                                    <div class="d-flex justify-content-between">
                                        <a href="/shopDetails/${result.search[i].productID}" class="btn border border-secondary rounded-pill px-3 text-primary">View Details</a>
                                        <button meta-data = "${result.search[i].productID}" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="addToCart(${result.search[i].productID})"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add To cart </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                }
                console.log("done")
            }else{
                let cont1 = document.getElementById("cont-1");
                cont1.style.display = "none" ;
                let mini = document.getElementById("mini-cont");
                mini.style.display = "flex";
                let cont2 = document.getElementById("cont-2");
                cont2.style.display = "block";
                // mini.style.justifyContent = "center" ;
                mini.innerHTML = "<h1> No result </h1>" ;
            }
        
        }else{
            let cont1 = document.getElementById("cont-1");
            cont1.style.display = "block" ;
            let cont2 = document.getElementById("cont-2");
            cont2.style.display = "none";
            console.log("hello")
        }
    }

    function addToCart(productID){
        const myHeaders = new Headers();
        myHeaders.append("X-CSRF-TOKEN", "{{csrf_token()}}");
        // myHeaders.append("product", productID);

        const requestOptions = {
        method: "POST",
        headers: myHeaders,
        // redirect: "follow"
        };

        fetch(`/addToCart/${productID}`, requestOptions)
        .then((response) => response.json())
        .then((result) =>getDataAdd(result , productID))
        .catch((error) => console.error(error));
    }
    function getDataAdd(result , productID){
        if(result.Added){
            let button = document.querySelector(`button[meta-data='${productID}']`);
            button.innerHTML = "Added";
        }else{
            let notLogin = document.getElementById("notLogin");
            notLogin.innerHTML = "Please Login or Register";
        }
    }
</script>