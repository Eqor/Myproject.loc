<?php
/**
 * @var \MyProject\Models\Comments\Comment $comment
 */
include __DIR__ . '/../header.php';
var_dump($comment);
?>
    <h1>Редактирование комментария</h1>
<?php if(!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
    <form action="/comments/<?= $comment->getId()?>/edit" method="post">
        <label for="name"><?= $comment->getUserComment()->getNickname() ?></label><br>
        <label for="text">Текст Комментария</label><br>
        <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? $comment->getTextComment() ?></textarea><br>
        <br>
        <input type="submit" value="Обновить">
    </form>
<?php include __DIR__ . '/../footer.php'; ?>