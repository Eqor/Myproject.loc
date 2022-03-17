<?php
/**
 * @var \MyProject\Models\Comments\Comment $comments
 */

/**
 * @var \MyProject\Models\Articles\Article $articles
 */
 include __DIR__ . '/../header.php'; ?>

<?php if (!empty($user) && ($user->isAdmin())):?>
    <table>
        <tr>
            <td>
                <h2>Список последник статей</a></h2>
                <?php foreach ($articles as $article ): ?>

                    <h3>Названия Статьи<?= $article->getName() ?></h3>| <a href="http://myproject.loc/articles/<?= $article->getId() ?>/edit">Изменить статью </a>
                    <p><?= $article->getShortText() ?></p>
                    <p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
                    <hr>
                <?php endforeach; ?>
            </td>

            <td>
                <h2>Список последник комментариев</a></h2>
                <?php foreach ($comments as $comment ): ?>
                    <label for="name">Имя пользователя : <?= $comment->getUserComment()->getNickname() ?></label> | <a href="http://myproject.loc/comments/<?= $comment->getId() ?>/edit">Исправить комментарий </a>| Удалить
                    <br>
                    <?= $comment->getTextComment() ?>
                    <hr>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>
<?php endif; ?>





<?php include __DIR__ . '/../footer.php'; ?>