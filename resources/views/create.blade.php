@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ isset($blog) ? 'Edit' : 'Create' }} Blog Post</div>

                    <div class="card-body">
                        @if(isset($blog))
                            {!! Form::model($blog, ['route' => ['blogs.update', $blog->id], 'method' => 'patch']) !!}
                            @method('patch')
                        @else
                            {!! Form::open(['route' => 'blogs.store']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('content', 'Content') !!}
                            {!! Form::textarea('content', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit(isset($blog) ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
