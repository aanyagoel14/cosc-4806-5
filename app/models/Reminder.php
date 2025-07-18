<?php
class Reminder {

    public function get_all_reminders($user_id) {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = ? ORDER BY created_at DESC");
        $statement->execute([$user_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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
        $statement = $db->prepare("DELETE FROM reminders WHERE id = ? AND user_id = ?");
        $statement->execute([$id, $user_id]);
    }

    public function get_all_reminders_admin() {
        $db = db_connect();
        $statement = $db->prepare("
            SELECT r.*, u.username 
            FROM reminders r
            JOIN users u ON r.user_id = u.id
            ORDER BY r.created_at DESC
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_users_with_most_reminders() {
        $db = db_connect();
        $statement = $db->prepare("
            SELECT u.username, COUNT(r.id) as reminder_count
            FROM users u
            LEFT JOIN reminders r ON u.id = r.user_id
            GROUP BY u.id
            ORDER BY reminder_count DESC
        ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_login_counts() {
        $db = db_connect();
        try {
            $statement = $db->prepare("SHOW TABLES LIKE 'login_attempts'");
            $statement->execute();
            $tableExists = $statement->rowCount() > 0;
    
            if ($tableExists) {
                // Join on username instead of user_id
                $statement = $db->prepare("
                    SELECT u.username, COUNT(l.id) as login_count
                    FROM users u
                    LEFT JOIN login_attempts l ON u.username = l.username
                    GROUP BY u.id
                    ORDER BY login_count DESC
                ");
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $statement = $db->prepare("
                    SELECT u.username, 0 as login_count
                    FROM users u
                    ORDER BY u.username ASC
                ");
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            return [];
        }
    }
}