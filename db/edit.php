<?php
    require_once '../pages/pages_header.php';
    require_once 'db.php';

    if(isset($_GET['id'])){
        $id = htmlspecialchars($_GET['id']);
        $sql = "SELECT * FROM proj_posts WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id' , $id );
        $stmt->execute();
      
        if($stmt->rowCount() > 0){
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $title = $row['title'];
          $message  = $row['message'];
        }else{
          header('Location:../pages/admin.php');
          exit;
        }
      
      } else {
        header('Location:../pages/admin.php');
        exit;
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $title = htmlentities($_POST['title']);
        $message  = htmlentities($_POST['message']);
        $id   = htmlentities($_POST['id']);
      
        $sql = "UPDATE proj_posts
                SET title = :title, message = :message 
                WHERE id = :id";
      
        $stmt = $db->prepare($sql);
      
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':message' , $message);
        $stmt->bindParam(':id'  , $id);
      
        $stmt->execute();
        header('Location: ../pages/admin.php');
        exit;
      }
?>

<form action="#" method="POST">

<div class="row">

  <div>
    <input 
      name="title"
      type="text" 
      placeholder="Ange ny titel" 
      value="<?php echo $title ?>"
    >
  </div>
  <div>
    <input 
      name="message"
      type="textarea" 
      placeholder="Nytt meddelande" 
      value="<?php echo $message ?>"
    >
  </div>
  <div class="">
    <input 
      type="submit" 
      value="Uppdatera"
    >
  </div>

</div>

<input type="hidden" name="id" value="<?php echo $id; ?>">

</form>