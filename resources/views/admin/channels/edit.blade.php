@extends('layouts.app')
@section('title', $channel->title)
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Edit <b>{{ $channel->title }}</b></h3>
	</div>
	<div class="panel-body">
		<form action="{{ route('channels.update', ['channel'=> $channel->id]) }}" method="POST">
		<div class="form-group">
			@csrf
			@method('PUT')
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" value="{{ $channel->title }}" name="channel">
		</div>
		<button type="submit" class="btn btn-primary pull-right">Update</button>
	</form>
	</div>
</div>
	
@stop