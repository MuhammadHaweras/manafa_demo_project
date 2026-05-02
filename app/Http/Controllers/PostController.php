<?php

namespace App\Http\Controllers;

use App\Events\PostPublished;
use App\Http\Requests\StorePostRequest;
use App\Mail\NewPostCreated;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function __construct(protected PostService $postService)
    {

    }
    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = $this->postService->getAllCategories();

        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        try {
            $post = $this->postService->create($request->validated());

            // $users = User::all();
            // foreach ($users as $index => $user) {
            //     Mail::to($user->email)->later( now()->addSeconds( $index +1) ,new NewPostCreated($post));
            // }

            PostPublished::dispatch($post);
            
            return redirect()->route('posts.index');
        }catch (UniqueConstraintViolationException $exception){
            return back()->withInput()->withErrors(['title' => 'Title is already taken']);
        }
    }

    public function show(Post $post)
    {
        $post = $this->postService->show($post);
        $post->load(['topLevelComments.user', 'topLevelComments.replies.user']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = $this->postService->getAllCategories();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        if(! Gate::allows('update', $post)){
            abort(403);
        }

        try {
            $this->postService->update($post, $request->validated());
            return redirect()->route('posts.index');
        }catch (UniqueConstraintViolationException $exception){
            return back()->withInput()->withErrors(['title' => 'Title is already taken']);
        }
    }

    public function destroy(Post $post)
    {
        if(! Gate::allows('delete', $post)){
            abort(403);
        }

        $this->postService->delete($post);

        return redirect()->route('posts.index');
    }
}
