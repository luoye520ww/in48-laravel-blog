<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'email', 'content', 'image_path', 'is_approved'];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
