@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('episode.index')}}" class="col-12 btn btn-primary">Status movie episode</a>
    <table class="table" id="tablephim">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">id</th>
            <th scope="col">Movie</th>
            <th scope="col">Image</th>
            <th scope="col">Status</th>
            <th scope="col">Manage</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $cate)
                @if($cate->episode_number >0)
                <tr>    
                    <th scope="row">{{$key}}</th>
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->title}}</td>
                    <td><img src="https://img.ophim9.cc/uploads/movies/{{$cate->image}}" alt="" width="150" height="150"></td>
                    <td>
                        @php
                            $count = 0;   
                        @endphp
                        @foreach ($episode as $key => $epi)
                            @if ($cate->id==$epi->movie_id)
                                @php
                                    $count ++;
                                @endphp 
                            @endif
                        @endforeach
                        {{$count}}/{{$cate->episode_number}}
                    </td>
                    <td>
                        <a href="{{route('episode.create')}}" class="btn btn-info">Add episode</a>
                        <a href="{{route('episode.show',$cate->id)}}" class="btn btn-primary">Detail episode</a>
                    </td>  
                </tr>
                @endif
            @endforeach
        </tbody>
      </table>
</div>
@endsection
