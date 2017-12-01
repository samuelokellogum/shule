@extends('layouts.app')
@section('content')
<a href="/posts" class="btn btn-warning">Go Back</a>
    <h1>{{$student->fistname $student->lastname}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$students->cover_image}}">
    <br><br>
        <div>
        {!!$student->status!!}
        </div>
    <hr>
    
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $student->user_id)
        <a href="/posts/{{$student->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action' => ['StudentC@destroy', $student->id],
            'method' => 'POST', 'class' =>'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection