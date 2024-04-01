@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('episode.create')}}" class="col-12 btn btn-primary">Create episode</a>
    <table class="table" id="tablephim">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Movie_id</th>
            <th scope="col">Title</th>
            <th scope="col">Link phim</th>
            <th scope="col">Episode number</th>
            <th scope="col">Manage</th>
          </tr>
        </thead>
        <tbody>
            @if (isset($episode))
                @foreach ($episode as $key => $cate)
                    <tr>    
                        <th scope="row">{{$key}}</th>
                        <td>{{$cate->movie_id}}</td>
                        <td>
                            @php
                                // Tạo một danh sách tập phim theo movie_id từ $list
                                $episodesForMovie = $list->where('movie_id', $cate->movie_id);
                            @endphp
                            {{$episodesForMovie->first()->movie->title}}
                        </td>
                        <td>{{$cate->linkphim}}</td>
                        <td>{{$cate->episode}}</td>
                        <td>
                            {!! Form::open([
                                'method'=>'DELETE', 
                                'route'=>['episode.destroy',$cate->id],
                                'onsubmit'=>'return confirm("Delete ?")'
                            ]) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('episode.edit',$cate->id)}}" class="btn btn-warning">Edit</a>
                        </td>  
                    </tr>
                @endforeach
            @else
                @foreach ($list as $key => $cate)
                    <tr>    
                        <th scope="row">{{$key}}</th>
                        <td>{{$cate->movie_id}}</td>
                        <td>{{$cate->movie->title}}</td>
                        <td>{{$cate->linkphim}}</td>
                        <td>{{$cate->episode}}</td>
                        <td>
                            {!! Form::open([
                                'method'=>'DELETE', 
                                'route'=>['episode.destroy',$cate->id],
                                'onsubmit'=>'return confirm("Delete ?")'
                            ]) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('episode.edit',$cate->id)}}" class="btn btn-warning">Edit</a>
                        </td>  
                    </tr>
                @endforeach
            @endif
        </tbody>
      </table>
</div>
@endsection
