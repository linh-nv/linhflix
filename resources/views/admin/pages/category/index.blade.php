@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('category.create')}}" class="col-9 btn btn-primary">Create category</a>
    <a href="{{route('movie.createDetailsAPI')}}" class="col-3 btn btn-primary">Upload details litte more movie</a>



    <table class="table" id="tablephim">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Description</th>
            <th scope="col">Active</th>
            <th scope="col">Manage</th>
          </tr>
        </thead>
        <tbody class="order_position">
            @foreach ($list as $key => $cate)
            <tr id="{{$cate->id}}">
                <th scope="row">{{$key}}</th>
                <td>{{$cate->title}}</td>
                <td>{{$cate->slug}}</td>
                <td>{{$cate->description}}</td>
                <td>
                    @if($cate->status == 1)
                        Show
                    @else
                        nonShow
                    @endif
                </td>
                <td>
                    {!! Form::open([
                        'method'=>'DELETE', 
                        'route'=>['category.destroy',$cate->id],
                        'onsubmit'=>'return confirm("Delete ?")'
                    ]) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">Edit</a>
                </td>  
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection
