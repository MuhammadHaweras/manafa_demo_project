<?php
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Collection;

interface PostRepositoryInterface{
    public function getAllPosts() : Collection;
    public function create(array $data) : Post;
    public function show(Post $post) : Post;

    public function update(Post $post,array $data) : Post;
    public function delete(Post $post) : void;
    public function getAllCategories() : Collection;
}
