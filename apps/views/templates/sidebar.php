<div class="app-sidebar app-navigation full-height app-navigation-style-default app-navigation-open-hover dir-left"
    data-type="close-other">
    <nav>
        <ul>
            <li class="title">MAIN</li>
            <?php foreach ($this->menu as $data) : ?>

            <li>
                <a href="<?= BASE_URL ?>assets/vendor/#"><span class="<?= $data['icon'] ?>"></span>
                    <?= $data['name'] ?></a>
                <?php foreach ($this->submenu as $dataSub) : ?>
                <?php if ($dataSub['parent_id'] == $data['menu_id']) : ?>
                <ul>
                    <li><a href="<?= BASE_URL . $dataSub['route'] ?>"><span class="<?= $dataSub['icon'] ?>"></span>
                            <?= $dataSub['name'] ?></a></li>
                </ul>
                <?php endif; ?>
                <?php endforeach; ?>

            </li>
            <?php endforeach; ?>

        </ul>
    </nav>
</div>