<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "db.php";
$result = $conn->query("SELECT * FROM tasks ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Task App</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="app.css">
    </head>
    <body>
        <h1>My Tasks</h1>
        <a href="create.php">+Add Task</a>
        <div class="tasks">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="task">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <span class="task-status"><?php echo $row['status']; ?></span>
                    <div>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this task?');">Delete</a>
                    </div>
                </div>
                <div class="task full">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <span class="task-status"><?php echo $row['status']; ?></span>
                    <div>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this task?');">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </body>
    <script>
        const taskStatus = document.querySelectorAll('.task-status');

        for (let i=0; i<taskStatus.length; i++){
            if(taskStatus[i].innerText === 'pending'){
            taskStatus[i].style.color = 'gray';
            }else if(taskStatus[i].innerText === 'done'){
                taskStatus[i].style.color = 'rgba(40, 206, 84, 1)';
            }else if(taskStatus[i].innerText = 'in_progress'){
                taskStatus[i].style.color = 'goldenrod';
        }}
    </script>
</html>
<?php $conn->close(); ?>