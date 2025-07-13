<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= ucwords($_SESSION['controller']);?></li>
                    </ol>    
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1>Reminders</h1>
                <p><a href="/reminders/create" class="btn btn-primary">Create a new reminder</a></p>
            </div>
        </div>
    </div>

    <?php if (empty($data['reminders'])): ?>
        <p>No reminders found.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['reminders'] as $reminder): ?>
                    <tr>
                        <td><?= htmlspecialchars($reminder['subject']) ?></td>
                        <td><?= htmlspecialchars($reminder['description']) ?></td>
                        <td><?= htmlspecialchars($reminder['created_at']) ?></td>
                        <td>
                            <a href="/reminders/update/<?= $reminder['id'] ?>" class="btn btn-sm btn-warning">Update</a>
                            <a href="/reminders/delete/<?= $reminder['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this reminder?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php require_once 'app/views/templates/footer.php' ?>
