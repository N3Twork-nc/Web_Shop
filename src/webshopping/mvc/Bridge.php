<?php

    require './mvc/core/PHPMailer/src/Exception.php';
    require './mvc/core/PHPMailer/src/PHPMailer.php';
    require './mvc/core/PHPMailer/src/SMTP.php';

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // require_once './mvc/core/SessionIDCustom.php';
    // $sessionID = new SessionIDCustom();
    //session_create_id($sessionID->php_session_create_id());
    ini_set('session.name', 'ptitshopping');
    ini_set('session.sid_length', 128);
    ini_set('session.sid_bits_per_character', 6);

    ini_set('session.cookie_samesite','Strict');

    $allowed_origins = array(
        'http://localhost:8090',
        'http://localhost:8092',
        'http://localhost:8091'
    );
    
    $requested_origin = $_SERVER['HTTP_ORIGIN'];

    // Kiểm tra nếu origin không hợp lệ, từ chối request
    if(!in_array($requested_origin, $allowed_origins)) {
        require_once "./mvc/views/shopping/403.php";
        exit;
    }

    //ini_set('session.sid_length_min', 64);

    // Thiết lập độ dài Session ID tối đa là 128 ký tự  
    //ini_set('session.sid_length_max', 128);
    //ini_set('session.use_strict_mode', 0);
    session_start();

    require_once './mvc/core/App.php';
    require_once './mvc/core/Mail.php';
    require_once './mvc/core/Controller.php';
    require_once './mvc/core/DB.php';
    $myApp = new App();
?>