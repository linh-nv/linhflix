@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quản lý tập phim</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($episode))
                        {!! Form::open(['route'=>'episode.store', 'method'=>'POST']) !!}
                    @else
                        {!! Form::open(['route'=>['episode.update',$episode->id], 'method'=>'PUT']) !!}
                    @endif
                    
                    <div class="form-group">
                        {!! Form::label('movie', 'Movie', []) !!}
                        {!! Form::select('movie_id', ['0'=>'---Chọn phim---', 'Danh sách phim'=>$list_movie], isset($episode) ? $episode->movie_id : '', ['class'=>'form-control', 'id'=> 'select_movie']) !!}
                    </div>
                    
                        <div class="form-group">
                            {!! Form::label('linkphim', 'linkphim', []) !!}
                            {!! Form::text('linkphim', isset($episode) ? $episode->linkphim : '', ['class'=>'form-control', 'id'=>'select_movie']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('episode', 'Episode', []) !!}
                            @if (isset($episode))
                                {!! Form::number('episode', $episode->episode, ['class'=>'form-control']) !!}
                            @else
                                <select name="episode" class="form-control" id="episode_total"></select>
                            @endif
                        </div>   
                        @if(!isset($episode))
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
