<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Content-Type: application/json');
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
		if(!$id_user) {
			$name_team 			= 	trim(htmlentities($db->real_escape_string(@$_POST['name_team'])));
			$password_team 		= 	trim(htmlentities($db->real_escape_string(@$_POST['password_team'])));
			$re_password_team 	= 	trim(htmlentities($db->real_escape_string(@$_POST['re_password_team'])));

			if(strlen($name_team) == 0) {
				exit(json_encode(['error' => $stringDefine->getString('usernamenull')]));
			}
			else if(preg_match('/\W/', $name_team)) {
				exit(json_encode(['error' => $stringDefine->getString('usernamenotinvalid')]));
			}
			else if(strlen($password_team) == 0 || strlen($re_password_team) == 0) {
				exit(json_encode(['error' => $stringDefine->getString('passwordnull')]));
			}
			else if(strlen($password_team) < 6) {
				exit(json_encode(['error' => $stringDefine->getString('passwordcharacter')]));
			}
			else if($password_team != $re_password_team) {
				exit(json_encode(['error' => $stringDefine->getString('passwordnotmatch')]));
			}
			else if(strlen($fullname_team) == 0) {
				exit(json_encode(['error' => $stringDefine->getString('teamnull')]));
			}
			else if(strlen($college_team) == 0) {
				exit(json_encode(['error' => $stringDefine->getString('collegenull')]));
			}
			else {
				$sql_check_exists = 
					"SELECT `id_team`
					FROM `teams`
					WHERE `name_team` = '$name_team'";

				if(!$db->num_rows($sql_check_exists)) {
					$sql_check_team_exists = "
						SELECT `id_team`
						FROM `teams`
						WHERE `fullname_team` = '$fullname_team'";

					if(!$db->num_rows($sql_check_team_exists)) {
						$password_team = md5($password_team);
						$data = array(
							'name_team' 		=> $name_team,
							'password_team' 	=> $password_team,
							'fullname_team' 	=> $fullname_team,
							'point_team' 		=> 0,
							'college_team' 		=> $college_team,
							'datetime_submit' 	=> $date_current,
							'it_team' 			=> 0
						);
						$db->insert('teams', $data);
						$db->close();

						exit(json_encode(['success' => $stringDefine->getString('registersuccess')]));
					}
					else {
						exit(json_encode(['error' => $stringDefine->getString('teamfound')]));
					}
				}
				else {
					exit(json_encode(['error' => $stringDefine->getString('usernamefound')]));
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