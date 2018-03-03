@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-default" href="{{ route('posts.index') }}">{{ trans('Back to list') }}</a>

                <hr>

                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('Create post') }}</div>

                    <div class="panel-body">
                        @include('elements.flash_message')

                        {{ Form::open(['route' => 'posts.store', 'method' => 'POST', 'class' => 'form-horizontal']) }}
                            @include('posts.form')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
