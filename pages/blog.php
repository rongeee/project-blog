<div class="container">
    <h1>pls crate nice blog content here thank u</h1>

    <?php
    require_once './db/db.php';
    $stmt = $db->prepare("SELECT * FROM proj_posts");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
        $id= $row['id'];
        $title = $row['title'];
        $image = $row['image'];
        $author = $row['author'];
        $date = $row['date'];
        $msg = $row['message'];

        if (empty($image)) {
            // CHANGE IMG URL RETARD
            $image= "./db/uploads/1.jpg";
            } else {
                $image = "./db/uploads/$image";
            };
    ?>

    <div class="blog-entry">
        <div class="blog-entry__header">
            <h2 class="blog-entry__title"><?= $title; ?></h2>
            <small class="blog-entry__date"><?= $date; ?></small>
        </div>
        <img class="blog-entry__image" src="<?= $image; ?>" alt="<?= $title; ?>">
        <p class="blog-entry__msg"><?= $msg; ?></p>
        <small class="blog-entry__author"><?= $author; ?></small>
    </div>
<?php

    endwhile;

?>
</div>
