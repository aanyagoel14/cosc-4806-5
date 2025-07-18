<?php
class Reports extends Controller {
    private function require_admin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 1 || 
            !isset($_SESSION['username']) || strtolower($_SESSION['username']) !== 'admin') {

            if (!headers_sent()) {
                header('Location: /home');
            }
            exit();
        }
    }

    public function index() {
        $this->require_admin();

        $reminder = $this->model('Reminder');
        $data = [
            'all_reminders' => $reminder->get_all_reminders_admin(),
            'most_reminders' => $reminder->get_users_with_most_reminders(),
            'login_counts' => $reminder->get_login_counts()
        ];

        $this->view('reports/index', $data);
    }
}