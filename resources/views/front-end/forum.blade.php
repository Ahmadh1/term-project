@extends('layouts.app')
@section('title', 'Home')
@section('content')
@include('layouts.notify')
@foreach ($discussions as $d)
    <div class="panel panel-default">
    <div class="panel-heading">
        <img src="{{ $d->user->avatar }}" alt="{{ $d->user->name }}" style="width: 40px; height: 40px; border-radius: 50%;">&nbsp; &nbsp;{{ $d->user->name }}
            @if ($d->hasBestAnswer())
                <span class="pull-right badge badge-teal" title="solved" style="background: #B71C1C;">
                    closed
                </span>        
            @else
                <span class="pull-right badge badge-danger" title="unsolved" style="background: #263238;">
                    open
                </span>
            @endif
    </div>
    <div class="panel-body">
        <h4 class="text-center"><b><a href="{{ route('discussion', ['discussion' => $d->slug]) }}" class="">{{ $d->title }}</a></b></h4>
        <p class="text-center">
            {{ str_limit($d->content, 100) }}
        </p>
    </div>
    <div class="panel-footer">
        @if ($d->replies->count() > 0)
            <i class="fa fa-reply"></i>
                <span class="badge">
                    {{ $d->replies->count() }}
                </span>
                @else
                <i class="fa fa-reply"></i>
                <span class="badge">
                    {{ $d->replies->count() }}
                </span>
            @endif
            <span class="pull-right"><i class="fa fa-clock-o"></i>&nbsp;{{ $d->created_at->diffForHumans() }}</span>
    </div>
</div>
@endforeach
    <div class="text-center">
        <ul class="pagination pagination-sm">
            <li>{{ $discussions->links() }}</li>
        </ul>    
    </div>
@stop
