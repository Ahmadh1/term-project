@extends('layouts.app')
@section('title', $query)
@section('content')
	@if ($discussion->count() > 0)
	<h3>Search for: <code>{{ $query }}</code></h3>
		@foreach ($discussion as $d)
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><b>{{ $d->title }}</b></h3>
				</div>
				<div class="panel-body">
					<h3 class="text-center"><a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="text-warning">{{ $d->title }}</a></h3>
					<p class="text-center">{{ str_limit($d->content, 100) }}</p>
				</div>
			</div>
		@endforeach
		@else
		<h3>No result found of <code>{{ $query }}</code></h3>
	@endif
@stop