<?php

class Reminder {
    public function __construct() {

    }

    public function get_all_reminders($user_id) {
      $db = db_connect();
      $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = ? ORDER BY created_at DESC");
      $statement->execute([$user_id]);
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function create_reminder($user_id, $subject, $description) {
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO reminders (user_id, subject, description, created_at) VALUES (?, ?, ?, NOW())");
        $statement->execute([$user_id, $subject, $description]);
    }


    public function update_reminders($id, $subject, $description) {
        $db = db_connect();
        $statement = $db->prepare("UPDATE reminders SET subject = ?, description = ? WHERE id = ?");
        $statement->execute([$subject, $description, $id]);
    }

    public function delete_reminder($id, $user_id) {
        $db = db_connect();
        $stmt = $db->prepare("DELETE FROM reminders WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $user_id]);
    }

}