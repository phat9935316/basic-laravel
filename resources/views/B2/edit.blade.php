
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center">{{ __('Edit post') }}</h3>
                <form class="form-horizontal mt-4" method="POST" novalidate action="{{ route('post.update', ['id' => $post->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('Title') }} <span class="help text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="{{ __('title') }}" value="{{ old('title', $post->title) }}">
                                @if ($errors->has('title'))
                                <span class="text-danger pt-2">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="content">{{ __('Content') }} <span
                                        class="help text-danger">*</span></label>
                                <textarea name="content" class="form-control" id="content"
                                    placeholder="{{ __('Content') }}">{{ old('content', $post->content) }}</textarea>
                                @if ($errors->has('content'))
                                <span class="text-danger pt-2">{{ $errors->first('content') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-actions text-center py-4">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                            {{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="//cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.config.allowedContent = true;
</script>
@endsection
