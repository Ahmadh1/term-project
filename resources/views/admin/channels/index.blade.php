@extends('layouts.app')
@section('title', 'Channels')
@section('content')
@include('layouts.notify')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Channels</h3>
    </div>
    <div class="panel-body"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @if ($channels->count() > 0)
                    @foreach ($channels as $ch)
                        <tr>
                            <td>{{ $ch->title }}</td>
                            <td><a class="btn btn-warning btn-xs" href="{{ route('channels.edit', ['channel' => $ch->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('channels.destroy', ['channel' => $ch->id]) }}" method="POST" role="form">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <th class="text-danger text-center" colspan="3">No Channel Found</th>                    
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
