<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = [];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function store($request){
        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];
        return $this->create($data);
    }

    public function updatePost($request, $id){
        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];
        return $this->find($id)->update($data);
    }
}
