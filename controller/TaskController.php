<?php
require_once 'model/TaskModel.php';

class TaskController {
    private $taskModel;

    public function __construct() {
        $this->taskModel = new TaskModel();
    }

    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;

        switch ($action) {
            case 'addTask':
                $this->addTask();
                break;
            case 'deleteTask':
                $this->deleteTask();
                break;
            case 'toggleTask':
                $this->toggleTask();
                break;
            default:
                $this->showTasks();
        }
    }

    // Add a new task
    private function addTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
            $task = $_POST['task'];
            $this->taskModel->addTask($task);
        }
        // No need to redirect after AJAX request
        exit;
    }

    // Delete a task
    private function deleteTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $this->taskModel->deleteTask($id);
        }
        exit;
    }

    // Toggle task completion status
    private function toggleTask() {
        if (isset($_GET['id']) && isset($_GET['completed'])) {
            $id = intval($_GET['id']);
            $completed = ($_GET['completed'] === 'true') ? 1 : 0;
            $this->taskModel->toggleTask($id, $completed);
        }
        exit;
    }

    // Show tasks
    public function showTasks() {
        $tasks = $this->taskModel->fetchTasks();
        require 'view/tasksView.php';
    }
}
