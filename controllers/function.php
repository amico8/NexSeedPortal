<?php
function login($post,$db){
	$error = array();
    if (isset($post)&&!empty($post)) {
        if ($post['email'] !='' && $post['password'] != '') {
            $sql = sprintf('SELECT * FROM `users` WHERE `email` = "%s" AND `password` = "%s"',
                mysqli_real_escape_string($db, $post['email']),
                mysqli_real_escape_string($db, sha1($post['password'])));
            $record = mysqli_query($db,$sql) or die(mysqli_error($db));
            if ($table = mysqli_fetch_assoc($record)) {
            	$_SESSION['user_id'] = $table['user_id'];
                $_SESSION['user_name'] = $table['user_name'];
                $_SESSION['created'] = time();
                if ($_POST['save'] = 'on') {
                    setcookie('email',$post['email'],time() +60*60*24*14);
                    setcookie('password',$post['password'],time() +60*60*24*14);
                }
            }else{
                $error['login'] = 'failed';
                header('Location: /NexSeedPortal/users/login/');
            }
        }else {
            $error['login'] = 'blank';
            header('Location: /NexSeedPortal/users/login/');
        }
    }
}

function login2($session,$db){
	if (isset($session['user_id']) && $session['created'] + 3600 > time()) {
    	$sql = sprintf('SELECT * FROM `users` WHERE `user_id` = %d AND `user_name` = "%s"',
       				mysqli_real_escape_string($db,$session['user_id']),
                    mysqli_real_escape_string($db,$session['user_name']));
    	$record = mysqli_query($db,$sql) or die(mysqli_error($db));
    	if($member = mysqli_fetch_assoc($record)){
            $_SESSION['created'] = time();
        }else{
            header('Location: /NexSeedPortal/users/login/');
        }
	}else{
    	header('Location: /NexSeedPortal/users/login');
	}
}

//htmlspecialcharsの短縮
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

?>