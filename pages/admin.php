<?php
    require_once './header.php';
?>
<div class="order-category">
    <div>ID</div>
    <div>Datum</div>
    <div>Namn</div>
    <div>Titel</div>
    <div>Image</div>
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
    $image = $row['image'];
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
    <div><?= $image; ?></div>
</div>
<?php
}
?>

