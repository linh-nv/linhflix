@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý danh mục</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($category))
                        {!! Form::open(['route'=>'category.store', 'method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route'=>['category.update',$category->id], 'method'=>'PUT']) !!}
                    @endif
                    
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', ['class'=>'form-control','placeholder'=>'.........','id'=>'title', 'onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', ['class'=>'form-control','placeholder'=>'.........','id'=>'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description : '', ['class'=>'form-control','placeholder'=>'.........','id'=>'description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('active', 'Ative', []) !!}
                            {!! Form::select('status', ['1'=>'Show','0'=>'nonShow'], isset($category) ? $category->status : '', ['class'=>'form-control']) !!}                        
                        </div>
                        @if(!isset($category))
                            {!! Form::submit('Submit', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Update', ['class'=>'btn btn-success']) !!}
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
