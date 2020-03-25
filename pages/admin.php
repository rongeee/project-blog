<?php

?>
<div class="order-category">
    <div>Ordernr</div>
    <div>Datum</div>
    <div>Namn</div>
    <div>Titel</div>
    <div>Pris</div>
</div>
<?php
    require_once './db/db.php';

$sql = "SELECT * FROM proj_posts";

$stmt = $db -> prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $date = $row['date'];
    $title = $row['title'];
    $author = $row['author'];
   // $image = $row['image'];
   // $embed = $row['embed'];
}
?>

<div class="order-card">
    <div><?= $id; ?></div>
    <div><?= $date; ?></div>
    <div><?= $name; ?></div>
    <div><?= $title; ?></div>
    <div><?= $price; ?></div>
</div>