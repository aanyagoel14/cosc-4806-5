<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <h2>Create New Reminder</h2>
    <form method="post">
        <label>Subject:</label><br>
        <input type="text" name="subject" required><br><br>

        <label>Description:</label><br>
        <textarea name="description"></textarea><br><br>

        <input type="submit" value="Create Reminder">
    </form>
</div>
<?php require_once 'app/views/templates/footer.php' ?>
