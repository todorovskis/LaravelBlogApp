@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center" style="max-width: 400px; margin: 0 auto;">
                    <div class="card-header mt-2" style="background-color: #3490dc; color: #ffffff;">Latest Blogs</div>

                    <div class="card-body">
                        @if($blogs->isEmpty())
                            <p style="font-weight: bold;">No blogs available.</p>
                        @else
                            @foreach($blogs as $blog)
                                <div class="blog-post mt-4" style="border: 1px solid #bacbd5; border-radius: 5px; padding: 10px; background-color: rgba(238, 238, 238, 0.9);">
                                    <h3 style="color: #3490dc;">{{ $blog->title }}</h3>
                                    <p>{{ $blog->content }}</p>
                                    <hr style="border-color: #3490dc;">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('comments.create', ['blog' => $blog->id]) }}" class="btn btn-sm btn-primary">Comment</a>
                                        @auth
                                            @if(auth()->user()->id == $blog->user_id)
                                                <div class="d-flex">
                                                    <a href="{{ route('blogs.edit', ['blog' => $blog->id]) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                                                    <form action="{{ route('blogs.destroy', ['blog' => $blog->id]) }}" method="post" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>

                                    <div class="comments-section mt-3">
                                        <h4 style="color: #3490dc;">Comments</h4>
                                        @foreach($blog->comments as $comment)
                                            <div class="comment" style="background-color: #f8f9fa; border: 1px solid #ced4da; border-radius: 5px; padding: 5px; margin-bottom: 5px;">
                                                <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            @endforeach
                        @endif

                            @auth
                            <div class="mt-4">
                                <a href="{{ route('blogs.create') }}" class="btn btn-success" style="background-color: #3490dc; color: white">Create New Blog</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
