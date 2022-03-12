<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;


class ArticlesController extends AbstractController
{

    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);


        if ($article === null) {
            throw new NotFoundException();
        }

        $comments = Comment::getAllCommentsByArticle($articleId);
        if ($comments === null) {
            throw new NotFoundException('Комментарии отсутствуют');
        }


        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        if (!$this->user->isAdmin() )
            throw new Forbidden('Для редактирования статьи нужно обладать правами администратора');


        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
        if (!$this->user->isAdmin() )
            throw new Forbidden('Для добавления статьи нужно обладать правами администратора');
        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST,$this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');

    }

    public function addComment(int $articleId): void
    {
            if (!empty($_POST)) {
                try {
                    $comment = Comment::createComment($_POST, $this->user, $articleId);
                }catch(InvalidArgumentException $e){
                    $this->view->renderHtml('articles/view.php',
                        [
                            'error' => $e->getMessage(),
                            'article' => Article::getById($articleId),
                            'comments' => Comment::getAllCommentsByArticle($articleId)
                        ]
                    );
                    return;
                }
                header('Location: /articles/' .$articleId.'#comment'.$comment->getId(), true, 302);
                exit();
            }
            $this->view->renderHtml('articles/'.$articleId);

    }

    public function editComment(int $commentId)
    {
        $comment = Comment::getById($commentId);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }


        if (!empty($_POST)) {
            try {
                $comment->updateComment($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/editComment.php', ['error' => $e->getMessage(), 'comment' => $comment]);
                return;
            }

            header('Location: /articles/' .$comment->getArticleId().'#comment'.$comment->getId(), true, 302);
            exit();
        }
        $this->view->renderHtml('articles/editComment.php', ['comment' => $comment]);

    }
}
