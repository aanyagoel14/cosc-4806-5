<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
                    </ol>    
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1>Admin Reports</h1>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <h3>All Reminders</h3>
            <?php if (empty($data['all_reminders'])): ?>
                <p>No reminders found.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['all_reminders'] as $reminder): ?>
                                <tr>
                                    <td><?= htmlspecialchars($reminder['username']) ?></td>
                                    <td><?= htmlspecialchars($reminder['subject']) ?></td>
                                    <td><?= htmlspecialchars($reminder['description']) ?></td>
                                    <td><?= htmlspecialchars($reminder['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Users with Most Reminders</h3>
            <?php if (empty($data['most_reminders'])): ?>
                <p>No data available.</p>
            <?php else: ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Reminder Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['most_reminders'] as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['reminder_count']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <h3>User Login Counts</h3>
            <?php if (empty($data['login_counts'])): ?>
                <p>No data available.</p>
            <?php else: ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Login Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['login_counts'] as $login): ?>
                            <tr>
                                <td><?= htmlspecialchars($login['username']) ?></td>
                                <td><?= htmlspecialchars($login['login_count']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Add this before the footer -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Reminders Distribution</div>
            <div class="card-body">
                <canvas id="remindersChart" height="250"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Login Activity</div>
            <div class="card-body">
                <canvas id="loginsChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Prepare data for charts
const reminderData = {
    labels: [<?= implode(',', array_map(fn($u) => "'".htmlspecialchars($u['username'])."'", $data['most_reminders'])) ?>],
    datasets: [{
        label: 'Reminders Created',
        data: [<?= implode(',', array_column($data['most_reminders'], 'reminder_count')) ?>],
        backgroundColor: '#007bff'
    }]
};

const loginData = {
    labels: [<?= implode(',', array_map(fn($l) => "'".htmlspecialchars($l['username'])."'", $data['login_counts'])) ?>],
    datasets: [{
        label: 'Login Count',
        data: [<?= implode(',', array_column($data['login_counts'], 'login_count')) ?>],
        backgroundColor: '#28a745'
    }]
};

// Create charts when page loads
document.addEventListener('DOMContentLoaded', function() {
    new Chart(document.getElementById('remindersChart'), {
        type: 'bar',
        data: reminderData,
        options: { responsive: true }
    });

    new Chart(document.getElementById('loginsChart'), {
        type: 'bar',
        data: loginData,
        options: { responsive: true }
    });
});
</script>
<?php require_once 'app/views/templates/footer.php' ?>