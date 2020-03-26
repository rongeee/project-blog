<div class="admin-title">
    <h1 >ADMINISTRATION</h1>
    <a href="db/add.php"><button>ADD POST</button></a>
</div>


<div class="order-category">
    <div>ID</div>
    <div>Date</div>
    <div>Author</div>
    <div>Title</div>
    <div>Message</div>
    <div>Admin</div>
</div>
<?php
  require_once '../db/db.php';

$sql = "SELECT * FROM proj_posts ORDER BY date DESC";

$stmt = $db -> prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $date = $row['date'];
    $title = $row['title'];
    $author = $row['author'];
    $msg = $row['message'];
    $isPublished = $row['isPublished'];
    $publishText = '';
    if ($isPublished == 1) {
        $publishText = "Unpublish";
    }
    else {
        $publishText = "Publish";
    }
    ?>

<div class="order-card">
    <div><?= $id; ?></div>
    <div><?= $date; ?></div>
    <div><?= $author; ?></div>
    <div><?= $title; ?></div>
    <div><?= $msg; ?></div>
    <div class="admin">
        <a class="admin-btn edit" href='<?= "admin/edit.php?id=$id"?>'>Edit</a>
        <a class="admin-btn admin-edit" href='<?= "admin/delete.php?id=$id"?>'>Delete</a>
        <a class="admin-btn publish" href='<?= "admin/publish.php?id=$id&published=$isPublished"?>'><?= $publishText; ?> </a>
    </div>
</div>
<?php
}
?>