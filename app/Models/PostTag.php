<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    protected $table = 'post_tag';

    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'content', 'user_id', 'category_id', 'thumbnail', 
        'published_at', 'status', 'meta_title', 'meta_description'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }
}
