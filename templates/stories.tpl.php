<ul>
    <?php foreach($stories as $story): ?>
        <li class="<?php print $story['color']; ?>"><?php print $story['text']; ?></li>
    <?php endforeach; ?>
</ul>
