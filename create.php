<?php
require "db.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $status = $_POST["status"];

    $stmt = $conn->prepare("INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $status);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link rel="stylesheet" href="app.css">
</head>
<body class="create-body">
    <h2>Add Task</h2>
    <form method="post" action="create.php">
        <div>
            <label>Title</label><br>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Description</label><br>
            <textarea name="description"></textarea>
        </div>

        <div>
            <label>Status</label>
            <select name="status">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="done">Done</option>
            </select>
        </div>

        <button type="submit">Save Task</button>
    </form>
    <a href="index.php">Back</a>
</body>
</html>