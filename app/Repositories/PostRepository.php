<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Collection;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(private Post $post){
    }

    public function getAllPosts() : Collection
    {
        return $this->post->with('category')->get();
    }
    public function create(array $data) : Post{
        $post = $this->post->create($data);
        return $post;
    }

    public  function show(Post $post) : Post
    {
        return $post;
    }

    public function update(Post $post, array $data) : Post  {
        $post->update($data);
        return $post->fresh();
    }

    public function delete(Post $post) : void{
        $post->delete();
    }

    public  function getAllCategories() : Collection
    {
        return Category::all();
    }
}
