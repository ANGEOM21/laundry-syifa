<?php
$icons = [['Edit Profile' => ['/img/users/icons/edit.svg', 'user']], ['Proses-Laundry' => ['/img/users/icons/proses.svg', 'user/proses']], ['Log Out' => ['/img/users/icons/logout.svg', 'user/logout']], ['Help' => ['/img/users/icons/help.svg', 'user/help']], ['FAQ' => ['/img/users/icons/faq.svg', 'user/faq']]];
?>

<div class="sidebar-edit-user" id="sidebar-edit-user">
    <div class="list-items-edit-user">
        <?php foreach ($icons as $icon) : ?>
            <?php foreach ($icon as $k => $v) : ?>
				<?php 
                $requestUri = $_SERVER['REQUEST_URI'];
                $url = rtrim(ltrim($requestUri, '/'), '/');
                ?>
                <di class="icons">
                    <a href="<?= BASEURL ."/". $v[1] ?>" class="<?= $url === $v[1] ? 'active' :"" ?>">
                        <img src="<?= BASEURL . $v[0] ?>" alt="icon">
                        <?= $k ?>
                    </a>
                </di>
            <?php endforeach ?>
        <?php endforeach ?>
    </div>
</div>