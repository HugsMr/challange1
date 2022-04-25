@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-body">
  
      <form action="{{ url('/api/records/') }}" method="post">
        {!! csrf_field() !!}
        @method("POST")
        <input type="hidden" name="id" id="id" value="" id="id" />
        <input type="hidden" name="userID" id="userID" value="{{Auth::user()->id}}" id="id" />
        <label>Title</label></br>
        <input type="text" name="title" id="title" value="" class="form-control" required="required"></br>
        <label>Content</label></br>
        <textarea rows="5" cols="100" name="recordContent" required="required"></textarea>
        <br>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
  
  </div>
</div>
@endsection