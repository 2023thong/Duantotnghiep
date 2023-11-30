<?php

class DBOperations{

	 private $host = '127.0.0.1';
	 private $user = 'root';
	 private $db = 'duan';
	 private $pass = '';
	 private $conn;

public function __construct() {

	$this -> conn = new PDO("mysql:host=".$this -> host.";dbname=".$this -> db, $this -> user, $this -> pass);
    

}

 //sửa menu
public function updatemenu($MaMn, $TenLh, $Giatien)
{
    $sql = 'UPDATE menu
            SET TenLh = :TenLh, Giatien = :Giatien
            WHERE MaMn = :MaMn';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaMn' => $MaMn,
        ':TenLh' => $TenLh,
        ':Giatien' => $Giatien
    ));

    return $query->rowCount() > 0;
}




 //thêm hàng hóa
 public function insertHanghoa($MaHH, $MaNcc, $TenLh , $TenHh, $GiaSp, $Ghichu, $Soluong) {
    

    $sql = 'INSERT INTO hanghoa ( MaHH, MaNcc, TenLh, TenHh, GiaSp, Ghichu, Soluong) VALUES ( :MaHH, :MaNcc, :TenLh, :TenHh, :GiaSp, :Ghichu, :Soluong)';

    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        
        ':MaHH' => $MaHH,
        ':MaNcc' => $MaNcc,
        ':TenLh' => $TenLh,
        ':TenHh' => $TenHh,
        ':GiaSp' => $GiaSp,
        ':Ghichu' => $Ghichu,
        ':Soluong' => $Soluong,
    


    ));

    return $result; 
}
//thêm hoa đơn
public function themhoadon($MaBn, $MaOder,  $Trangthai, $Thoigian, $TongTien) {
    $sql = 'INSERT INTO hoadon (MaBn, MaOder,  Trangthai, Thoigian, TongTien) VALUES (:MaBn, :MaOder, :Trangthai, :Thoigian, :TongTien)';
    
    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaBn' => $MaBn,
        ':MaOder' => $MaOder,
        ':Trangthai' => $Trangthai,
        ':Thoigian' => $Thoigian,
        ':TongTien' => $TongTien,
    ));

    $MaHd = $this->conn->lastInsertId();

    // Trả về MaOder
    return $MaHd;
}

//oder
public function insertOder($MaBn, $TongTien, $MaMn, $TrangThai, $Ngay) {
    $sql = "INSERT INTO oder (MaBn, TongTien, MaMn, TrangThai, Ngay) VALUES (:MaBn, :TongTien, :MaMn, :TrangThai , :Ngay)";
    
    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaBn' => $MaBn,
        ':TongTien' => $TongTien,
        ':MaMn' => $MaMn,
        ':TrangThai' => $TrangThai,
        ':Ngay' => $Ngay,

    ));

    $MaOder = $this->conn->lastInsertId();

    // Trả về MaOder
    return $MaOder;
}

public function insertOderchitiet($MaOder, $TenDu, $Soluong, $Giatien, $MaBn) {
    $sql = "INSERT INTO thongtinoder (MaOder, TenDu, Soluong, Giatien, MaBn) VALUES (:MaOder, :TenDu, :Soluong, :Giatien, :MaBn)";
    
    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        ':MaOder' => $MaOder,
        ':TenDu' => $TenDu,
        ':Soluong' => $Soluong,
        ':Giatien' => $Giatien,
        ':MaBn' => $MaBn,
    ));
    
    
    return $result; 
}

//hoadonchitiet
public function hoadonchitiet1($MaHd,$TenLh, $SoLuong, $GiaTien) {
    $sql = "INSERT INTO chitiethoadon (MaHd, TenLh, SoLuong, GiaTien) VALUES (:MaHd, :TenLh, :SoLuong, :GiaTien)";
    
    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        ':MaHd' => $MaHd,
        ':TenLh' => $TenLh,
        ':SoLuong' => $SoLuong,
        ':GiaTien' => $GiaTien,
    ));
    
    // Return the result of the insert operation, true for success or false for failure
    return $result; 
}




//loaihang
public function insertLoaihang($TenLh, $Ghichu) {
    

    $sql = 'INSERT INTO loaihang (TenLh, Ghichu ) VALUES (:TenLh, :Ghichu)';

    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        ':TenLh' => $TenLh,
        ':Ghichu' => $Ghichu,

    ));

    return $result; 
}
//capnhat
public function updateOder($MaOder, $TongTien, $TrangThai )
{
    $sql = 'UPDATE oder
            SET TongTien = :TongTien, TrangThai = :TrangThai
            Where MaOder = :MaOder ';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaOder' => $MaOder,
        ':TongTien' => $TongTien,
        ':TrangThai' => $TrangThai
        
    ));

    return $query->rowCount() > 0;
}
//chapnhatthongtinoder
public function updatethongtinoder($MaOder, $TenDu, $Soluong, $Giatien, $MaBn)
{
    $sql = 'UPDATE thongtinoder
            SET TenDu = :TenDu, Soluong = :Soluong, Giatien = :Giatien, MaBn = :MaBn
            WHERE MaOder = :MaOder ';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaOder' => $MaOder,
        ':TenDu' => $TenDu,
        ':Soluong' => $Soluong,
        ':Giatien' => $Giatien,
        ':MaBn' => $MaBn
    ));

    return $query->rowCount() > 0;
}
public function updateThanhtoan($MaOder, $TrangThai)
{
    $sql = 'UPDATE oder
            SET TrangThai = :TrangThai
            WHERE MaOder = :MaOder';    

    $query = $this->conn->prepare($sql);
    $query->execute(array( 
        ':MaOder' => $MaOder,
        ':TrangThai' => $TrangThai,
       
    ));

    return $query->rowCount() > 0;
}
//thêm bàn
public function insertBan($MaBn, $TenBan, $Trangthai) {
    // $unique_id = uniqid('', true);

    $sql = 'INSERT INTO ban (MaBn, TenBan, Trangthai) VALUES (:MaBn, :TenBan, :Trangthai)';

    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        // ':unique_id' => $unique_id,
        ':MaBn' => $MaBn,
        ':TenBan' => $TenBan,
        ':Trangthai' => $Trangthai,

    ));

    return $result; 
}
public function updateban1($MaBn,  $Trangthai) {
    // $unique_id = uniqid('', true);

    $sql = 'UPDATE ban
    SET  Trangthai = :Trangthai
    Where MaBn = :MaBn';

    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        // ':unique_id' => $unique_id,
        ':MaBn' => $MaBn,
       
        ':Trangthai' => $Trangthai,

    ));

    return $result; 
}
//suanhacc
public function updateNhacungcap($MaNcc, $TenNcc, $Diachi , $Sdt)
{
    $sql = 'UPDATE nhacungcap
            SET TenNcc = :TenNcc, Diachi = :Diachi, Sdt = :Sdt
            Where MaNcc = :MaNcc ';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaNcc' => $MaNcc,
        ':TenNcc' => $TenNcc,
        ':Diachi' => $Diachi,
        ':Sdt' => $Sdt
        
    ));

    return $query->rowCount() > 0;
}
//sửa menu
public function suamenu($MaMn, $TenDu, $Giatien)
{
    $sql = 'UPDATE menu
            SET TenDu = :TenDu, Giatien = :Giatien
            Where MaMn = :MaMn ';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaMn' => $MaMn,
        ':TenDu' => $TenDu,
        ':Giatien' => $Giatien
        
    ));

    return $query->rowCount() > 0;
}
//sửa nhân viên
public function suanhanvien1($MaNv, $TenNv, $TenDn,$Matkhau,$Sdt,$Diachi,$Chucvu)
{
    $sql = 'UPDATE nhanvien
            SET TenNv = :TenNv, TenDn = :TenDn, Matkhau = :Matkhau, Sdt = :Sdt, Diachi = :Diachi, Chucvu = :Chucvu
            Where MaNv = :MaNv ';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaNv' => $MaNv,
        ':TenNv' => $TenNv,
        ':TenDn' => $TenDn,
        ':Matkhau' => $Matkhau,
        ':Sdt' => $Sdt,
        ':Diachi' => $Diachi,
        ':Chucvu' => $Chucvu
    
    ));

    return $query->rowCount() > 0;
}
//xoa hh
public function xoahh($MaHH) {
    

    $sql = 'DELETE FROM hanghoa WHERE MaHH = :MaHH';

    $query = $this->conn->prepare($sql);
    $query->execute(array(':MaHH' => $MaHH));

    return $query->rowCount() > 0; 
}
//xoanhacc  ;
public function xoancc2($MaNcc) {
    

    $sql = 'DELETE FROM nhacungcap WHERE MaNcc = :MaNcc';

    $query = $this->conn->prepare($sql);
    $query->execute(array(':MaNcc' => $MaNcc));

    return $query->rowCount() > 0; 
}


public function insertNhacungcap($TenNcc, $Diachi, $Sdt) {
    $sql = 'INSERT INTO nhacungcap (TenNcc, Diachi, Sdt) VALUES (:TenNcc, :Diachi, :Sdt)';
    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        ':TenNcc' => $TenNcc,
        ':Diachi' => $Diachi,
        ':Sdt' => $Sdt
    ));

    return $result;
}

//thêm nhân viên
public function insertNhanVien($MaNv, $TenNv, $TenDn, $Matkhau, $Sdt, $Diachi,$Chucvu){
   
    $sql = 'INSERT INTO nhanvien ( MaNv, TenNv, TenDn, Matkhau, Sdt, Diachi, Chucvu) VALUES ( :MaNv, :TenNv, :TenDn, :Matkhau, :Sdt, :Diachi, :Chucvu)';
    $query =$this->conn->prepare($sql);
    $result = $query->execute(array(
        
        ':MaNv' =>$MaNv,
        ':TenNv'=>$TenNv,
        ':TenDn'=>$TenDn,
        ':Matkhau'=>$Matkhau,
        ':Sdt'=>$Sdt,
        ':Diachi'=>$Diachi,
        ':Chucvu'=>$Chucvu,
    ));
    return $result; 
}
//thêm đồ uống
public function insertMenu($MaMn, $TenDu, $Giatien) {
    // $unique_id = uniqid('', true);
    $sql = 'INSERT INTO menu (MaMn, TenDu, Giatien) VALUES (:MaMn, :TenDu, :Giatien)';
    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        // ':unique_id' => $unique_id,
        ':MaMn' => $MaMn,
        ':TenDu' => $TenDu,
        ':Giatien' => $Giatien,
    ));
    return $result; 
}


public function checkLogin($TenDn, $Matkhau) {
    $sql = 'SELECT * FROM nhanvien WHERE TenDn = :TenDn';
    $query = $this->conn->prepare($sql);
    $query->execute(array(':TenDn' => $TenDn));
    $data = $query->fetchObject();

    if ($data) {
        $storedPassword = $data->Matkhau;
        $Chucvu = $data->Chucvu;

        if ($Matkhau === $storedPassword) {
            // Thực hiện truy vấn khác để lấy họ tên, SDT và địa chỉ
            $infoSql = 'SELECT MaNv, TenNv, Sdt, Diachi FROM nhanvien WHERE TenDn = :TenDn';
            $infoQuery = $this->conn->prepare($infoSql);
            $infoQuery->execute(array(':TenDn' => $TenDn));
            $infoData = $infoQuery->fetchObject();

            $MaNv = $infoData->MaNv;
            $TenNv = $infoData->TenNv;
            $Sdt = $infoData->Sdt;
            $Diachi = $infoData->Diachi;
            

            $user = array(
                "MaNv" => $MaNv,
                "TenNv" => $TenNv,
                "Sdt" => $Sdt,
                "Diachi" => $Diachi,
                "Chucvu" => $Chucvu
            
            );

            return $user;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

public function updateHanghoa($MaHH, $MaNcc, $TenLh , $TenHh, $GiaSp, $Ghichu, $Soluong)
{
    $sql = 'UPDATE hanghoa
            SET MaNcc = :MaNcc, TenLh = :TenLh, TenHh = :TenHh, GiaSp = :GiaSp, Ghichu = :Ghichu, Soluong = :Soluong
            Where MaHH = :MaHH ';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaHH' => $MaHH,
        ':MaNcc' => $MaNcc,
        ':TenLh' => $TenLh,
        ':TenHh' => $TenHh,
        ':GiaSp' => $GiaSp,
        ':Ghichu' => $Ghichu,
        ':Soluong' => $Soluong
    ));

    return $query->rowCount() > 0;
}


public function checkPermission($Chucvu) {
    
    if ($Chucvu === '1') {
        
        return true;
    } else {
        
        return false;
    }
}

//tim
 public function timnhanvien($MaNv) {
    $sql = 'SELECT * FROM nhanvien WHERE MaNv = :MaNv';
    $query = $this->conn->prepare($sql);
    $query->execute(array(':MaNv' => $MaNv));
    $data = $query->fetch(PDO::FETCH_ASSOC);

    return $data;
}
//sua
 public function updateThongtin($manv, $tennv, $sdt, $diachi)
{
    $sql = 'UPDATE nhanvien
            SET TenNv = :TenNv, TenDn = :TenDn, Matkhau = :Matkhau,Sdt = :Sdt,Diachi = :Diachi,Chucvu = :Chucvu
            WHERE MaNv = :MaNv';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':MaNv' => $MaNv,
        ':TenNv' => $TenNv,
        ':TenDn' => $TenDn,
        ':Matkhau' => $Matkhau,
        ':Sdt' => $Sdt,
        ':Diachi' => $Diachi,
        ':Chucvu' => $Chucvu
    ));

    return $query->rowCount() > 0;
}
//xóa nhân viên
public function xoanhanvien($MaNv) {
    $sql = 'DELETE FROM nhanvien WHERE MaNv = :MaNv';
    $query = $this->conn->prepare($sql);
    $query->execute(array(':MaNv' => $MaNv));
    // $data = $query->fetch(PDO::FETCH_ASSOC);

    return $query->rowCount()>0;
}
//xóa menu
 public function xoamenu($MaMn) {
    $sql = 'DELETE FROM menu WHERE MaMn = :MaMn';
    $query = $this->conn->prepare($sql);
    $query->execute(array(':MaMn' => $MaMn));
    // $data = $query->fetch(PDO::FETCH_ASSOC);

    return $query->rowCount()>0;
}

 public function doimatkhau($TenDn, $Matkhau) {
    

    $sql = 'UPDATE nhanvien SET Matkhau = :Matkhau WHERE TenDn = :TenDn';

    $query = $this->conn->prepare($sql);
    $query->execute(array(':TenDn' => $TenDn, ':Matkhau' => $Matkhau));

    return $query->rowCount() > 0; // Trả về true nếu có dòng được cập nhật
}

 

 public function resetPassword($email,$code,$password){


    $sql = 'SELECT * FROM password_reset_request WHERE email = :email';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array(':email' => $email));
    $data = $query -> fetchObject();
    $salt = $data -> salt;
    $db_encrypted_temp_password = $data -> encrypted_temp_password;

    if ($this -> verifyHash($code.$salt,$db_encrypted_temp_password) ) {

        $old = new DateTime($data -> created_at);
        $now = new DateTime(date("Y-m-d H:i:s"));
        $diff = $now->getTimestamp() - $old->getTimestamp();

        if($diff < 120) {

            return $this -> changePassword($email, $password);

        } else {

            false;
        }


    } else {

        return false;
    }

 }


 public function checkUserExist($TenDn){

    $sql = 'SELECT COUNT(*) from nhanvien WHERE TenDn =:TenDn';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array('TenDn' => $TenDn));

    if($query){

        $row_count = $query -> fetchColumn();

        if ($row_count == 0){

            return false;

        } else {

            return true;

        }
    } else {

        return false;
    }
 }
 public function checkManv($MaHH){

    $sql = 'SELECT COUNT(*) from hanghoa WHERE MaHH =:MaHH';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array('MaHH' => $MaHH));

    if($query){

        $row_count = $query -> fetchColumn();

        if ($row_count == 0){

            return false;

        } else {

            return true;

        }
    } else {

        return false;
    }
 }
 //check mã nhân viên
 public function checkMaNv1($MaNv){

    $sql = 'SELECT COUNT(*) from nhanvien WHERE MaNv =:MaNv';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array('MaNv' => $MaNv));

    if($query){

        $row_count = $query -> fetchColumn();

        if ($row_count == 0){

            return false;

        } else {

            return true;

        }
    } else {

        return false;
    }
 }
 //check mã món
  public function checkMaMn($MaMn){

    $sql = 'SELECT COUNT(*) from menu WHERE MaMn =:MaMn';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array('MaMn' => $MaMn));

    if($query){

        $row_count = $query -> fetchColumn();

        if ($row_count == 0){

            return false;

        } else {

            return true;

        }
    } else {

        return false;
    }
 }
 public function checkLoaihh($TenLh){

    $sql = 'SELECT COUNT(*) from loaihang WHERE TenLh =:TenLh';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array('TenLh' => $TenLh));

    if($query){

        $row_count = $query -> fetchColumn();

        if ($row_count == 0){

            return false;

        } else {

            return true;

        }
    } else {

        return false;
    }
 }
 public function checkMancc($MaNcc){

    $sql = 'SELECT COUNT(*) from nhacungcap WHERE MaNcc =:MaNcc';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array('MaNcc' => $MaNcc));

    if($query){

        $row_count = $query -> fetchColumn();

        if ($row_count == 0){

            return false;

        } else {

            return true;

        }
    } else {

        return false;
    }
 }

 public function getHash($password) {

     $salt = sha1(rand());
     $salt = substr($salt, 0, 10);
     $encrypted = password_hash($password.$salt, PASSWORD_DEFAULT);
     $hash = array("salt" => $salt, "encrypted" => $encrypted);

     return $hash;

}



public function verifyHash($password, $hash) {

    return password_verify ($password, $hash);
}
public function beginTransaction() {
    return $this->conn->beginTransaction();
}

}