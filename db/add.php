<?php

    require "db.php";
    echo $_SERVER['REQUEST_METHOD'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = htmlspecialchars( $_POST['title']);
        $author = htmlspecialchars( $_POST['author']);
        $message = htmlspecialchars( $_POST['message']);
        
        require "upload.php";
        $file_upload = htmlspecialchars( $_POST['fileToUpload']);
        $embed = htmlspecialchars( $_POST['embed']);

        
        $sql = "INSERT INTO proj_posts(title, author, message, image) VALUES (:title, :author, :message, :image, :embed)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":image", $file_upload);
        $stmt->bindParam(":embed", $embed);
        $stmt->execute();
    }


?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    <h4>Create post</h4>
    <input type="text" name="title">
    <input type="text" name="author">
    <input type="text" name="message">
    <input type="file" name="fileToUpload">
    <input type="text" name="embed">
    <input type="submit"
    class="form-control my-2 btn btn-outline-success"
    value="Publish">
</form>