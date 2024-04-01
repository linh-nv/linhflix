@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($movie))
                        {!! Form::open(['route'=>'movie.store', 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['movie.update',$movie->id], 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif
                    
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($movie) ? $movie->title : '', ['class'=>'form-control','placeholder'=>'.........','id'=>'title', 'onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name_eng', 'Name English', []) !!}
                            {!! Form::text('name_eng', isset($movie) ? $movie->name_eng : '', ['class'=>'form-control','placeholder'=>'.........','id'=>'name_eng']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($movie) ? $movie->slug : '', ['class'=>'form-control','placeholder'=>'.........','id'=>'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($movie) ? $movie->description : '', ['class'=>'form-control','placeholder'=>'.........','id'=>'description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('year', 'Year', []) !!}
                            {!! Form::select('year', array_combine(range(date('Y'), 1900), range(date('Y'), 1900)), isset($movie) ? $movie->year : '', ['class'=>'form-control']) !!}
                        </div>  
                            
                        <div class="form-group">
                            {!! Form::label('runtime', 'Runtime', []) !!}
                            {!! Form::number('runtime',isset($movie) ? $movie->runtime : '', ['class'=>'form-control']) !!}                        
                        </div>
                        <div class="form-group">
                            {!! Form::label('trailer', 'Trailer', []) !!}
                            {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', ['class'=>'form-control','placeholder'=>'.........','id'=>'convert_slug']) !!}
                        </div>                                       
                        <div class="form-group">
                            {!! Form::label('active', 'Ative', []) !!}
                            {!! Form::select('status', ['1'=>'Show','0'=>'nonShow'], isset($movie) ? $movie->status : '', ['class'=>'form-control']) !!}                        
                        </div>
                        <div class="form-group" >
                            {!! Form::label('category', 'Category', []) !!}
                            {!! Form::select('category_id', $category, isset($movie) ? $movie->category_id : '', ['class'=>'form-control','id'=>'category']) !!}                        
                        </div>
                        <div class="form-group" id="episodeNumberField">
                            {!! Form::label('episode_number', 'Số tập', []) !!}
                            {!! Form::number('episode_number',isset($movie) ? $movie->episode_number : '0', ['class'=>'form-control']) !!}                        
                        </div>  
                        <div class="form-group">
                            {!! Form::label('genre', 'Genre', []) !!}
                            <br>
                            {{-- {!! Form::select('genre_id', $genre, isset($movie) ? $movie->genre_id : '', ['class'=>'form-control']) !!}                         --}}
                            @foreach($genre_list as $key => $gen)
                                @if (isset($movie))
                                    {!! Form::checkbox('genre[]', $gen->id, isset($movie_genre) && $movie_genre->contains($gen->id) ? true : false) !!}
                                @else
                                    {!! Form::checkbox('genre[]', $gen->id) !!}
                                @endif
                                {!! Form::label('genre', $gen->title) !!}
                            @endforeach
                        </div>
                        <div class="form-group">
                            {!! Form::label('country', 'Country', []) !!}
                            {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', ['class'=>'form-control']) !!}                        
                        </div>
                        <div class="form-group">
                            {!! Form::label('quality', 'Quality', []) !!}
                            {!! Form::select('qualiti', array_combine($quality_list, $quality_list), isset($movie) ? $movie->qualiti : '', ['class'=>'form-control']) !!}
                        </div>                        
                        <div class="form-group">
                            {!! Form::label('subtitle', 'Subtitle', []) !!}
                            {!! Form::select('subtitle', ['Vietsub'=>'Vietsub','Thaisub'=>'Thaisub','Engsub'=>'Engsub','Singsub'=>'Singsub'], isset($movie) ? $movie->subtitle : '', ['class'=>'form-control']) !!}                        
                        </div>
                        <div class="form-group">
                            {!! Form::label('actor', 'Diễn viên', []) !!}
                            {!! Form::text('actor', isset($movie) ? $movie->actor : '', ['class'=>'form-control','placeholder'=>'.........']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('director', 'Đạo diễn', []) !!}
                            {!! Form::text('director', isset($movie) ? $movie->director : '', ['class'=>'form-control','placeholder'=>'.........']) !!}
                        </div>
                        <div class="form-group">
                            @if(isset($movie))
                                <img src="{{asset('uploads/movie/'.$movie->image)}}" alt="" width="150" height="150">
                            @endif
                            {!! Form::label('image', 'Image', []) !!}
                            {!! Form::file('image', ['class'=>'form-control-file']) !!}                      
                        </div>
                        @if(!isset($movie))
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
