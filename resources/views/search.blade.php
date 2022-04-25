@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 text-center">
            <h2>{{ __('Records') }}</h2>
        </div>
    </div>
    @if(count($records) == 0)
    <div class="row justify-content-center mb-2 mt-5">
        <div class="col-md-10 text-center">
            <h3>No Results Found</h3>
        </div>
    </div>
    @endif
    <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-10 text-center">
            <h2>Search</h2>
        </div>
        <div class="col-12 col-md-10  text-center">
            <form action="{{ route('search') }}" method="GET" class="mx-center">
                <input type="text" name="search" required value="<?php echo $_GET["search"] ?>" />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
    @if(isset(Auth::user()->id))
        @foreach($records as $record)
            @if (Auth::user()->id== $record->userID)
                <div class="row justify-content-center mb-2">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <span>{{ $record->title}}</span>
                                <span class="text-right ">
                                    <span class="d-inline-block mr-2"><a href="{{url('/api/records/'.$record->id.'')}}">Edit</a></span>
                                    <form method="POST" action="{{url('api/records/'.$record->id)}}" class="d-inline-block">
                                        {{ method_field("DELETE")}}
                                        <button type="submit" class="btn btn-primary" onclick="">Delete</button>
                                    </form>
                                </span>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        {{$record->recordContent}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
@endsection