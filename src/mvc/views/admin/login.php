<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="/public/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="wrapper">
        <form id="loginForm">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required>
                <i class="fa fa-lock"></i>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>

</body>

</html>

<!-- Test thử submit -->
<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Perform any additional actions (e.g., form validation) if needed

        // Redirect to another page
        window.location.href = '/Dashboard_home';
    });
</script>