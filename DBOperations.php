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


 public function insertData($name,$email,$password){

 	$unique_id = uniqid('', true);
    $hash = $this->getHash($password);
    $encrypted_password = $hash["encrypted"];
	$salt = $hash["salt"];

 	$sql = 'INSERT INTO users SET unique_id =:unique_id,name =:name,
    email =:email,encrypted_password =:encrypted_password,salt =:salt,created_at = NOW()';

 	$query = $this ->conn ->prepare($sql);
 	$query->execute(array('unique_id' => $unique_id, ':name' => $name, ':email' => $email,
     ':encrypted_password' => $encrypted_password, ':salt' => $salt));

    if ($query) {

        return true;

    } else {

        return false;

    }
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
	public function updatenhanvien($MaNv, $TenNv, $TenDn, $Matkhau,$Sdt,$Diachi,$Chucvu)
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
	public function insertMenu($MaMn, $TenLh, $Giatien) {
    // $unique_id = uniqid('', true);
    $sql = 'INSERT INTO menu (MaMn, TenLh, Giatien) VALUES (:MaMn, :TenLh, :Giatien)';
    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        // ':unique_id' => $unique_id,
        ':MaMn' => $MaMn,
        ':TenLh' => $TenLh,
        ':Giatien' => $Giatien,
    ));
    return $result; 
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
public function insertMenu($MaMn, $TenLh, $Giatien) {
    // $unique_id = uniqid('', true);
    $sql = 'INSERT INTO menu (MaMn, TenLh, Giatien) VALUES (:MaMn, :TenLh, :Giatien)';
    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        // ':unique_id' => $unique_id,
        ':MaMn' => $MaMn,
        ':TenLh' => $TenLh,
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
            SET tennv = :tennv, sdt = :sdt, diachi = :diachi
            WHERE manv = :manv';

    $query = $this->conn->prepare($sql);
    $query->execute(array(
        ':manv' => $manv,
        ':tennv' => $tennv,
        ':sdt' => $sdt,
        ':diachi' => $diachi
    ));

    return $query->rowCount() > 0;
}
//xoa

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
}

