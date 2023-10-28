<?php

require_once 'DBOperations.php';
require 'PHPMailer/PHPMailerAutoload.php';



class Functions{

private $db;
private $mail;

public function __construct() {

      $this -> db = new DBOperations();
      // $this -> mail = new PHPMailer;

}


public function registerUser($name, $email, $password) {

	$db = $this -> db;

	if (!empty($name) && !empty($email) && !empty($password)) {

  		if ($db -> checkUserExist($name)) {

  			$response["result"] = "failure";
  			$response["message"] = "Tên đã tồn tại !";
  			return json_encode($response);

  		} else {

  			$result = $db -> insertData($name, $email, $password);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "Đăng kí thành công !";
  				return json_encode($response);

  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Registration Failure";
  				return json_encode($response);

  			}
  		}
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}
////// thêm hoàng hóa
public function themnhanvien($MaHH, $MaNcc, $MaLh , $TenHh, $GiaSp, $Ghichu, $Soluong) {

	$db = $this -> db;

	if (!empty($MaHH) && !empty($MaNcc) && !empty($MaLh) && !empty($TenHh) && !empty($GiaSp) && !empty($Ghichu)&& !empty($Soluong)) {

  		if ($db -> checkManv($MaHH)) {

  			$response["result"] = "failure";
  			$response["message"] = "Mã nhân viên đã tồn tại !";
  			return json_encode($response);

  		} else {
  			$result = $db -> insertHanghoa($MaHH, $MaNcc, $MaLh , $TenHh, $GiaSp, $Ghichu, $Soluong);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "Thêm thông tin thành công !";
  				return json_encode($response);

  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Registration Failure";
  				return json_encode($response);

  			}
  		}
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}
///thêm nhân viên
public function themnhanvien1($MaNv, $TenNv, $TenDn , $Matkhau, $Sdt, $Diachi, $Chucvu) {

	$db = $this -> db;

	if (!empty($MaNv) && !empty($TenNv) && !empty($TenDn) && !empty($Matkhau) && !empty($Sdt) && !empty($Diachi)&& !empty($Chucvu)) {

  		if ($db -> checkManv($MaNv)) {

  			$response["result"] = "failure";
  			$response["message"] = "Mã nhân viên đã tồn tại !";
  			return json_encode($response);

  		} else {
  			$result = $db -> insertNhanVien($MaNv, $TenNv, $TenDn , $Matkhau, $Sdt, $Diachi, $Chucvu);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "Thêm thông tin nhân viên thành công !";
  				return json_encode($response);

  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Thêm thông tin nhân viên thất bại!";
  				return json_encode($response);

  			}
  		}
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}
//Thêm đồ uống
public function themmenu($MaMn, $TenLh, $Giatien) {

	$db = $this -> db;

	if (!empty($MaMn) && !empty($TenLh)&& !empty($Giatien)) {

  		if ($db -> checkMaMn($MaMn)) {

  			$response["result"] = "failure";
  			$response["message"] = "Mã đồ uống đã tồn tại !";
  			return json_encode($response);

  		} else {
  			$result = $db -> insertMenu($MaMn, $TenLh , $Giatien);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "Thêm thông tin đồ uống thành công !";
  				return json_encode($response);

  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Thêm thông tin đồ uống thất bại!";
  				return json_encode($response);

  			}
  		}
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}
public function suanhanvien($manv, $tennv, $sdt, $diachi)
{
    $db = $this->db;

    if (!empty($manv) && !empty($tennv) && !empty($sdt) && !empty($diachi)) {
        if (!$db->checkManv($manv)) {
            $response["result"] = "failure";
            $response["message"] = "Ma nv khong ton tai!";
            return json_encode($response);
        } else {
            $result = $db->updateThongtin($manv, $tennv, $sdt, $diachi);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Sua thong tin nv thanh cong!";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sua thong tin nv that bai";
                return json_encode($response);
            }
        }
    } else {
        return $this->getMsgParamNotEmpty();
    }
}
public function xoanhanvien($manv)
{
    $db = $this->db;

    if (!empty($manv)) {
        if (!$db->checkManv($manv)) {
            $response["result"] = "failure";
            $response["message"] = "Ma nv khong ton tai!";
            return json_encode($response);
        } else {
            $result = $db->deleteThongtin($manv);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Xoa nhan vien thanh cong!";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Xoa nhan vien that bai";
                return json_encode($response);
            }
        }
    } else {
        return $this->getMsgParamNotEmpty();
    }
}


public function loginUser($TenDn, $Matkhau) {
  $db = $this->db;

  if (!empty($TenDn) && !empty($Matkhau)) {

      if ($db->checkUserExist($TenDn)) {
          $result = $db->checkLogin($TenDn, $Matkhau);

          if (!$result) {
              $response["result"] = "failure";
              $response["message"] = "Invalid Login Credentials";
              return json_encode($response);
          } else {
              $Chucvu = $result['Chucvu'];
              $MaNv = $result['MaNv'];
              $TenNv = $result['TenNv'];
              $Sdt = $result['Sdt'];
              $Diachi = $result['Diachi'];

              $response["result"] = "success";
              $response["message"] = "Đăng nhập thành công";
              $response["phanquyen"] = $Chucvu;
              $response["MaNv"] = $MaNv;
              $response["TenNv"] = $TenNv;
              $response["Sdt"] = $Sdt;
              $response["Diachi"] = $Diachi;

              return json_encode($response);
          }
      } else {
          $response["result"] = "failure";
          $response["message"] = "Invalid Credentials";
          return json_encode($response);
      }
  } else {
      return $this->getMsgParamNotEmpty();
  }
}



public function changePassword($name, $old_password, $new_password) {

  $db = $this -> db;

  if (!empty($name) && !empty($old_password) && !empty($new_password)) {

    if(!$db -> checkLogin($name, $old_password)){

      $response["result"] = "failure";
      $response["message"] = 'Invalid Old Password';
      return json_encode($response);

    } else {


    $result = $db -> changePassword($name, $new_password);

      if($result) {

        $response["result"] = "success";
        $response["message"] = "Đổi mật khẩu thành công";
        return json_encode($response);

      } else {

        $response["result"] = "failure";
        $response["message"] = 'Error Updating Password';
        return json_encode($response);

      }

    }
  } else {

      return $this -> getMsgParamNotEmpty();
  }

}

public function resetPasswordRequest($email){

  $db = $this -> db;

  if ($db -> checkUserExist($email)) {

    $result =  $db -> passwordResetRequest($email);

    if(!$result){

      $response["result"] = "failure";
      $response["message"] = "Reset Password Failure";
      return json_encode($response);

    } else {

      $mail_result = $this -> sendEmail($result["email"],$result["temp_password"]);

      if($mail_result){

        $response["result"] = "success";
        $response["message"] = "Check your mail for reset password code.";
        return json_encode($response);

      } else {

        $response["result"] = "failure";
        $response["message"] = "Reset Password Failure";
        return json_encode($response);
      }
    }


  } else {

    $response["result"] = "failure";
    $response["message"] = "Email does not exist";
    return json_encode($response);

  }

}
//timnv
public function timnhavien1($manv){

  $db = $this -> db;

  if ($db -> checkUserExist($manv)) {

    $result =  $db -> timnhanvien($manv);

    if(!$result){

      $response["result"] = "failure";
      $response["message"] = "Không thấy nhân viên";
      return json_encode($response);

    } else {

      if($result){

        $response["result"] = "success";
        $response["message"] = "Đã thấy nhân viên";
        return json_encode($response);

      } else {

        $response["result"] = "failure";
        $response["message"] = "Reset Password Failure";
        return json_encode($response);
      }
    }


  } else {

    $response["result"] = "failure";
    $response["message"] = "Email does not exist";
    return json_encode($response);

  }

}

public function resetPassword($email,$code,$password){

  $db = $this -> db;

  if ($db -> checkUserExist($email)) {

    $result =  $db -> resetPassword($email,$code,$password);

    if(!$result){

      $response["result"] = "failure";
      $response["message"] = "Reset Password Failure";
      return json_encode($response);

    } else {

      $response["result"] = "success";
      $response["message"] = "Password Changed Successfully";
      return json_encode($response);

    }


  } else {

    $response["result"] = "failure";
    $response["message"] = "Email does not exist";
    return json_encode($response);

  }

}

public function sendEmail($email,$temp_password){

  $mail = $this -> mail;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'hanthienduc.96@gmail.com';
  $mail->Password = 'hantiennam';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;

  $mail->From = 'hanthienduc.96@gmail.com';
  $mail->FromName = 'Han Duc';
  $mail->addAddress($email, 'Han Duc');

  $mail->addReplyTo('hanthienduc.96@gmail.com', 'Your Name');

  $mail->WordWrap = 50;
  $mail->isHTML(true);

  $mail->Subject = 'Password Reset Request';
  $mail->Body    = 'Hi,<br><br> Your password reset code is <b>'.$temp_password.'</b> . This code expires in 120 seconds. Enter this code within 120 seconds to reset your password.<br><br>Thanks,<br>Learnfpt.';

  if(!$mail->send()) {

   return $mail->ErrorInfo;

  } else {

    return true;

  }

}

public function sendPHPMail($email,$temp_password){

  $subject = 'Password Reset Request';
  $message = 'Hi,\n\n Your password reset code is '.$temp_password.' . This code expires in 120 seconds. Enter this code within 120 seconds to reset your password.\n\nThanks,\nLearfpt.';
  $from = "your.email@example.com";
  $headers = "From:" . $from;

  return mail($email,$subject,$message,$headers);

}


public function isEmailValid($email){

  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

public function getMsgParamNotEmpty(){


  $response["result"] = "failure";
  $response["message"] = "Parameters should not be empty !";
  return json_encode($response);

}

public function getMsgInvalidParam(){

  $response["result"] = "failure";
  $response["message"] = "Invalid Parameters";
  return json_encode($response);

}

public function getMsgInvalidEmail(){

  $response["result"] = "failure";
  $response["message"] = "Invalid Email";
  return json_encode($response);

}

}
