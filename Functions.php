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
public function themnhanvien($MaHH, $MaNcc, $TenLh , $TenHh, $GiaSp, $Ghichu, $Soluong) {

	$db = $this -> db;

	if (!empty($MaHH) && !empty($MaNcc) && !empty($TenLh) && !empty($TenHh) && !empty($GiaSp) && !empty($Ghichu)&& !empty($Soluong)) {

  		if ($db -> checkManv($MaHH)) {

  			$response["result"] = "failure";
  			$response["message"] = "Mã nhân viên đã tồn tại !";
  			return json_encode($response);

  		} else {
  			$result = $db -> insertHanghoa($MaHH, $MaNcc, $TenLh , $TenHh, $GiaSp, $Ghichu, $Soluong);

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
//oder
public function oder($MaBn, $TongTien, $MaMn, $TrangThai, $Ngay) {
  $db = $this->db;

  if (!empty($MaBn) && !empty($TongTien) && !empty($MaMn) && !empty($TrangThai) && !empty($Ngay)) {
    $MaOder = $db->insertOder($MaBn, $TongTien, $MaMn, $TrangThai, $Ngay);

    if ($MaOder) {
      $response["result"] = "success";
      $response["message"] = "Lưu thành công đồ uống";
      $response["MaOder"] = $MaOder; // Assign MaOder to the response
      return json_encode($response);
    } else {
      $response["result"] = "failure";
      $response["message"] = "Registration Failure";
      return json_encode($response);

    }
  }

  return $this->getMsgParamNotEmpty();
}



//oderchitiet
public function oderchitiet($MaOder, $TenDu, $Soluong, $Giatien, $MaBn) {
  $db = $this->db;

  if ( !empty($MaOder) && !empty($MaBn)  && !empty($TenDu)&& !empty($Soluong) && !empty($Giatien)) {

    $result = $db -> insertOderchitiet($MaOder, $TenDu, $Soluong, $Giatien, $MaBn);
    if ($result) {

      $response["result"] = "success";
      $response["message"] = "Oder đồ uống thành công";
      return json_encode($response);

    } else {

      $response["result"] = "failure";
      $response["message"] = "Registration Failure";
      return json_encode($response);

    }
      
  }

  return $this->getMsgParamNotEmpty1();
}
//hoadon
public function hoadon($MaBn,$MaOder, $Trangthai, $Thoigian , $TongTien ) {
  $db = $this->db;

  if (!empty($MaBn) && !empty($MaOder) && !empty($Trangthai)  && !empty($Thoigian)&& !empty($TongTien)) {
    $MaHd = $db->themhoadon($MaBn,$MaOder,  $Trangthai, $Thoigian, $TongTien );

    if ($MaHd) {
      $response["result"] = "success";
      $response["message"] = "Lưu thành công đồ uống";
      $response["MaHd"] = $MaHd; 
      return json_encode($response);
    } else {
      $response["result"] = "failure";
      $response["message"] = "Registration Failure";
      return json_encode($response);

    }
  }

  return $this->getMsgParamNotEmpty();
}
//hoadonchitiet
public function hoadonchitiet($MaHd,$TenLh, $SoLuong, $GiaTien) {
  $db = $this->db;

  if ( !empty($MaHd) && !empty($TenLh)  && !empty($SoLuong)&& !empty($GiaTien) ) {

    $result = $db -> hoadonchitiet1($MaHd,$TenLh, $SoLuong, $GiaTien);
    if ($result) {
      $response["result"] = "success";
      $response["message"] = "111";
      return json_encode($response);
    
    

    } else {

      $response["result"] = "failure";
      $response["message"] = "Registration Failure";
      return json_encode($response);

    }
      
  }

  return $this->getMsgParamNotEmpty();
}

//sửa menu
public function suaoder($MaOder, $TongTien, $TrangThai)
{
    $db = $this->db;

    if (!empty($MaOder) && !empty($TongTien)&& !empty($TrangThai)) {
         {
            $result = $db->updateOder($MaOder, $TongTien, $TrangThai);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Sửa Oder thành công";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sua thong Oder thất bại";
                return json_encode($response);
            }
        }
    } else {
        return $this->getMsgParamNotEmpty();
    }
}
public function themban($MaBn, $TenBan, $Trangthai) {

	$db = $this -> db;

	if (!empty($MaBn) && !empty($TenBan) && !empty($Trangthai)) {

  		if ($db -> checkManv($MaBn)) {

  			$response["result"] = "failure";
  			$response["message"] = "Mã bàn đã tồn tại !";
  			return json_encode($response);

  		} else {
  			$result = $db -> insertBan($MaBn, $TenBan, $Trangthai);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "Thêm thông tin thành công !";
  				return json_encode($response);

  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Thêm thông tin thất bại!";
  				return json_encode($response);

  			}
  		}
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}
public function suaban($MaBn,  $Trangthai) {

	$db = $this -> db;

	if (!empty($MaBn)  && !empty($Trangthai)) {


  			$result = $db -> updateban1($MaBn,  $Trangthai);

  			if ($result) {

				  

  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Thêm thông tin thất bại!";
  				return json_encode($response);

  			}
  		
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}

//sửa menu
public function suathontinoder($MaOder, $TenDu, $Soluong, $Giatien, $MaBn)
{
    $db = $this->db;

    if (!empty($MaOder) && !empty($TenDu)&& !empty($Soluong) && !empty($Giatien)&& !empty($MaBn)) {
         {
            $result = $db->updatethongtinoder($MaOder, $TenDu, $Soluong, $Giatien, $MaBn);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Sửa thông tin oder thành công";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sửa thông tin Oder thất bại";
                return json_encode($response);
            }
        }
    } else {
        return $this->getMsgParamNotEmpty();
    }
}
public function suathanhtoan($MaOder, $TrangThai)
{
    $db = $this->db;
    
            $result = $db->updateThanhtoan($MaOder, $TrangThai);
            if ($result) {
                $response["result"] = "success";
                $response["message"] = " Thành công";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sua thong tin nv that bai";
                return json_encode($response);
            }
        
     
    
  }



//themloaihang
public function themloaihang($TenLh, $Ghichu) {

	$db = $this -> db;

	if (!empty($TenLh) && !empty($Ghichu)) {

  		if ($db -> checkLoaihh($TenLh)) {

  			$response["result"] = "failure";
  			$response["message"] = "Tên loại hàng hóa đã tồn tại !";
  			return json_encode($response);

  		} else {
  			$result = $db -> insertLoaihang($TenLh, $Ghichu);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "Thêm tên loại hàng thành công !";
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
//nhacungcap
public function themnhacungcap($TenNcc, $Diachi , $Sdt) {

	$db = $this -> db;

	if ( !empty($TenNcc) && !empty($Diachi) && !empty($Sdt)) {

  		
  			$result = $db -> insertNhacungcap( $TenNcc, $Diachi , $Sdt);

  			if ($result) {

				  $response["result"] = "success";
  				$response["message"] = "Thêm thông tin nhà cung cấp thành công !";
  				return json_encode($response);

  			} else {

  				$response["result"] = "failure";
  				$response["message"] = "Registration Failure";
  				return json_encode($response);

  			}
  		
  	} else {

  		return $this -> getMsgParamNotEmpty();

  	}
}
///thêm nhân viên
public function themnhanvien1($MaNv, $TenNv, $TenDn , $Matkhau, $Sdt, $Diachi, $Chucvu ) {

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
public function themmenu1($MaMn, $TenDu, $Giatien,$TenLh) {

	$db = $this -> db;

	if (!empty($MaMn) && !empty($TenDu)&& !empty($Giatien) && !empty($TenLh)) {

  		if ($db -> checkMaMn($MaMn)) {

  			$response["result"] = "failure";
  			$response["message"] = "Mã đồ uống đã tồn tại !";
  			return json_encode($response);

  		} else {
  			$result = $db -> themmenu($MaMn, $TenDu , $Giatien, $TenLh);

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

//xoahh
public function xoahanghoa1($MaHH)
{
    $db = $this->db;

    $result = $db -> xoahh($MaHH);
    
    if ($result) {
        $response["result"] = "success";
        $response["message"] = "Xóa thông tin hàng hóa thành công !";
    } 
    
    return json_encode($response);
}
//xoancc  
public function xoancc1($MaNcc)
{
    $db = $this->db;

    $result = $db->xoancc2($MaNcc);
    
    if ($result === true) {
        $response["result"] = "success";
        $response["message"] = "Xóa thông tin nhà cung cấp thành công!";
    } 
    else  {
        $response["result"] = "failure";
        $response["message"] = "Xóa thông tin thất bại, thông tin đang được ràng buộc !";
    }
    
    
    return json_encode($response);
}



public function suahanghoa($MaHH, $MaNcc, $TenLh , $TenHh, $GiaSp, $Ghichu, $Soluong)
{
    $db = $this->db;

    if (!empty($MaHH) && !empty($MaNcc) && !empty($TenLh) && !empty($TenHh) && !empty($GiaSp) && !empty($Ghichu) && !empty($Soluong)) {
        
            $result = $db->updateHanghoa($MaHH, $MaNcc, $TenLh , $TenHh, $GiaSp, $Ghichu, $Soluong);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Sua thong tin thanh cong!";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sua thong tin that bai";
                return json_encode($response);
            }
        }
        else {
           return $this->getMsgParamNotEmpty();
    }
}

//sửa menu
public function suamenu($MaMn, $TenDu,$Giatien,$TenLh)
{
    $db = $this->db;

    if (!empty($MaMn) && !empty($TenDu)&& !empty($Giatien)&& !empty($TenLh)) {
        if (!$db->checkMaMn($MaMn)) {
            $response["result"] = "failure";
            $response["message"] = "Ma menu khong ton tai!";
            return json_encode($response);
        } else {
            $result = $db->suamenu($MaMn, $TenDu,$Giatien,$TenLh);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Sua thong tin menu thanh cong!";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sua thong tin menu that bai";
                return json_encode($response);
            }
        }
    } else {
        return $this->getMsgParamNotEmpty();
    }
}
public function xoamenu($MaMn)
{
    $db = $this->db;

    if (!empty($MaMn)) {
        if (!$db->checkMaMn($MaMn)) {
            $response["result"] = "failure";
            $response["message"] = "Ma menu khong ton tai!";
            return json_encode($response);
        } else {
            $result = $db->xoamenu($MaMn);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Xoa menu thanh cong!";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Xoa menu that bai";
                return json_encode($response);
            }
        }
    } else {
        return $this->getMsgParamNotEmpty();
    }
}
//suanccc
public function suanhacc($MaNcc, $TenNcc, $Diachi , $Sdt)
{
    $db = $this->db;

    if (!empty($MaNcc) && !empty($TenNcc) && !empty($Diachi) && !empty($Sdt)) {
        
            $result = $db->updateNhacungcap($MaNcc, $TenNcc, $Diachi , $Sdt);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Sua thong tin thanh cong!";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sua thong tin that bai";
                return json_encode($response);
            }
        }
        else {
           return $this->getMsgParamNotEmpty();
    }
}
//sửa nv
public function suanhanvien1($MaNv, $TenNv,$TenDn, $Matkhau, $Sdt, $Diachi, $Chucvu)
{
    $db = $this->db;

    if (!empty($MaNv) && !empty($TenNv)&& !empty($TenDn)&& !empty($Matkhau) && !empty($Sdt) && !empty($Diachi)&& !empty($Chucvu)) {
        if (!$db->checkMaNv1($MaNv)) {
            $response["result"] = "failure";
            $response["message"] = "Ma nv khong ton tai!";
            return json_encode($response);
        } 
         
            $result = $db->suanhanvien1($MaNv, $TenNv,$TenDn, $Matkhau, $Sdt, $Diachi, $Chucvu);

            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Sua thong tin thanh cong!";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sua thong tin that bai";
                return json_encode($response);
            }
        }
        else {
           return $this->getMsgParamNotEmpty();
    }
}



public function xoanhanvien($MaNv)
{
    $db = $this->db;

    if (!empty($MaNv)) {
        if (!$db->checkMaNv1($MaNv)) {
            $response["result"] = "failure";
            $response["message"] = "Ma nv khong ton tai!";
            return json_encode($response);
        } 
            $result = $db->xoanhanvien($MaNv);


            if ($result) {
                $response["result"] = "success";
                $response["message"] = "Sua thong tin thanh cong!";
                return json_encode($response);
            } else {
                $response["result"] = "failure";
                $response["message"] = "Sua thong tin that bai";
                return json_encode($response);
            }
        }
        else {
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
public function timnhanvien($MaNv){

  $db = $this -> db;

  if ($db -> checkMaNv1($MaNv)) {

    $result =  $db -> timnhanvien($MaNv);

    if(!$result){

      $response["result"] = "failure";
      $response["message"] = "Không thấy nhân viên";
      return json_encode($response);

    } else {

      if($result){
        $response["result"] = "success";
        $response["message"] = "Đã tìm thấy nhân viên";
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
//tìm menu
public function timmenu($MaMn){

  $db = $this -> db;

  if ($db -> checkMaMn($MaMn)) {

    $result =  $db -> timmenu($MaMn);

    if(!$result){

      $response["result"] = "failure";
      $response["message"] = "Không thấy đồ uống";
      return json_encode($response);

    } else {

      if($result){
        $response["result"] = "success";
        $response["message"] = "Đã tìm thấy đồ uống";
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
  $response["message"] = "Thông tin không được để trống !";
  return json_encode($response);

}
//thongbaosoder
public function getMsgParamNotEmpty1(){


  $response["result"] = "failure";
  $response["message"] = "Lưu trước khi Oder";
  return json_encode($response);

}
public function getMsgInvalidParam2(){

  $response["result"] = "failure";
  $response["message"] = "Lưu hóa đơn trước khi oder";
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