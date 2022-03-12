<?php

namespace MyProject\Controllers;


use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Comments\Comment;

class CommentsController extends AbstractController
{
    public function view(int $articleId): void
    {
        $comments = Comment::getAllCommentsByArticle( $articleId);
        var_dump($comments);

        if ($comments === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('comments/view.php', [
            'comments' => $comments
        ]);
    }


}