<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_Follower extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'movie_follower';

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
