<?php require_once 'app/views/templates/header.php'; ?>

<div class="container">
    <h2>Update Reminder</h2>
    <form method="POST">
        <label>Subject:</label>
        <input type="text" name="subject"
               value="<?= isset($data['reminder']['subject']) ? htmlspecialchars($data['reminder']['subject']) : '' ?>"
               required><br><br>

        <label>Description:</label><br>
        <textarea name="description"><?= isset($data['reminder']['description']) ? htmlspecialchars($data['reminder']['description']) : '' ?></textarea><br><br>

        <button type="submit">Update</button>
    </form>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
