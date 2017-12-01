@extends('main')

@section('content')
<h1>Edit Post</h1>   
   {!! Form::open(['action' => ['StudentC@update', $student->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
    <div class="form-group">    
    {{Form::label('fname', 'First Name')}}    
    {{Form::text('fname',$student->fname, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
    </div>
    <div class="form-group">    
    {{Form::label('lname', 'Last Name')}}    
    {{Form::text('lname',$student->lname, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
    </div>
     <div class="form-group">    
    {{Form::label('adminYear', 'Admission Date')}}    
    {{Form::datepicker('adminYear',$student->adminYear, ['class' => 'form-control datepicker', 'placeholder' => 'Admission Date'])}}
    </div>    
      <div class="form-group">    
    {{Form::label('dob', 'Date of Birth')}}    
    {{Form::datepicker('dob',$student->dob, ['class' => 'form-control datepicker', 'placeholder' => 'Date of Birth'])}}
    </div> 
    <div class="form-group"> 
    {{Form::label('cover_image', 'Image'}}       
    {{Form::file('cover_image') }}        
    </div>
     {{ Form::hidden('_method', 'PUT') }}
    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}    
   {!! Form::close() !!}
   
@endsection