<?php

namespace App\Services\Interfaces;

use App\Models\Post;

interface PostServiceInterface
{
    public function create(array $inputs);

    public function update(Post $post, array $inputs);

    public function delete(Post $post);
}