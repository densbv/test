<div class="col-4">
    <td width="300px" class="sidebar">
        <div class="sidebarHeader">Меню</div>
        <ul>
            <li><a href="/">Главная страница</a></li>
            <li><a href="/about-me">Обо мне</a></li>
        </ul>
        <?php if (empty($user)): ?>
            <div class="sidebarHeader">Для входа</div>
            <ul>
                <li>Login: admin@gmail.com</li>
                <li>Pass: 12345678</li>
            </ul>
        <?php elseif ($user->getRole() === 'admin'): ?>
            <ul>
                <li><a href="/articles/add">Добавить статью</a></li>
            </ul>
        <?php endif; ?>
    </td>
</div>
   


