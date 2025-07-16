<?php
if (isset($_SESSION['auth']) == 1) {
    header('Location: /home');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <title>COSC 4806</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/app/views/templates/style.css" rel="stylesheet"> 
  <link rel="icon" href="/favicon.png">
</head>
<body>
  <div class="container mt-5">
    <!-- Simple centered heading added here -->
    <div class="text-center mb-4">
      <h2 class="fw-light">Welcome to Reminder App!</h2>
      <hr class="w-25 mx-auto my-3">
    </div>

    <!-- Your existing form content remains unchanged below -->
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
     

      </div>
    </div>
  </div>
