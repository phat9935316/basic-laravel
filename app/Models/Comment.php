<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $guarded = [];

    public function store($request, $id){
        $data = [
            'content_comment' => $request->content,
            'post_id' => $id,
        ];
        return $this->create($data);
    }
}
