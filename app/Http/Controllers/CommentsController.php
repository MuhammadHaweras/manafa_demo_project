<?php

namespace App\Http\Controllers;

use App\Events\CommentPublished;
use App\Events\ReplyPublished;
use App\Mail\NewCommentCreated;
use App\Mail\NewReplyCreated;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        if($comment->parent_id && $comment->user_id != $comment->parent->user_id){
            // Mail::to($comment->parent->user->email)->later( now()->addSeconds(1) , new NewReplyCreated($comment));
            ReplyPublished::dispatch($comment);
        }else if ($comment->parent_id === null && $comment->user_id != $comment->post->user_id){
            // Mail::to($comment->post->user->email)->later( now()->addSeconds(1) , new NewCommentCreated($comment));
            CommentPublished::dispatch($comment);
        }

        return back()->with('success', 'Comment created successfully');
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        if(! Gate::allows('update-comment', $comment)){
            abort(403);
        }
        $request->validate([
            'body' => 'required',
        ]);
    
        $comment->update($request->all());
            return redirect()->route('posts.show', $comment->post)
            ->with('success', 'Post updated successfully.');
    }

     public function edit_reply(Comment $reply)
    {
        return view('comments.edit_reply', compact('reply'));
    }

    public function update_reply(Request $request, Comment $reply){
        if(! Gate::allows('update-comment', $reply)){
            abort(403);
        }
        $request->validate([
            'body' => 'required',
        ]);
    
        $reply->update($request->all());
            return redirect()->route('posts.show', $reply->post)
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if(! Gate::allows('delete-comment', $comment)){
            abort(403);
        }

        $comment->delete();
        return redirect()->route('posts.show', $comment->post)
            ->with('success', 'Post updated successfully.');
    }
}
