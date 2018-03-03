<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'author_id', 'is_public'
    ];

    /**
     * Get author.
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function getPublicAttribute()
    {
        return $this->is_public ? trans('Public') : trans('Private');
    }
}
