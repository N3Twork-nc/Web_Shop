<?php
    class SessionIDCustom {
        public function php_session_create_id() {
            $remote_addr = $_SERVER['REMOTE_ADDR'] ?? ''; // Lấy địa chỉ IP của client
        
            $tv = gettimeofday();
            $tv_sec = $tv['sec'];
            $tv_usec = $tv['usec'];
        
            // Tạo một chuỗi có độ dài cố định từ các thông tin
            $buf = sprintf("%.15s%ld%ld%0.8F", $remote_addr, $tv_sec, $tv_usec, lcg_value() * 10);
        
            $digest = hash('sha256', $buf);

            // Tính độ dài của chuỗi băm
            $newlen = strlen($digest);
        
            return $digest;
        }
    }
?>