<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
            <?php if (!isset($error)): ?>
            <?php if (!empty($user)): ?>
            Привет, <?= $user->getNickname() ?> | <a href="http://myproject.loc/articles/add">Добавить
                статью</a>
            <?php if ($user->isAdmin()): ?>
            | <a href="http://myproject.loc/admin/">Админка
                <? endif; ?>
                | <a href="http://myproject.loc/users/logOut">Выйти</a>

                <?php else: ?>
                    <a href="http://myproject.loc/users/login">Войти</a> | <a
                            href="http://myproject.loc/users/register">Зарегестрироваться</a>
                <? endif; ?>
                <? endif; ?>

        </td>
    </tr>
    <tr>
        <td>