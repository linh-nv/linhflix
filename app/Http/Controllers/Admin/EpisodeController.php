<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Episode::with('movie')->get();
        return view('admin.episode.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        return view('admin.episode.form',compact('list_movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request -> all();
        $episode = new Episode();
        $episode->movie_id = $data['movie_id'];
        $episode->linkphim = $data['linkphim'];
        $episode->episode = $data['episode'];

        $episode->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $episode = Episode::where('movie_id',$id)->get();
        $list = Episode::with('movie')->get();
        return view('admin.episode.index',compact('list','episode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $episode = Episode::find($id);
        $list = Episode::all();
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        return view('admin.episode.form',compact('list','episode','list_movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request -> all();
        $episode = episode::find($id);
        $episode->movie_id = $data['movie_id'];
        $episode->linkphim = $data['linkphim'];
        $episode->episode = $data['episode'];

        $episode->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        episode::find($id)->delete();
        return redirect()->back();
    }
    public function select_movie(){
        $id = $_GET['id'];
        $movie = Movie::find($id);
        $output = '<option>---Chọn tập phim---</option>';

        for($i=1; $i<=$movie->episode_number; $i++){
            $output .= '<option value = "'.$i.'">'.$i.'</option>';
        }

        echo $output;
    }
}
