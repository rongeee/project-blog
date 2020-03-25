<?php

    require "db.php";

    echo $_SERVER['REQUEST_METHOD'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = htmlspecialchars( $_POST['title']);
        $author = htmlspecialchars( $_POST['author']);
        $message = htmlspecialchars( $_POST['message']);
        
        $sql = "INSERT INTO proj_posts(title, author, message) VALUES (:title, :author, :message)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":message", $message);
        $stmt->execute();
    }


?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <h4>Create post</h4>
    <input type="text" name="title">
    <input type="text" name="author">
    <input type="text" name="message">
    <input type="submit"
    class="form-control my-2 btn btn-outline-success"
    value="Publish">
</form>