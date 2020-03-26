<?php

require_once '../../db/db.php';

if(isset($_GET['id'])){

  $id = htmlspecialchars($_GET['id']); 
  $published = htmlspecialchars($_GET['published']); 

  if ($published == 0) {
    $sql = "UPDATE proj_posts SET isPublished = 1 WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }
  else {
    $sql = "UPDATE proj_posts SET isPublished = 0 WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }


}

header('Location:../admin');

?>