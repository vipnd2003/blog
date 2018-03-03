@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-primary" href="{{ route('posts.create') }}">{{ trans('Create post') }}</a>

                <hr>

                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('List posts') }}</div>

                    <div class="panel-body">
                        @include('elements.flash_message')

                        @if ($posts->isEmpty())
                            <p class="alert alert-success">{{ trans('Have no posts.') }}</p>
                        @else
                            <div class="table-responsive mt-16">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('Title') }}</th>
                                            <th>{{ trans('Description') }}</th>
                                            <th>{{ trans('Author') }}</th>
                                            <th>{{ trans('Public') }}</th>
                                            <th width="20%">{{ trans('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $index = 1 @endphp
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ substr($post->content, 0, 50) }}</td>
                                                <td>{{ $post->author->name }}</td>
                                                <td>{{ $post->public }}</td>
                                                <td class="text-right">
                                                    <a class="btn btn-success btn-sm btn-view" href="#" data-url="{{ route('posts.data', $post->id) }}" data-toggle="modal" data-target="#myModal">{{ trans('View') }}</a>
                                                    <a class="btn btn-warning btn-sm" href="{{ route('posts.edit', $post->id) }}">{{ trans('Edit') }}</a>
                                                    {{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete', 'class' => 'form-delete', 'style' => 'display:inline-block;']) }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger btn-sm">{{ trans('Delete') }}</button>
                                                    {{ Form::close() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{ $posts->links() }}
                        @endif
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"></h4>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $('.form-delete').submit(function(){
            if (confirm("{{ trans('Are you sure?') }}")) {
                return true;
            }
            return false;
        });

        $("#myModal").on("show.bs.modal", function(e) {
            var target = $(e.relatedTarget);
            var url = target.data('url');

            $.ajax({
                method: "POST",
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            })
            .done(function(data) {
                $('.modal-title').text(data.title);
                $('.modal-body').html(data.content);
            });
        });
    </script>
@endsection