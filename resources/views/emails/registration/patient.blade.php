<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to PrecisionPulseMd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; padding: 30px;">
    <div class="container bg-white rounded shadow p-4">
        <h2 class="mb-3 text-primary">Welcome, {{ $user->name }} 🎉</h2>

        <p>Thank you for registering with <strong>PrecisionPulseMd</strong>. Your account has been successfully created!</p>

        <hr>

        <h5>🔐 Account Details</h5>
        <ul class="list-unstyled">
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Password:</strong> {{ $password }}</li>
        </ul>

        <hr>

        <p>If you didn’t initiate this registration, please contact our support team immediately.</p>

        <p class="text-muted mt-4">This email was sent automatically. Please do not reply.</p>
    </div>
</body>
</html>
