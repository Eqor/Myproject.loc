<?php
/**
 * @var \MyProject\Models\Comments\Comment $comments
 */
/**
 * @var \MyProject\Models\Articles\Article $article
 */
?>

<?php if (!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
<?php if (!empty($user) ): ?>
<form action="/articles/<?= $article->getId() ?>/comment" method="post">
    <br>
    <label for="text">Написать комментарий</label><br>
    <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? ''?></textarea><br>
    <br>
    <input type="submit" value="Отправить">
    </form><?php else: ?>
    <p>Войдите, чтобы написать комментарий</p>
<?php endif; ?>
<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <h3><?= $comment->getUserComment()->getNickname() ?> | Дата комментария <?= $comment->getTimeCreatedComment()?></h3>
        <p><?= $comment->getTextComment() ?></p>
        <?php if (!empty($user) && ($user->isAdmin() || ($user->getId() === $comment->getUserComment()->getId()))):?>
            <a href="http://myproject.loc/comments/<?= $comment->getId() ?>/edit">Исправить комментарий </a>
        <?php endif; ?>
        <hr>
    <?php endforeach; ?>


<?php else: ?>
    <p>НЕТ КОММЕНТАРИЕВ</p>
<?php endif; ?>