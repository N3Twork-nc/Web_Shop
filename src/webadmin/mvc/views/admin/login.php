<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="/public/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/sweetalert2@11.0.0/dist/sweetalert2.min.css">
    <link href="https://unpkg.com/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="wrapper">
      <h1>Login</h1>
        <form id="loginForm" action="/Auth/Login" method="POST">
            <?php if(isset($_SESSION['message'])): ?>
              <div style="width: 100%; text-align: center;  font-style:italic; font-size: 16px;" class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
            <div class="input-box">
                <input name="username" type="text" placeholder="username" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="input-box">
                <input name="password" type="password" placeholder="password" required>
                <i class="fa fa-lock"></i>
            </div>
            <br>
            <div class="g-recaptcha" data-sitekey="6Ld6ijcpAAAAAEI4AQfXqDAvLpDEMqEODbXnr3LT"></div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

</body>

</html>
