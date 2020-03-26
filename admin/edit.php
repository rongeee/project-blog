<?php
    require_once '../header.php';
    require_once '../db/db.php';

    if (isset($_GET['id'])){
        $id = htmlspecialchars($_GET['id']);
        $sql = "SELECT * FROM proj_posts WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id' , $id );
        $stmt->execute();

        if ($stmt->rowCount() > 0){
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $title = $row['title'];
          $message = $row['message'];
        } else {
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
        $author = htmlentities($_POST['author']);
        $image = htmlentities($_POST['image']);
        $embed = htmlentities($_POST['embed']);
        $id   = htmlentities($_POST['id']);

        require "../db/upload.php";
        $file_upload = htmlspecialchars( $_FILES['fileToUpload']['name'] );
      
        $sql = "UPDATE proj_posts
                SET title = :title, message = :message , author = :author, embed = :embed, image = :image
                WHERE id = :id";
      
        $stmt = $db->prepare($sql);
      
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':message' , $message);
        $stmt->bindParam(':author' , $author);
        $stmt->bindParam(':embed' , $embed);
        $stmt->bindParam(':id'  , $id);
        
        if ($image != $file_upload && isset($file_upload)) {
          $stmt->bindParam(':image' , $file_upload);
        } else {
          $stmt->bindParam(':image' , $image);
        }
        
        
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
      value="<?php echo $title ?>"
      required
    >

    <label for="author">Author</label>
    <input 
      name="author"
      type="text" 
      value="<?php echo $author ?>"
      required
    >

    <label for="message">Message</label>
    <textarea name="message" placeholder="Nytt meddelande" requried><?php echo $message ?></textarea>

    <label for="image">Image</label>
    <input type="file" name="fileToUpload" required>

    <label for="author">Embed Video/Map</label>
    <input 
      name="embed"
      type="text" 
      value="<?php echo $embed ?>"
      required
    >

    <input 
      type="submit" 
      value="Edit Post"
    >


<input type="hidden" name="id" value="<?php echo $id; ?>">

</form>
<?php
  require_once '../footer.php';
?>