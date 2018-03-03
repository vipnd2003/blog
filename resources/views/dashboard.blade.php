@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach ($posts as $post)
                    <div class="card">
                        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{{ substr($post->content, 0, 250) }}</p>
                            <a href="#" class="btn btn-primary" data-url="{{ route('posts.data', $post->id) }}" data-toggle="modal" data-target="#myModal">Read More →</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{ $post->created_at }} by <a href="#">{{ $post->author->name }}</a>
                        </div>
                    </div>
                @endforeach
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
@endsection

@section('inline_scripts')
    <script type="text/javascript">
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