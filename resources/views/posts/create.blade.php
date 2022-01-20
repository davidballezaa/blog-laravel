@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Create new blog post</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    {{-- enctype multipart is for sending files --}}
                        <div class="mb-3">
                          <label for="title" class="form-label">Title *</label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Enter your blog title" required>
                        </div>

                        <div class="mb-3">
                          <label for="image" class="form-label">Image</label>
                          <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        </div>

                        <div class="mb-3">
                          <label for="body" class="form-label">Enter blog content *</label>
                          <textarea class="form-control" name="body" id="body" rows="6" required></textarea>
                        </div>

                        <div class="mb-3">
                          <label for="iframe" class="form-label">Embedded content</label>
                          <textarea class="form-control" name="iframe" id="iframe" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-primary d-block mx-auto">Send</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection