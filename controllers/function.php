<?php

//ログイン後にページ遷移したときにログインチェックを行う関数
function login2($session){
    require('dbconnect.php');

    if (isset($session['user_id']) && $session['created'] + 3600 > time()) {
        $sql = sprintf('SELECT * FROM `users` WHERE `user_id` = %d AND `user_name` = "%s"',
                    mysqli_real_escape_string($db,$session['user_id']),
                    mysqli_real_escape_string($db,$session['user_name']));
        $record = mysqli_query($db,$sql) or die(mysqli_error($db));

        if ($member = mysqli_fetch_assoc($record)) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

//htmlspecialcharsの短縮
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>