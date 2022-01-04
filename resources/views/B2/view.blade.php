@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ $post->title }}</h3>
                    {!! $post->content !!}
                </div>
            </div>
            <div class="card my-5">
                <div class="card-body">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" rows="5" class="w-100"></textarea>
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="list-comment my-5">
                @foreach ($post->comments as $item)
                    <div class="card px-3">
                        <p>{{ $item->content_comment }}</p>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('.btn-primary').on('click', function(){
            $.ajax({
                method: "POST",
                url: '{{ route('post.comment', ['id' => $post->id]) }}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'content': $('#comment').val()
                },
                success: function(result) {
                    let html =
                    `
                    <div class="card px-3">
                        <p>${ $('#comment').val() }</p>
                    </div>
                    `
                    $('#comment').val('')
                    $('.list-comment').append(html);
                    toastr.success(result.message)
                },
                error: function(result) {
                    toastr.error(result.message)
                }
            });
        })

    </script>
@endsection
