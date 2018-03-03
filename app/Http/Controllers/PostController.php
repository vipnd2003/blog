<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Services\Interfaces\PostServiceInterface;
use App\Models\Post;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Auth;
use Parsedown;

class PostController extends Controller
{
    /**
     * @var PostServiceInterface
     */
    protected $postService;

    /**
     * Constructor
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * List posts page
     *
     * GET /posts
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == User::ROLE_ADMIN) {
            $posts = Post::paginate(10);
        } else {
            $posts = Post::where('author_id', $user->id)->paginate(10);
        }

        return view('posts.index', compact('posts'));
    }

    /**
     * Create post page
     *
     * GET /post/create
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Process create post request
     *
     * POST /posts
     *
     * @param CreatePostRequest $request
     */
    public function store(CreatePostRequest $request)
    {
        if ($this->postService->create($request->except('_token'))) {
            $request->session()->flash('message-success', trans('Create post succesfully.'));
            return redirect(route('posts.index'));
        }

        abort(500, trans('Create post failed. Please try later.'));
    }

    /**
     * Show post page
     *
     * GET /posts/{post}
     *
     * @param Post $post
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Edit post page
     *
     * GET /posts/{post}/edit
     *
     * @param Post $post
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Process update post request
     *
     * PUT /posts/{post}
     *
     * @param Post $post
     * @param UpdatePostRequest $request
     */
    public function update(Post $post, UpdatePostRequest $request)
    {
        $this->authorize('update', $post);

        if ($this->postService->update($post, $request->except(['_method', '_token']))) {
            $request->session()->flash('message-success', trans('Update post succesfully.'));
            return redirect(route('posts.index'));
        }

        abort(500, trans('Update post failed. Please try later.'));
    }

    /**
     * Destroy post
     *
     * DELETE /posts/{post}
     *
     * @param Post $post
     */
    public function destroy(Post $post)
    {
        $this->authorize('update', $post);

        if ($this->postService->delete($post)) {
            session()->flash('message-warning', trans('Delete post succesfully.'));
            return redirect(route('posts.index'));
        }

        abort(500, trans('Delete post failed. Please try later.'));
    }

    /**
     * Ajax data post
     *
     * POST /posts/{id}/data
     *
     * @param $id
     */

    public function data($id)
    {
        $post = Post::find($id);
        $parsedown = new Parsedown();

        return response()->json([
            'title' => $post->title,
            'content' => $parsedown->text($post->content)
        ]);
    }
}