@extends('layout.layout')
@section('content')
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div style="margin-top:200px" class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Reset Password</header>
      <form action="{{route('password.update')}}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{$token}}" id="">
        @error('email')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="email" value="{{old('email')}}" type="text" placeholder="Enter your email">
        @error('password')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="password" type="password" placeholder="Enter your password">
        <small>Password must be at least 8 characters long and include uppercase and lowercase letters, numbers, and symbols.</small>
        <input name="password_confirmation" type="password" placeholder="Confirm your password">
        {{-- <br><a href="{{route('password.request')}}">Forgot password?</a> --}}
        <input type="submit" class="button" value="Reset Password">
        @if (session('inc'))
            <span style="color:red">{{session('inc')}}</span>
        @endif
      </form>