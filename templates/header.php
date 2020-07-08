<?php

use helpers\Helper;
?>
<!doctype html>
<html lang="ru">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <?php if ($metaTag): ?>
            <meta name="description" content="<?= Helper::html($metaTag->getDescription()) ?>">
            <meta name="keywords" content="<?= Helper::html($metaTag->getKeywords()) ?>">
            <title><?= Helper::html($metaTag->getTitle()) ?></title>
        <?php endif; ?>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">My Site</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <?php if (!empty($user)): ?>
                    <span class="navbar-text">
                        <?= Helper::html($user->getNickname()) ?> 
                    </span>
                    <span class="navbar-text">
                        <form action="/users/logout">
                            <input class="btn btn-link " type="submit" value="Выйти">
                        </form>
                    </span>
                        <?php else: ?>
                     <span class="navbar-text">
                            <a class="btn btn-link" href="/users/login">Вход</a>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

