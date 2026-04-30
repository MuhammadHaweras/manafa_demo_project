<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Collection;

class PostService
{
    public function __construct(protected  PostRepositoryInterface $postRepository){

    }

    public function getAllPosts() : Collection
    {
        return $this->postRepository->getAllPosts();
    }

    public function getAllCategories() : Collection{
        return $this->postRepository->getAllCategories();
    }

    public function show(Post $post) : Post
    {
        return $this->postRepository->show($post);
    }
    public function create(array $data) : Post{
        return $this->postRepository->create($data);
    }

    public function update(Post $post, array $data) : Post{
       return $this->postRepository->update($post, $data);
    }

    public function delete(Post $post) : void{
        $this->postRepository->delete($post);
    }
}
