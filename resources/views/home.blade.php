@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('b1') }}">Bài tập về  View Blade</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('b2') }}">Bài tập về  Query_Builder</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('b3') }}">Bài tập về  Eloquent ORM</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
