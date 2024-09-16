<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<div class="container">
    <h1>Task Manager</h1>
    <form id="taskForm">
        <input type="text" id="taskInput" placeholder="Enter a task">
        <button type="submit">Add Task</button>
    </form>

    <ul id="taskList">
        <?php foreach ($tasks as $task): ?>
            <li>
                <input type="checkbox" class="toggle-completed"
                       data-id="<?= $task['id'] ?>" <?= $task['completed'] ? 'checked' : '' ?>>
                <span <?= $task['completed'] ? 'style="text-decoration: line-through;"' : '' ?>><?= htmlspecialchars($task['task']) ?></span>
                <button class="delete-btn" data-id="<?= $task['id'] ?>">Delete</button>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<script src="/assets/script.js"></script>
</body>
</html>
