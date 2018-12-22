@extends('layouts.app')
@section('title', $discussion->title)
@section('content')
<div class="panel panel-default">
<div class="panel-heading text-center"><h3><b>{{ $discussion->title }}</b></h3></div>
<div class="panel-body">
<form action="{{ route('discussion.update', ['id' => $discussion->id]) }}" method="post">
    @csrf
    <div class="form-group">
          <label for="content">Update</label>
          <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $discussion->content }}</textarea>
    </div>
    <div class="form-group">
          <button class="btn btn-default pull-right" type="submit">Update discussion</button>
    </div>
</form>
</div>
</div>
@stop