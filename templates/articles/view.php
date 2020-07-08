<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4><?= $article->getName() ?></h4>
                <p><?= $article->getText() ?></p>
                <?php if ($user !== null && $user->getRole() === 'admin'): ?>
                <a class="btn btn-outline-primary" href="/articles/<?= $article->getId() ?>/edit">Редактировать</a>
                    <a class="btn btn-outline-primary" href="/articles/<?= $article->getId() ?>/delete">Удалить</a>
                <?php endif; ?>
            </div>
            <?php include __DIR__ . '/../menu.php'; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
