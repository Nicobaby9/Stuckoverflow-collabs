<?php

/**
 * Created by PhpStorm.
 * User: webdev
 * Date: 4/23/2017
 * Time: 7:35 AM
 */

namespace App;


trait CommentableTrait
{

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }


    public function addComment($isi)
    {
        $comment = new Jawaban();
        $comment->isi = $isi;
        $comment->user_id = auth()->user()->id;

        $this->comments()->save($comment);

        return $comment;
    }
}
