<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'user_id',
        'category_id',
        'thumbnail',
        'published_at',
        'status',
        'meta_title',
        'meta_description'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

}
