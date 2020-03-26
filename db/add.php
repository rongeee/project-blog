<?php

    require_once "../header.php";
    require_once "./db.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = htmlspecialchars( $_POST['title']);
        $author = htmlspecialchars( $_POST['author']);
        $message = htmlspecialchars( $_POST['message']);

        require "./upload.php";
        $file_upload = htmlspecialchars( $_FILES['fileToUpload']['name'] );
        $embed = $_POST['embed'];

        
        $sql = "INSERT INTO proj_posts(title, author, message, image, embed) VALUES (:title, :author, :message, :image, :embed)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":image", $file_upload);
        $stmt->bindParam(":embed", $embed);

        $stmt->execute();

        header('Location:../index.php');
    }


?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    <h2>Create Post</h4>
    <label for="title">Subject</label>
    <input type="text" name="title" required>

    <label for="author">Author</label>
    <input type="text" name="author" required>

    <label for="message">Message</label>
    <textarea type="text" name="message" required></textarea>

    <label for="image">Image</label>
    <input type="file" name="fileToUpload" required>

    <label for="embed">Embed Video/Map</label>
    <input type="text" name="embed">

    <input type="submit" value="Publish">
</form>