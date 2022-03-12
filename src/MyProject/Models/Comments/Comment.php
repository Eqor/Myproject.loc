<?php

namespace MyProject\Models\Comments;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Services\Db;
use MyProject\Exceptions\InvalidArgumentException;

class Comment extends ActiveRecordEntity
{
    private const TABLE_NAME = 'comments';

    /** @var int */
    protected $userId;

    /** @var int */
    protected $articleId;

    /** @var string */
    protected $text;

    /** @var string */
    protected $createdAt;

    /**
     * @param User $user
     */
    public function setUserComment(User $user): void
    {
        $this->userId = $user->getId();
    }





    /**
     * @param string $text
     */
    public function setTextComment(string $text): void
    {
        $this->text = $text;
    }
    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }


    public static function getAllCommentsByArticle(int $articleId): array
    {
        $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM ' . self::TABLE_NAME . ' WHERE article_id = :article_id',
            [
                'article_id' => $articleId
            ], self::class
        );
    }

    public static function createComment(array $fields, User $user,int $articleId): Comment
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст ');
        }
        $comment = new Comment();
        $comment->setArticleId($articleId);
        $comment->setUserComment($user);
        $comment->setTextComment($fields['text']);

        $comment->save();

        return $comment;
    }

    public function updateComment(array $fields): Comment
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст  комментария');
        }
        $this->setTextComment($fields['text']);
        $this->save();

        return $this;
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }

    /**
     * @return string
     */
    public function getTextComment(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    /**
     * @return User
     */
    public function getUserComment(): User
    {
        return User::getById($this->userId);
    }


}