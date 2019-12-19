<div class="wrapper">
    <?php foreach ($thermo as $figura): ?>
        <div class="figure <?php print $figura['form'] . ' ' . $figura['color']; ?>">
            <?php if(isset($figura['text'])) : ?>
                <span><?php print $figura['text']; ?></span>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>