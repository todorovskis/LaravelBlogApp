@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Comment</div>

                    <div class="card-body">
                        <form action="{{ route('comments.store', ['blog' => $blog->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                {!! Form::label('content', 'Comment') !!}
                                {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::hidden('blog_id', $blog->id) !!}
                                {!! Form::submit('Add Comment', ['class' => 'btn btn-primary']) !!}
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
