@extends('layouts.app')
@section('title', 'Create new Channel')
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Create new channel</h3>
	</div>
	<div class="panel-body">
		<form action="{{ route('channels.store') }}" method="POST">
		<div class="form-group">
			@csrf
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" name="channel" placeholder="Title">
		</div>
		<button type="submit" class="btn btn-primary pull-right">Submit</button>
	</form>
	</div>
</div>
	
@stop