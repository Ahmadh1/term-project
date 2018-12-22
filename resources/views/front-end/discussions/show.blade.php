@extends('layouts.app')
@section('title', $d->title)
@section('content')
@include('layouts.notify')
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{ $d->user->avatar }}" alt="" style="width: 40px; height: 40px; border-radius: 50%;">&nbsp;&nbsp;&nbsp;
                <span>{{ $d->user->name }}</span>
            @if (Auth::user())
                    @if($d->is_being_watched_by_auth_user())
                        <a href="{{ route('unwatch', ['id' => $d->id ]) }}" class="btn btn-default btn-xs pull-right">unwatch</a>
                    @else
                        <a href="{{ route('watch', ['id' => $d->id ]) }}" class="btn btn-default btn-xs pull-right">watch</a>
                    @endif
                @endif
                @if (Auth::id() == $d->user->id)
                    @if (!$d->hasBestAnswer())
                        <a href="{{ route('discussion.edit', ['slug' => $d->slug ]) }}" class="btn btn-info btn-xs pull-right"><i class="fa fa-pencil"></i></a>
                    @endif
                @endif
            </div>
            <div class="panel-body">
                <h4 class="text-center">
                    <b>{{ $d->title }}</b>
                </h4>
                <hr>
                <p class="text-center">
                    {!! Markdown::convertToHtml($d->content) !!}
                </p>
                <hr>  
                @if($best_answer)
                    <div class="" style="padding: 40px;">
                        <h3 class="text-center">BEST ANSWER</h3>
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                <img src="{{ $best_answer->user->avatar }}" alt="" style="width: 40px; height: 40px; border-radius: 50%;">&nbsp;&nbsp;&nbsp;
                                <span>{{ $best_answer->user->name }}</span>
                            </div>
                            <div class="panel-body">
                                    {!! Markdown::convertToHtml($best_answer->content) !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="panel-footer">
                    <span class="">
                        <i class="fa fa-clock-o"></i>&nbsp;{{ $d->created_at->diffForHumans() }}
                    </span>
            </div>
        </div>
        @foreach($d->replies as $r)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{ $r->user->avatar }}" alt="" style="width: 40px; height: 40px; border-radius: 50%;">&nbsp;&nbsp;&nbsp;
                    <span>{{ $r->user->name }}</span>
                    @if(!$best_answer)
                        @if(Auth::id() == $d->user->id)
                            <a href="{{ route('discussion.best.answer', ['id' => $r->id ]) }}" class="btn btn-xs btn-info pull-right">Mark as best answer</a>
                        @endif
                    @endif
                    @if (Auth::id() == $r->user->id)
                        @if (!$r->best_answer)
                             <a href="{{ route('reply.edit', ['id' => $r->id]) }}" class="btn btn-danger btn-xs pull-right"><i class="fa fa-pencil"></i></a>
                        @endif
                    @endif
                </div>
                <div class="panel-body">
                    <p class="text-center">
                        {!! Markdown::convertToHtml($r->content) !!}
                    </p>
                </div>
                <div class="panel-footer">
                    @if($r->is_liked_by_auth_user())
                        <a href="{{ route('reply.unlike', ['id' => $r->id ]) }}" class="btn btn-danger btn-xs">Unlike <span class="badge">{{ $r->likes->count() }}</span></a>
                    @else
                        <a href="{{ route('reply.like', ['id' => $r->id ]) }}" class="btn btn-success btn-xs">Like <span class="badge">{{ $r->likes->count() }}</span></a>
                    @endif
                    <span class="pull-right">
                        <i class="fa fa-clock-o"></i>&nbsp;{{ $r->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        @endforeach
        <div class="panel panel-default">
            <div class="panel-body">
                @if(Auth::check())
                    <form action="{{ route('discussion.reply', ['id' => $d->id ]) }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="reply">Leave a reply...</label>
                            <textarea name="content" id="reply" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default pull-right">Leave a reply</button>
                        </div>
                    </form>
                @else
                    <div class="text-center">
                        <h2><a href="/login">Sign in to leave a reply</a></h2>
                    </div>
                @endif
            </div>
        </div>
@endsection