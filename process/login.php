<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Content-Type: application/json');
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if(!$id_user) {

			$username = trim(htmlentities($db->real_escape_string(@$_POST['username'])));
            $password = trim(@$_POST['password']);

            $sql_check_user_exist = 
            	"SELECT `ID_USER`
            	FROM `tb_users`
            	WHERE `USERNAME` = '$username'";

        	if (strlen($username) == 0) {
            	exit(json_encode(['error' => 'Tên đăng nhập không được để trống.']));
        	}
        	else if (strlen($password) == 0) {
        		exit(json_encode(['error' => 'Mật khẩu không được để trống.']));
        	}
        	else if (preg_match('/\W/', $username)) {
            	exit(json_encode(['error' => 'Tên đăng nhập không được chưa ký tự đặc biệt hoặc khoảng trống.']));
        	}
        	else if (strlen($password) < 4) {
                exit(json_encode(['error' => 'Mật khẩu không được bé hơn 4 ký tự.']));
            }
            else if (!$db->num_rows($sql_check_user_exist)) {
            	exit(json_encode(['error' => 'Tên đăng nhập đã tồn tại.']));
            }
            else {
				$password = @md5($_POST['password']);
				
				$sql_check_login = 
					"SELECT `ID_USER`
					FROM `tb_users`
					WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password'";
				
				if ($db->num_rows($sql_check_login)) {

					$data = $db->fetch_assoc($sql_check_login, 1);
					$session->send($data['ID_USER']);
					$db->close();
					exit(json_encode(['success' => 'Đăng nhập thành công.']));
					
				}
				else {
					exit(json_encode(['error' => 'Mật khẩu không chính xác.']));
				}
            }
		}
		else {
			exit(json_encode(['error' => $stringDefine->getString('Bạn đã đăng nhập rồi.')]));
		}
	}
	else {
		exit(json_encode(['success' => $stringDefine->getString('Bạn không có quyền thực thi.')]));
	}