<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <div class="alert alert-warning" role="alert">
                    <h3>Вы не авторизованы</h3>
                </div>
                Для доступа к этой странице нужно <a href="/users/login">войти на сайт</a>
            </div>
            <?php include __DIR__ . '/../menu.php'; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>

