@extends('layouts.app')
@section('title', $user->name .' Profile')
@section('content')
@include('layouts.notify')
    <div class="panel panel-default">
     <div class="panel-heading text-center"><b>{{ $user->name }}</b>'s Profile</div>
                <div class="panel-body">
                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" style="width: 75px; height: 75px; border-radius: 50%;">
                    <h3 class="">Points: <code>{{ $user->points }}</code></h3>
                    <form enctype="multipart/form-data" action="{{ route('profile.update') }}" method="POST">
                      @csrf
                      <div class="form-group pull-right">
                        <label for="avatar">change avatar:</label>
                        <input type="file" name="avatar" class="">
                        <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-default">update</button>
                        </div>
                      </div>      
                        
                    </form>
                </div>
            </div>
@stop