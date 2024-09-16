document.addEventListener('DOMContentLoaded', function() {
    // Handle adding new task
    document.getElementById('taskForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let taskInput = document.getElementById('taskInput').value;

        if (taskInput) {
            // Send AJAX request to save the task
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?action=addTask', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page to show updated task list
                    location.reload();
                }
            };

            xhr.send('task=' + encodeURIComponent(taskInput));
        }
    });

    // Handle deleting tasks
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            let taskId = this.dataset.id;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?action=deleteTask', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page to show updated task list
                    location.reload();
                }
            };

            xhr.send('id=' + encodeURIComponent(taskId));
        });
    });

    // Handle task completion toggling
    document.querySelectorAll('.toggle-completed').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let taskId = this.dataset.id;
            let completed = this.checked ? 'true' : 'false';

            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'index.php?action=toggleTask&id=' + encodeURIComponent(taskId) + '&completed=' + completed, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Reload the page to show updated task list
                    location.reload();
                }
            };

            xhr.send();
        });
    });
});
