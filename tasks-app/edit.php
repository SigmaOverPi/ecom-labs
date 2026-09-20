<?php
require "db.php";

$id = intval($_GET["id"] ?? 0);

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $status = $_POST["status"];
    $post_id = intval($_POST["id"]);

    $stmt = $conn->prepare("UPDATE tasks SET title=?, description=?, status=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $description, $status, $post_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$task = $stmt->get_result()->fetch_assoc();
$stmt->close();

if(!$task) {die("Task not found.");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="app.css">
</head>
<body class="create-body">
    <h2>Edit Task</h2>
    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $task["id"];?>">
        <div class="form-item">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']);?>" required>
        </div>
        <div class="form-item">
            <label>Description</label>
            <textarea name="description"><?php echo htmlspecialchars($task['description']);?></textarea>
        </div>
        <div class="form-item">
            <label>Status</label>
            <select name="status">
                <option value="pending" <?php echo $task['status']==='pending'?'selected':'';?>>Pending</option>
                <option value="in_progress" <?php echo $task['status']==='in_progress'?'selected':'';?>>In Progress</option>
                <option value="done" <?php echo $task['status']==='done'?'selected':'';?>>Done</option>
            </select>
        </div>
        <button type="submit">Update Task</button>
    </form>
    <a href="index.php">Back</a>
</body>
</html>