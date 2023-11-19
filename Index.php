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
      ///thêm hàng hóa

      if($operation == 'thongtinvn'){
        if(isset($data->user1) && !empty($data->user1) && isset($data->user1->MaHH) && isset($data->user1->MaNcc) 
            && isset($data->user1->TenLh) && isset($data->user1->TenHh) && isset($data->user1->GiaSp) && isset($data->user1->Ghichu) && isset($data->user1->Soluong)){
            
            $user1 = $data->user1;
            $MaHH = $user1->MaHH;
            $MaNcc = $user1->MaNcc;
            $TenLh = $user1->TenLh;
            $TenHh = $user1->TenHh;
            $GiaSp = $user1->GiaSp;
            $Ghichu = $user1->Ghichu;
            $Soluong = $user1->Soluong;
    
            // Sử dụng $path để lưu trữ đường dẫn ảnh
            echo $fun->themnhanvien($MaHH, $MaNcc, $TenLh, $TenHh, $GiaSp, $Ghichu, $Soluong);
        } 
        else {
            echo $fun->getMsgInvalidParam();
        }
    }
    //oder
    if ($operation == 'oder') {
      if (isset($data->oder1) && !empty($data->oder1) && isset($data->oder1->MaBn) && isset($data->oder1->TongTien)
          && isset($data->oder1->MaMn) && isset($data->oder1->TrangThai)) {
  
          $oder1 = $data->oder1;
          $MaBn = $oder1->MaBn;
          $TongTien = $oder1->TongTien;
          $MaMn = $oder1->MaMn;
          $TrangThai = $oder1->TrangThai;
  
          // Sử dụng $path để lưu trữ đường dẫn ảnh
          echo $fun->oder($MaBn, $TongTien, $MaMn, $TrangThai);
  
      } else {
          echo $fun->getMsgInvalidParam();
      }
  }
  //oderchitiet
  if ($operation == 'oderchitiet') {
    if (isset($data->oder1) && !empty($data->oder1) && isset($data->oder1->MaOder) && isset($data->oder1->TenDu)
    && isset($data->oder1->Soluong) && isset($data->oder1->Giatien)
    && isset($data->oder1->MaBn)) {

    $oder1 = $data->oder1;
    $MaOder = $oder1->MaOder;
    $TenDu = $oder1->TenDu;
    $Soluong = $oder1->Soluong;
    $Giatien = $oder1->Giatien;
    $MaBn = $oder1->MaBn;
    
    // Call oderchitiet function with extracted parameters
    echo $fun->oderchitiet($MaOder,$TenDu, $Soluong, $Giatien, $MaBn);
}

    else {
        echo $fun->getMsgInvalidParam();
    }
}
else if ($operation == 'thanhtoan') {
  if (
      isset($data->thongtinoder) && !empty($data->thongtinoder) &&
      isset($data->thongtinoder->MaOder) && isset($data->thongtinoder->TrangThai)
      
  ) {
      $thongtinoder = $data->thongtinoder;
      $MaOder = $thongtinoder->MaOder;
      $TrangThai = $thongtinoder->TrangThai;
     

      echo $fun->suathanhtoan($MaOder, $TrangThai);
  } else {
      echo $fun->getMsgInvalidParam();
  }
}

//suaoder
if($operation == 'suaoder'){
  if(isset($data->oder1) && !empty($data->oder1) && isset($data->oder1->MaOder) && isset($data->oder1->TongTien)
  && isset($data->oder1->TrangThai)){
      
    $oder1 = $data->oder1;
    $MaOder = $oder1->MaOder;
    $TongTien = $oder1->TongTien;
    $TrangThai = $oder1->TrangThai;
      

      // Sử dụng $path để lưu trữ đường dẫn ảnh
      echo $fun->suaoder($MaOder, $TongTien, $TrangThai);
  } 
  else {
    echo $fun->getMsgInvalidParam();
}
}
//suathongtinoder
if($operation == 'suathongtinoder'){
  if(isset($data->oder1) && !empty($data->oder1) && isset($data->oder1->MaOder) && isset($data->oder1->TenDu)
  && isset($data->oder1->Soluong) && isset($data->oder1->Giatien)
  && isset($data->oder1->MaBn)){
      
    $oder1 = $data->oder1;
    $MaOder = $oder1->MaOder;
    $TenDu = $oder1->TenDu;
    $Soluong = $oder1->Soluong;
    $Giatien = $oder1->Giatien;
    $MaBn = $oder1->MaBn;
      

      // Sử dụng $path để lưu trữ đường dẫn ảnh
      echo $fun->suathontinoder($MaOder, $TenDu, $Soluong, $Giatien, $MaBn);
  } 
  else {
    echo $fun->getMsgInvalidParam();
}
}
  
      
    //themloaihh
    if($operation == 'themloaihang'){
        
    
      if(isset($data->loaihang) && !empty($data->loaihang) && isset($data->loaihang->TenLh) && isset($data->loaihang->Ghichu) 
           ){
          
          $loaihang = $data->loaihang;
          $TenLh = $loaihang->TenLh;
          $Ghichu = $loaihang->Ghichu;
          
          
          echo $fun->themloaihang($TenLh, $Ghichu);
      } 
      else {
          echo $fun->getMsgInvalidParam();
      }
  }
    //thêm ncc
    if($operation == 'nhacungcap'){
      if(isset($data->user2) && !empty($data->user2) && isset($data->user2->TenNcc) 
          && isset($data->user2->Diachi) && isset($data->user2->Sdt)){
          
          $user2 = $data->user2;
          $TenNcc = $user2->TenNcc;
          $Diachi = $user2->Diachi;
          $Sdt = $user2->Sdt;
  
          echo $fun->themnhacungcap($TenNcc, $Diachi, $Sdt);
      } 
      else {
          echo $fun->getMsgInvalidParam();
      }
  }

  
    
      // xoahh
      if ($operation == 'xoahh') {
        if (isset($data->user1) && !empty($data->user1) && isset($data -> user1 -> MaHH) ) 
        {
            $user1 = $data -> user1;
            $MaHH = $user1 -> MaHH;
            echo $fun->xoahanghoa1($MaHH);
        } else {
            echo $fun->getMsgInvalidParam();
        }
    }
    if ($operation == 'xoancc') {
      if (isset($data->user2) && !empty($data->user2) && isset($data -> user2 -> MaNcc) ) 
      {
          $user2 = $data -> user2;
          $MaNcc = $user2 -> MaNcc;
          echo $fun->xoancc1($MaNcc);
      } else {
          echo $fun->getMsgInvalidParam();
      }
  }

      else if ($operation == 'sua_hanghoa') {
        if (
            isset($data->user1) && !empty($data->user1) &&
            isset($data->user1->MaHH) && isset($data->user1->MaNcc) &&
            isset($data->user1->TenLh) && isset($data->user1->TenHh) && isset($data->user1->GiaSp) &&
            isset($data->user1->Ghichu) && isset($data->user1->Soluong)
        ) {
            $user1 = $data->user1;
            $MaHH = $user1->MaHH;
            $MaNcc = $user1->MaNcc;
            $TenLh = $user1->TenLh;
            $TenHh = $user1->TenHh;
            $GiaSp = $user1->GiaSp;
            $Ghichu = $user1->Ghichu;
            $Soluong = $user1->Soluong;
    
            echo $fun->suahanghoa($MaHH, $MaNcc, $TenLh , $TenHh, $GiaSp, $Ghichu, $Soluong);
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
   //suanhacc
   if($operation == 'suanhacc'){
    if(isset($data->user2) && !empty($data->user2) && isset($data->user2->MaNcc) && isset($data->user2->TenNcc) 
        && isset($data->user2->Diachi)&& isset($data->user2->Sdt)){
        
        $user2 = $data->user2;
        $MaNcc = $user2->MaNcc;
        $TenNcc = $user2->TenNcc;
        $Diachi = $user2->Diachi;
        $Sdt = $user2->Sdt;
        

        // Sử dụng $path để lưu trữ đường dẫn ảnh
        echo $fun->suanhacc($MaNcc, $TenNcc, $Diachi , $Sdt);
    } 
    else {
        echo $fun->getMsgInvalidParam();
    }
}
  //thêm nhân viên
      if($operation == 'themnhanvien'){

  			if(isset($data -> user ) && !empty($data -> user) && isset($data -> user -> MaNv) && isset($data -> user -> TenNv) 
        && isset($data -> user -> TenDn) && isset($data -> user -> Matkhau) && isset($data -> user -> Sdt) && isset($data -> user -> Diachi) && isset($data -> user -> Chucvu) 
  				){

  				$user = $data -> user;
  				$MaNv = $user -> MaNv;
          $TenNv = $user -> TenNv;
          $TenDn = $user -> TenDn;
          $Matkhau = $user -> Matkhau;
          $Sdt = $user -> Sdt;
          $Diachi = $user -> Diachi;
          $Chucvu = $user -> Chucvu;

  				

          
            echo $fun -> themnhanvien1($MaNv, $TenNv, $TenDn , $Matkhau, $Sdt, $Diachi, $Chucvu);

          } 
          else {

  				echo $fun -> getMsgInvalidParam();

  			}
      }
      ////
      else if ($operation == 'suanhanvien1') {
        if (
            isset($data->user) && !empty($data->user) &&
            isset($data->user->MaNv) && isset($data->user->TenNv) &&
            isset($data->user->TenDn) && isset($data->user->Matkhau)&& 
            isset($data->user->Sdt)&& isset($data->user->Diachi)&& 
            isset($data->user->Chucvu)
        ) {
            $user = $data->user;
            $MaNv = $user->MaNv;
            $TenNv = $user->TenNv;
            $TenDn = $user->TenDn;
            $Matkhau = $user->Matkhau;
            $Sdt = $user->Sdt;    
            $Diachi = $user->Diachi;
            $Chucvu = $user->Chucvu;
    
            echo $fun->suanhanvien1($MaNv, $TenNv, $TenDn, $Matkhau,$Sdt,$Diachi,$Chucvu);
        } else {
            echo $fun->getMsgInvalidParam();
        }
    }

     if ($operation == 'xoanhanvien') {
      if (isset($data->user) && !empty($data->user) && isset($data->user->MaNv)) {
          $MaNv = $data->user->MaNv;
          echo $fun->xoanhanvien($MaNv);
      } else {
          echo $fun->getMsgInvalidParam();
      }
  }
  else if ($operation == 'timnhanvien') {

    if(isset($data -> user) && !empty($data -> user) &&isset($data -> user -> MaNv)){

      $user = $data -> user;
      $MaNv = $user -> MaNv;

      echo $fun -> timnhanvien($MaNv);

    } else {

      echo $fun -> getMsgInvalidParam();

    }
  }
      //thêm đồ uống
      if($operation == 'themmenu'){

  			if(isset($data -> menu ) && !empty($data -> menu) && isset($data -> menu -> MaMn) && isset($data -> menu -> TenDu) 
        && isset($data -> menu -> Giatien)
  				){

  				$menu = $data -> menu;
  				$MaMn = $menu -> MaMn;
          $TenDu = $menu -> TenDu;
          $Giatien = $menu -> Giatien;
            echo $fun -> themmenu($MaMn, $TenDu, $Giatien);
          } 
          else {

  				echo $fun -> getMsgInvalidParam();

  			}
      }else if ($operation == 'suamenu') {
        if (
            isset($data->menu) && !empty($data->menu) &&
            isset($data->menu->MaMn) && isset($data->menu->TenDu) &&
            isset($data->menu->Giatien)
        ) {
            $menu = $data->menu;
            $MaMn = $menu->MaMn;
            $TenDu = $menu->TenDu;
            $Giatien = $menu->Giatien;
    
            echo $fun->suamenu($MaMn, $TenDu, $Giatien);
        } else {
            echo $fun->getMsgInvalidParam();
        }
    }

     if ($operation == 'xoamenu') {
      if (isset($data->menu) && !empty($data->menu) && isset($data->menu->MaMn)) {
          $MaMn = $data->menu->MaMn;
          echo $fun->xoamenu($MaMn);
      } else {
          echo $fun->getMsgInvalidParam();
      }
  }
  else if ($operation == 'timmenu') {

    if(isset($data -> menu) && !empty($data -> menu) &&isset($data -> menu -> MaMn)){

      $menu = $data -> menu;
      $MaMn = $menu -> MaMn;
      echo $fun -> timmenu($MaMn);

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

