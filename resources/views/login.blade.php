@extends('layout.layout')
@section('content')
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div style="margin-top:200px" class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="{{route('loginAction')}}" method="POST">
        @csrf
        @error('email')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="email" value="{{old('email')}}" type="text" placeholder="Enter your email">
        @error('password')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="password" type="password" placeholder="Enter your password">
        <input style="height:20px;width:5%" type="checkbox" name="remember" id=""><span style="margin-left:10px; margin-bottom:5px">Remember Me</span>
        <br><a href="{{route('password.request')}}">Forgot password?</a>
        <input type="submit" class="button" value="Login">
        @if (session('inc'))
            <span style="color:red">{{session('inc')}}</span>
        @endif
        @if (session('status'))
            <span style="color:green">{{session('status')}}</span>
        @endif
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div>
    <div class="registration form">
      <header>Signup</header>
      <form action="{{route('registerAction')}}" method="POST">
        @csrf
        @error('name')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="name" value="{{old('name')}}" type="text" placeholder="Enter your full name">
        @error('email')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="email" value="{{old('email')}}" type="text" placeholder="Enter your email">
        @error('password')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="password" type="password" placeholder="Create a password">
        <small>Password must be at least 8 characters long and include uppercase and lowercase letters, numbers, and symbols.</small>
        <input name="password_confirmation" type="password" placeholder="Confirm your password">
        @error('phone')
            <span style="color:red">{{$message}}</span>
        @enderror
        <input name="phone" value="{{old('phone')}}" type="tel" placeholder="Enter your phone">
        <input style="height:20px;width:5%" type="checkbox" name="remember" id=""><span style="margin-left:10px; margin-bottom:5px">Remember Me</span>
        <input type="submit" class="button" value="Signup">
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
         <label for="check">Login</label>
        </span>
      </div>
    </div>
  </div>
</body>
</html>

@endsection