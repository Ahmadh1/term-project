@extends('layouts.app')
@section('title', 'Update Reply')
@section('content')
<div class="panel panel-default">
<div class="panel-heading text-center"><h3>Update Reply</h3></div>
<div class="panel-body">
<form action="{{ route('reply.update', ['id' => $reply->id]) }}" method="post">
    @csrf
    <div class="form-group">
          <label for="content">Update reply</label>
          <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $reply->content }}</textarea>
    </div>
    <div class="form-group">
          <button class="btn btn-success pull-right" type="submit">Update reply</button>
    </div>
</form>
</div>
</div>
@stop