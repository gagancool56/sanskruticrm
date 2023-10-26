<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="<?= base_url() ?>" class="brand-wrap">
            <img src="<?= asset_url('imgs/theme/logo.svg', 'assets/admin/') ?>" class="logo" alt="<?= business_info('buname') ?>" />
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <?php foreach ($navigation as $nav) : ?>
                <li class="menu-item <?= @$nav['class'] ?>">
                    <a class="menu-link" href="<?= base_url(@$nav['url']); ?>">
                        <i class="<?= $nav['icon'] ?>"></i>
                        <span class="text"><?= $nav['descr'] ?></span>
                    </a>
                    <?php if (isset($nav['submenu'])) : ?>
                        <div class="submenu">
                            <?php foreach ($nav['submenu'] as $submenu) : ?>
                                <a href="<?= base_url($submenu['url']) ?>"><?= $submenu['descr'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </li>
                <hr>
            <?php endforeach; ?>
        </ul>
    </nav>
</aside>