@extends('layouts.app')
@section('content')

    @if(Session::get('user')) <h3>{{Session::get('user')}}</h3> 
        <br><br>
        <a class="btn btn-danger" href="{{route('logout')}}">Log out </a>
    @endif 
@endsection 