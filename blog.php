<div class="container">
    <?php
    require_once './db/db.php';
    $stmt = $db->prepare("SELECT * FROM proj_posts WHERE isPublished = 1 ORDER BY date DESC");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
        $id= $row['id'];
        $title = $row['title'];
        $image = $row['image'];
        $author = $row['author'];
        $date = $row['date'];
        $msg = $row['message'];
        $embed = $row['embed'];
        $trimmedMsg = '';
    
        foreach (explode("\n", $msg) as $line) {
            if (trim($line) && !empty($line)) {
                $trimmedMsg .= '<p class="blog-entry__text">' . $line . '</p>';
            }
        }
        if (!empty($image)) {
            $image = "./db/uploads/$image";
        };
    ?>

    <div class="blog-entry">
        <div class="blog-entry__header">
            <h2 class="blog-entry__title"><?= $title; ?></h2>
        </div>
        <div class="blog-entry__image-wrap"><img class="blog-entry__image" src="<?= $image; ?>" alt="<?= $title; ?>"></div>
        <?= $trimmedMsg ?>
        <div class="embed-wrap">
            <?php 
                if (!empty($embed)){
                    echo $embed;
                }
            ?>
        </div>
        <div class="blog-entry__author">
            <small>Published by - <strong><?= $author; ?></strong></small>
            <small class="blog-entry__date"><?= $date; ?></small>
        </div>

    </div>
<?php

    endwhile;

?>
</div>
