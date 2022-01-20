@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Blog Post</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('posts.update', $post)}}" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="title" class="form-label">Title *</label>
                          <input type="text" class="form-control" name="title" id="title" required value="{{ old('title', $post->title) }}">
                        </div>

                        <div class="mb-3">
                          <label for="image" class="form-label">Image</label>
                          <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        </div>

                        <div class="mb-3">
                          <label for="body" class="form-label">Enter blog content *</label>
                          <textarea class="form-control" name="body" id="body" rows="6" required>{{ old('body', $post->body )}}</textarea>
                        </div>

                        <div class="mb-3">
                          <label for="iframe" class="form-label">Embedded content</label>
                          <textarea class="form-control" name="iframe" id="iframe" rows="3">
                            {{ old('iframe', $post->iframe)}}
                          </textarea>
                        </div>

                        <div class="mb-3">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary d-block mx-auto">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

