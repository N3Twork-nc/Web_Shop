<?php
    // set timezone
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    //session_create_id($sessionID->php_session_create_id());
    ini_set('session.name', 'ptitdashboard');
    ini_set('session.sid_length', 128);
    ini_set('session.sid_bits_per_character', 6);
    //ini_set('session.sid_length_min', 64);

    if(!in_array($requested_origin, $allowed_origins)) {
        if(!empty($requested_origin) || ($_SERVER['HTTP_SEC_FETCH_SITE'] != "none" && ($_SERVER['HTTP_SEC_FETCH_SITE'] != "same-origin" ))){
            require_once "./mvc/views/shopping/403.php";
            exit;
        }
    }

    // Thiết lập độ dài Session ID tối đa là 128 ký tự  
    //ini_set('session.sid_length_max', 128);
    //ini_set('session.use_strict_mode', 0);
    session_start();
    require_once './mvc/core/App.php';
    require_once './mvc/core/Controller.php';
    require_once './mvc/core/DB.php';
    require_once './mvc/core/MiddleWare.php';
    $myApp = new App();
?>