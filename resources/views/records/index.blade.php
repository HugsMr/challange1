@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 text-center">
            <h2>{{ __('Records') }}</h2>
        </div>
    </div>
    <div class="row justify-content-center mb-5 mt-5">
        <div class="col-12 col-md-10 text-center">
            <h2>Search</h2>
        </div>
        <div class="col-12 col-md-10  text-center">
            <form action="{{ route('search') }}" method="GET" class="mx-center">
                <input type="text" name="search" required /><br>
                <button type="submit" class="btn btn-primary mt-3">Search</button>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-12 col-md-10">
            <h2>Filters</h2>
            <p>Order by:</p>
            <ul class="filters">
                <li><a href="/newest">Newest</a></li>
            </ul>
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
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <p>
                <a href="{{url('/create')}}" class="btn btn-primary">Create</a>
                <a href="/export_db" class="btn btn-primary" target="_blank">Export DB to CSV</a>
            </div>
        </div>
    @endif

</div>
@endsection