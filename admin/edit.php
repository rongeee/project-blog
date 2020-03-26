<?php
    require_once '/header.php';
    require_once '/db/db.php';

    if(isset($_GET['id'])){
        $id = htmlspecialchars($_GET['id']);
        $sql = "SELECT * FROM proj_posts WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id' , $id );
        $stmt->execute();
      
        if($stmt->rowCount() > 0){
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $title = $row['title'];
          $message = $row['message'];
        }else{
          header('Location:../admin');
          exit;
        }
      
      } else {
        header('Location:../admin');
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
        header('Location: ../admin');
        exit;
      }
?>

<form action="#" method="POST">
    <h2>Edit Post</h2>
    <label for="title">Subject</label>
    <input 
      name="title"
      type="text" 
      placeholder="Ange ny titel" 
      value="<?php echo $title ?>"
    >
    <label for="message">Message</label>
    <textarea name="message" placeholder="Nytt meddelande"><?php echo $message ?></textarea>
    <input 
      type="submit" 
      value="Uppdatera"
    >

<input type="hidden" name="id" value="<?php echo $id; ?>">

</form>
<?php
  require_once '/footer.php'
?>