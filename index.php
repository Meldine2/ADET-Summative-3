<?php
session_start();
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['new_task'])) {
        $_SESSION['todos'][] = $_POST['new_task'];
    } elseif (isset($_POST['delete_task'])) {
        unset($_SESSION['todos'][$_POST['delete_task']]);
        $_SESSION['todos'] = array_values($_SESSION['todos']);
    } elseif (isset($_POST['edit_task'])) {
        $_SESSION['todos'][$_POST['task_index']] = $_POST['edited_task'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime To-do App</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1>Anime To-do App</h1>
        </div>
    </header>

    <main>
        <div class="container">
            <form method="POST" class="new-task-form">
                <input type="text" name="new_task" placeholder="New task" required>
                <button type="submit">Add Task</button>
            </form>

            <ul class="task-list">
                <?php foreach ($_SESSION['todos'] as $index => $task): ?>
                    <li>
                        <span><?php echo htmlspecialchars($task); ?></span>
                        <div class="task-actions">
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="delete_task" value="<?php echo $index; ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="task_index" value="<?php echo $index; ?>">
                                <input type="text" name="edited_task" placeholder="Edit task" required>
                                <button type="submit" name="edit_task" class="edit-btn">Edit</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
