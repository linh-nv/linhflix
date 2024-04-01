@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex">
        <!-- <a href="{{route('movie.createFormAPI')}}" class="col-3 btn btn-primary">Upload movie form API</a> -->
        <!-- <a href="{{route('movie.createDetailsAPI')}}" class="col-3 btn btn-primary">Upload details litte more movie</a> -->
        <a href="{{route('movie.create')}}" class="col-3 btn btn-primary">Create movie</a>
        <a href="{{url('movie/show')}}" class="col-3 btn btn-primary">Status movie</a>
    </div>
    
    <table class="table" id="tablephim">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Name English</th>
            {{-- <th scope="col">Image</th> --}}
            {{-- <th scope="col">Trailer</th> --}}
            <th scope="col">Slug</th>
            {{-- <th scope="col">Description</th> --}}
            {{-- <th scope="col">Link phim</th> --}}
            {{-- <th scope="col">Episode Number</th> --}}
            <th scope="col">Year</th>
            {{-- <th scope="col">Tags</th> --}}
            {{-- <th scope="col">Runtime</th>
            <th scope="col">Active</th> --}}
            {{-- <th scope="col">Category</th> --}}
            {{-- <th scope="col">Genre</th> --}}
            {{-- <th scope="col">Country</th> --}}
            {{-- <th scope="col">Qualiti</th>
            <th scope="col">SubTitle</th> --}}
            {{-- <th scope="col">Actor</th> --}}
            {{-- <th scope="col">Director</th> --}}
            <th scope="col">Manage</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($list as $key => $cate)
            <tr>
                <th scope="row">{{$key}}</th>
                <td>{{$cate->title}}</td>
                <td>{{$cate->name_eng}}</td>
                {{-- <td><img src="{{'https://img.ophim9.cc/uploads/movies/'.$cate->image}}" alt="" width="150" height="150"></td> --}}
                {{-- <td>{{$cate->trailer}}</td> --}}
                <td>{{$cate->slug}}</td>
                {{-- <td>{{$cate->description}}</td> --}}
                {{-- <td>{{$cate->linkphim}}</td> --}}
                {{-- <td>{{$cate->episode_number}}</td> --}}
                <td>{{$cate->year}}</td>
                {{-- <td>{{$cate->tags}}</td> --}}
                {{-- <td>{{$cate->runtime}} phút</td> --}}
                {{-- <td>
                    @if($cate->status == 1)
                        Show
                    @else
                        nonShow
                    @endif
                </td> --}}
                {{-- <td>{{$cate->category->title}}</td> --}}
                {{-- <td>
                    @foreach ($cate->movie_genre as $gen)
                        <span class="bg-dark text-white">{{$gen->title}}<br></span>
                    @endforeach
                </td> --}}
                {{-- <td>{{$cate->country->title}}</td> --}}
                {{-- <td>{{$cate->qualiti}}</td> --}}
                {{-- <td>{{$cate->subtitle}}</td> --}}
                {{-- <td>{{$cate->actor}}</td> --}}
                {{-- <td>{{$cate->director}}</td> --}}
                <td>
                    {!! Form::open([
                        'method'=>'DELETE', 
                        'route'=>['movie.destroy',$cate->id],
                        'onsubmit'=>'return confirm("Delete ?")'
                    ]) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    <a href="{{route('movie.edit',$cate->id)}}" class="btn btn-warning">Edit</a>
                </td>  
            </tr>
            @endforeach
        </tbody>
      </table>
      {{ $list->links("pagination::bootstrap-4") }}

</div>
@endsection
