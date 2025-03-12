@extends('layout.layout')
@section('content')
<div style="margin-top: 150px; margin-left:75px;margin-right:75px; margin-bottom:100px">
    <h4>Please verify your email through the email we've sent you.</h1>
    <p>Didn't get the email</p>
    <form action="{{route('verification.send')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white">Send agin</button>
    </form>
</div>    
@endsection                                                                                                                                                                                       