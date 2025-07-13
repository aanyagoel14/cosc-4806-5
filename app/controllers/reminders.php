<?php

class Reminders extends Controller {

    private function require_login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
        return $_SESSION['user_id'];
    }
    
    public function index() {	
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            header('Location: /login');
            exit();
        }
        $reminder = $this->model('Reminder');
        $list_of_reminders = $reminder->get_all_reminders($user_id);
	    $this->view('reminders/index', ['reminders' => $list_of_reminders]);
    }

    public function create(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            header('Location: /login');
            exit();
        }
        $R = $this->model('Reminder');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subject = $_POST['subject'];
            $description = $_POST['description']; // optional
            $R->create_reminder($user_id, $subject, $description);
            header('Location: /reminders/index');
            exit();
        }

        $this->view('reminders/create');
    }        


    public function update($id = null) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            header('Location: /login');
            exit();
        }
        $R = $this->model('Reminder');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $subject = $_POST['subject'];
            $description = $_POST['description'];
            $R->update_reminders($id, $subject, $description);
            header('Location: /reminders/index');
            exit();
        }

        $reminder = $R->get_all_reminders($id);
        $this->view('reminders/update', ['reminder' => $reminder]);
    }

    public function delete($id = null){
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? null;
        if (!$user_id) {
            header('Location: /login');
            exit();
        }
        if ($id) {
            $R = $this->model('Reminder');
            $R->delete_reminder($id, $user_id);
        }
        header('Location: /reminders/index');
        exit();
    }
    }


