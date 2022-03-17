<?php

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UsersAuthService;
use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\UnauthorizedException;

{
    class AdminController extends AbstractController
    {
        public function main()
        {
            if ($this->user === null) {
                throw new UnauthorizedException();
            }
            if (!$this->user->isAdmin()){
                throw new Forbidden();
            }
                $comments = Comment::findLast();
                $articles = Article::findLast();
                $this->view->renderHtml('admin/main.php', [
                'comments' => $comments,
                'articles' => $articles,
                'user' => UsersAuthService::getUserByToken(),
            ]);

        }

    }
}

