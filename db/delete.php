<?php

require "../pages/header.php";
require "db.php";

if(isset($_GET['id'])){

  $id = htmlspecialchars($_GET['id']); 

  $sql = "DELETE FROM proj_posts WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}

header('Location:../pages/admin.php');

?>