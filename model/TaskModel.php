<?php
class TaskModel {
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'rentex_task_management';

        $this->conn = mysqli_connect($host, $user, $pass, $db);

        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
    }

    // Fetch all tasks
    public function fetchTasks() {
        $query = "SELECT * FROM tasks";
        $result = mysqli_query($this->conn, $query);
        $tasks = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }

        return $tasks;
    }

    // Add a task
    public function addTask($task) {
        $task = mysqli_real_escape_string($this->conn, $task);
        $query = "INSERT INTO tasks (task) VALUES ('$task')";
        mysqli_query($this->conn, $query);
    }

    // Delete a task
    public function deleteTask($id) {
        $query = "DELETE FROM tasks WHERE id = $id";
        mysqli_query($this->conn, $query);
    }

    // Toggle task completion
    public function toggleTask($id, $completed) {
        $query = "UPDATE tasks SET completed = $completed WHERE id = $id";
        mysqli_query($this->conn, $query);
    }

    public function __destruct() {
        mysqli_close($this->conn);
    }
}
