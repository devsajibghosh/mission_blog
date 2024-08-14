<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        .manage-card{
            position: absolute;
            margin-top: 25%;
            left: 25%;
        }


    </style>


</head>
<body class="bg-dark">
    <div class="container position-relative">
        <div class="card manage-card">
            <div class="card-body">
                <h1 class="card-title"></h1>
                <p class="card-text">Your request is being processed. You will be notified once approved.</p>
                <button id="dashboard-btn" class="btn btn-primary" disabled>Go to Dashboard</button>
            </div>
        </div>
    </div>

    <script>

document.addEventListener('DOMContentLoaded', function() {
    const dashboardBtn = document.getElementById('dashboard-btn');

    setTimeout(function() {
        dashboardBtn.disabled = false;
        dashboardBtn.textContent = 'Kindly wait';
        dashboardBtn.addEventListener('click', function() {
            window.location.href = 'dashboard.html';
        });
    }, 5000);
});

    </script>
</body>
</html>

