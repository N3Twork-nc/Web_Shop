<?php
    // set timezone
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    //session_create_id($sessionID->php_session_create_id());
    ini_set('session.name', 'ptitdashboard');
    ini_set('session.sid_length', 128);
    ini_set('session.sid_bits_per_character', 6);
    //ini_set('session.sid_length_min', 64);
    ini_set('session.cookie_samesite','Strict');

    $requested_origin = $_SERVER['HTTP_ORIGIN'] ?? '';

    // Cho phép tất cả các nguồn gốc
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    // Nếu không cần kiểm tra nguồn gốc, chỉ cần bỏ qua bước kiểm tra
    if (!empty($requested_origin)) {
        // Bạn có thể thêm logic xử lý khác nếu cần, nhưng mặc định tất cả được phép.
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