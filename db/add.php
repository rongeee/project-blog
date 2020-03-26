<?php

    require_once "/header.php";
    require_once "/db/db.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = htmlspecialchars( $_POST['title']);
        $author = htmlspecialchars( $_POST['author']);
        $message = htmlspecialchars( $_POST['message']);
        $trimmedMsg = '';
        foreach (explode("\n", $message) as $line) {
            if (trim($line) && !empty($line)) {
                $trimmedMsg .= '<p class="blog-entry__text">' . $line . '</p>';
            }

        require "./upload.php";
        $file_upload = htmlspecialchars( $_FILES['fileToUpload']['name'] );
        $embed = $_POST['embed'];

        
        $sql = "INSERT INTO proj_posts(title, author, message, image, embed) VALUES (:title, :author, :message, :image, :embed)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":message", $trimmedMsg);
        $stmt->bindParam(":image", $file_upload);
        $stmt->bindParam(":embed", $embed);

        $trimmedMsg = '';
        foreach (explode("\n", $msg) as $line) {
            if (trim($line) && !empty($line)) {
                $trimmedMsg .= '<p class="blog-entry__text">' . $line . '</p>';
            }
        }


        $stmt->execute();
    }


?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    <h2>Create Post</h4>
    <label for="title">Subject</label>
    <input type="text" name="title">
    <label for="author">Author</label>
    <input type="text" name="author">
    <label for="message">Message</label>
    <textarea type="text" name="message"></textarea>
    <label for="image">Image</label>
    <input type="file" name="fileToUpload" required>
    <label for="embed">Embed Video/Map</label>
    <input type="text" name="embed">
    <input type="submit"
    class="form-control my-2 btn btn-outline-success"
    value="Publish">
</form>

<?php
    require_once '/footer.php'
?>