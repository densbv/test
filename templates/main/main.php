<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <?php foreach ($articles as $article): ?>
                    <h4><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h4>
                    <p><?= $article->getText() ?></p>
                    <hr>
                <?php endforeach; ?>
            </div>
            <?php include __DIR__ . '/../menu.php'; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>

