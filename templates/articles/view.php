<?php
/**
 * @var \MyProject\Models\Comments\Comment $comment
 */
/**
 * @var \MyProject\Models\Articles\Article $article
 */

include __DIR__ . '/../header.php'; ?>
<h1><?= $article->getName() ?></h1>
<p><?= $article->getParsedText() ?></p>
<p>Автор: <?= $article->getAuthor()->getNickname() ?></p>
<?php if (!empty($user) && $user->isAdmin()): ?>
    <a href="http://myproject.loc/articles/<?= $article->getId() ?>/edit">Изменить статью </a>
<?php endif; ?>
<?php include __DIR__ . '/../articles/addComment.php'; ?>



<?php include __DIR__ . '/../footer.php'; ?>
