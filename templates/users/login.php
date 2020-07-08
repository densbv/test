<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h4 class="card-title text-center">Вход</h4>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert"><?= $error ?></div>
                    <?php endif; ?>
                    <form class="form-signin" action="/users/login" method="post">
                        <div class="form-group">
                            <label for="inputEmail">Эл. адрес</label>
                            <input type="email" id="inputEmail" class="form-control" name="email" value="<?= $_POST['email'] ?? '' ?>" placeholder="Email address" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Пароль</label>
                            <input type="password" id="inputPassword" class="form-control" name="password" value="<?= $_POST['password'] ?? '' ?>" placeholder="Password" required>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>

