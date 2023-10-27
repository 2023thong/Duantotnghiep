<?php

require_once 'DBOperations.php';
require 'PHPMailer/PHPMailerAutoload.php';



class Functions{

private $db;
// private $mail;

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
public function themhanghoa($MaHH, $MaNcc, $MaLh , $TenHh, $GiaSp, $Ghichu, $Soluong) {

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



public function changePassword($TenDn, $passwordcu, $passwordmoi) {

  $db = $this -> db;

  if (!empty($TenDn) && !empty($passwordcu) && !empty($passwordmoi)) {

    if(!$db -> checkLogin($TenDn, $passwordcu)){

      $response["result"] = "failure";
      $response["message"] = 'Mật khẩu cũ không đúng';
      return json_encode($response);

    } else {


    $result = $db -> doimatkhau($TenDn, $passwordmoi);

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



public function isEmailValid($email){

  return filter_var($email, FILTER_VALIDATE_EMAIL);
}

public function getMsgParamNotEmpty(){


  $response["result"] = "failure";
  $response["message"] = "Thông tin không được để trống !";
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
