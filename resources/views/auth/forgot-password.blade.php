@extends('layout.layout')
@section('content')
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div style="margin-top:200px" class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Reset Password</header>
      <form action="{{route('password.email')}}" method="POST">
        @csrf
        @error('email')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="email" value="{{old('email')}}" type="text" placeholder="Enter your email">
        @error('password')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input type="submit" class="button" value="Submit">
        @if (session('status'))
            <span style="color:green">{{session('status')}}</span>
        @endif
      </form>
    </div>  
  </div>    