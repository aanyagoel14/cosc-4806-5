<div class="container mt-4">
    <h2>All Reminders Report</h2>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Reminders List
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Due Date</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reminders as $reminder): ?>
                    <tr>
                        <td><?= $reminder['Reminder']['id'] ?></td>
                        <td><?= $reminder['Reminder']['title'] ?></td>
                        <td><?= $reminder['Reminder']['due_date'] ?></td>
                        <td><?= $reminder['User']['username'] ?? 'N/A' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>