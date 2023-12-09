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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="wrapper">
      <h1>Login</h1>
        <form id="loginForm">
            <div class="input-box">
                <input name="username" type="text" placeholder="username" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="input-box">
                <input name="password" type="password" placeholder="password" required>
                <i class="fa fa-lock"></i>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>

</body>

</html>

<!-- Test thử submit -->
<script>
function showLoadingSwal() {
  return Swal.fire({
    title: 'Loading...',
    text: 'Vui lòng chờ trong giây lát!',
    timer: 2000,
    showConfirmButton: false,
    imageUrl: '/public/img/gif/loading.gif',
    allowOutsideClick: false // Không cho phép đóng khi click ra ngoài
  });
}
    $('#loginForm').submit(function(e){
		e.preventDefault();
    var $form = $(this);
    var $alert = $form.find('.alert');
    var sw = showLoadingSwal();
		$.ajax({
			url:'/Auth/CheckAcc',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
        resp = JSON.parse(resp);

				if(resp["stateLogin"] == "Successful"){
          $('#loginForm').find('.alert-danger').remove();
          sw.close();
          localStorage.setItem('token', resp['token']);

          location.reload();
				}else{
            sw.close();
            var message = 'Lỗi';
            //nhớ thêm cái này cho mấy trang kia
            $('#loginForm').find('.alert-danger').remove();
            console.log(resp['stateLogin']);
            if(resp['stateLogin'] == 'Failed'){
              message = 'Mật khẩu hoặc tài khoản không đúng';
            }
            $('#loginForm').prepend('<div style="width: 100%; text-align: center;  font-style:italic; font-size: 16px;" class="alert alert-danger">'+ message + '</div>');
          }
			}
		})
	});
</script>