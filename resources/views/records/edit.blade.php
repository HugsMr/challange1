@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">{{$records->title}}</div>
  <div class="card-body">
      
      <form action="{{ url('/api/records/' .$records->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PUT")
        <input type="hidden" name="id" id="id" value="{{$records->id}}" id="id" />
        <input type="hidden" name="userID" id="userID" value="{{$records->userID}}" id="id" />
        <label>Title</label></br>
        <input type="text" name="title" id="title" value="{{$records->title}}" class="form-control" required="required"></br>
        <label>Content</label></br>
        <textarea rows="5" cols="100" name="recordContent" required="required">{{$records->recordContent}}</textarea>
        <br>
        <input type="submit" value="Update" class="btn btn-primary"></br>
    </form>
  
  </div>
</div>
@endsection