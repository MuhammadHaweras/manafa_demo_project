<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    
    public function index()
    {
       $topLevelComments = Comment::with(["user", "post"])->whereNull('parent_id')->with('parent')->get();
       $replies = Comment::with(["user","post"])->whereNotNull('parent_id')->with('parent')->get();
       return view("admin.comments.index", ["comments"=> $topLevelComments,"replies"=> $replies]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index');
    }
}
