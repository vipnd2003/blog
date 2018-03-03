@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-default" href="{{ route('posts.index') }}">{{ trans('Back to list') }}</a>

                <hr>

                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('Update post') }}</div>

                    <div class="panel-body">
                        @include('elements.flash_message')

                        {{ Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
                            {{ method_field('put') }}
                            @include('posts.form')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
