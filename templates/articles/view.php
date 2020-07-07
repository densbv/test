<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <?php if ($user->getRole() === 'admin'): ?>
    <a href="/articles/<?= $article->getId()?>/edit">Редактировать</a>
    <a href="/articles/<?= $article->getId()?>/delete">Удалить</a>
    <?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>
