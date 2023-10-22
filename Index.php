<?php

require_once 'Functions.php';

$fun = new Functions();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents("php://input"));

  if(isset($data -> operation)){

  	$operation = $data -> operation;

  	if(!empty($operation)){

  		if($operation == 'register'){

  			if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> name) 
  				&& isset($data -> user -> email) && isset($data -> user -> password)){

  				$user = $data -> user;
  				$name = $user -> name;
  				$email = $user -> email;
  				$password = $user -> password;

          if ($fun -> isEmailValid($email)) {
            
            echo $fun -> registerUser($name, $email, $password);

          } else {

            echo $fun -> getMsgInvalidEmail();
          }

  			} else {

  				echo $fun -> getMsgInvalidParam();

  			}

  		}

      if($operation == 'hanghoa'){

  			if(isset($data -> user1 ) && !empty($data -> user1) && isset($data -> user1 -> MaHH) && isset($data -> user1 -> MaNcc) 
        && isset($data -> user1 -> MaLh) && isset($data -> user1 -> TenHh) && isset($data -> user1 -> GiaSp) && isset($data -> user1 -> Ghichu) && isset($data -> user1 -> Soluong) 
  				){

  				$user1 = $data -> user1;
  				$MaHH = $user1 -> MaHH;
          $MaNcc = $user1 -> MaNcc;
          $MaLh = $user1 -> MaLh;
          $TenHh = $user1 -> TenHh;
          $GiaSp = $user1 -> GiaSp;
          $Ghichu = $user1 -> Ghichu;
          $Soluong = $user1 -> Soluong;

  				

          
            echo $fun -> themhanghoa($MaHH, $MaNcc, $MaLh , $TenHh, $GiaSp, $Ghichu, $Soluong);

          } 
          else {

  				echo $fun -> getMsgInvalidParam();

  			}
      }
      else if ($operation == 'sua_thongtinvn') {
        if (
            isset($data->user1) && !empty($data->user1) &&
            isset($data->user1->manv) && isset($data->user1->tennv) &&
            isset($data->user1->sdt) && isset($data->user1->diachi)
        ) {
            $user1 = $data->user1;
            $manv = $user1->manv;
            $tennv = $user1->tennv;
            $sdt = $user1->sdt;
            $diachi = $user1->diachi;
    
            echo $fun->suanhanvien($manv, $tennv, $sdt, $diachi);
        } else {
            echo $fun->getMsgInvalidParam();
        }
    }

     if ($operation == 'xoa_thongtinvn') {
      if (isset($data->user1) && !empty($data->user1) && isset($data->user1->manv)) {
          $manv = $data->user1->manv;
          echo $fun->xoanhanvien($manv);
      } else {
          echo $fun->getMsgInvalidParam();
      }
  }
  else if ($operation == 'timnhanvien2') {

    if(isset($data -> user1) && !empty($data -> user1) &&isset($data -> user1 -> manv)){

      $user1 = $data -> user1;
      $manv = $user1 -> manv;

      echo $fun -> timnhavien1($manv);

    } else {

      echo $fun -> getMsgInvalidParam();

    }
  }
    
  if ($operation == 'login') {
    if (isset($data->user) && !empty($data->user) && isset($data->user->TenDn) && isset($data->user->Matkhau)) {
        $user = $data->user;
        $TenDn = $user->TenDn;
        $Matkhau = $user->Matkhau;

        echo $fun->loginUser($TenDn, $Matkhau);
    } else {
        echo $fun->getMsgInvalidParam();
    }
}

      if ($operation == 'doimatkhau') {

        if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> TenDn) && isset($data -> user -> passwordcu) 
          && isset($data -> user -> passwordmoi)){

          $user = $data -> user;
          $TenDn = $user -> TenDn;
          $passwordcu = $user -> passwordcu;
          $passwordmoi = $user -> passwordmoi;

          echo $fun -> changePassword($TenDn, $passwordcu, $passwordmoi);

        } else {

          echo $fun -> getMsgInvalidParam();

        }
      }else if ($operation == 'resPassReq') {

        if(isset($data -> user) && !empty($data -> user) &&isset($data -> user -> email)){

          $user = $data -> user;
          $email = $user -> email;

          echo $fun -> resetPasswordRequest($email);

        } else {

          echo $fun -> getMsgInvalidParam();

        }
      }else if ($operation == 'resPass') {

        if(isset($data -> user) && !empty($data -> user) && isset($data -> user -> email) && isset($data -> user -> password) 
          && isset($data -> user -> code)){

          $user = $data -> user;
          $email = $user -> email;
          $code = $user -> code;
          $password = $user -> password;
          
          echo $fun -> resetPassword($email,$code,$password);

        } else {

          echo $fun -> getMsgInvalidParam();

        }
      }

  	}else{

  		
  		echo $fun -> getMsgParamNotEmpty();

  	}
  } else {

  		echo $fun -> getMsgInvalidParam();

  }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET'){


  echo "Learn2Crack Login API";

}

