<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4>Создание новой статьи</h4>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert"><?= $error ?></div>
                <?php endif; ?>
                <form action="/articles/add" method="post">
                    <div class="form-group">
                        <label for="name">Название статьи</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?= $_POST['name'] ?? '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="text">Текст статьи</label>
                        <textarea class="form-control" name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? '' ?></textarea>
                    </div>
                    <input class="btn btn-outline-primary" type="submit" value="Создать">
                </form>
            </div>
            <?php include __DIR__ . '/../menu.php'; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>

