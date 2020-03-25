<?php
    require_once './header.php';
?>
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

$sql = "SELECT * FROM proj_posts";

$stmt = $db -> prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $date = $row['date'];
    $title = $row['title'];
    $author = $row['author'];
    $msg = $row['message'];
   // $embed = $row['embed'];
   if (empty($image)) {
    // CHANGE IMG URL RETARD
    $image= "1.jpg";
    } else {
        $image = "$image";
    };
    ?>

<div class="order-card">
    <div><?= $id; ?></div>
    <div><?= $date; ?></div>
    <div><?= $author; ?></div>
    <div><?= $title; ?></div>
    <div><?= $msg; ?></div>
    <div class="admin">
        <a href='<?= "../db/edit.php?id=$id"?>'><p class="edit">Edit</p></a>
        <a href='<?= "../db/delete.php?id=$id"?>' class="admin-edit"><p class="delete">Delete</p></a>
    </div>
</div>
<?php
}
?>

