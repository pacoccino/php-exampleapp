<section id="itemList">
    <h1>
        <?= $itemName ?> list
    </h1>
    <ul>
        <?php foreach($items as $item) { ?>
            <li>
                <span>🎶</span>
                <a href="<?= $itemPage.'&id='.$item['id']; ?>">
                    <?= htmlspecialchars($item['title']); ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</section>