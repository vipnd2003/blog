<?php

namespace App\Services\Production;

use App\Models\User;
use App\Services\Interfaces\PostServiceInterface;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService extends BaseService implements PostServiceInterface
{
    /**
     * Create new post
     *
     * @param array $inputs
     * @return Post
     * @throws \Exception
     */
    public function create(array $inputs)
    {
        $inputs['author_id'] = Auth::user()->id;

        return Post::create($inputs);
    }

    /**
     * Update post
     *
     * @param Post $post
     * @param array $inputs
     * @return Post
     * @throws \Exception
     */
    public function update(Post $post, array $inputs)
    {
        if (Auth::user()->role != User::ROLE_ADMIN) {
            unset($inputs['is_public']);
        }

        $post->update($inputs);
        return $post;
    }

    /**
     * Delete book
     *
     * @param Post $post
     * @return bool
     * @throws \Exception
     */
    public function delete(Post $post)
    {
        return $post->delete();
    }
}