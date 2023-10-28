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
 //thêm hàng hóa
 public function insertHanghoa($MaHH, $MaNcc, $MaLh , $TenHh, $GiaSp, $Ghichu, $Soluong) {
    $unique_id = uniqid('', true);

    $sql = 'INSERT INTO hanghoa (unique_id, MaHH, MaNcc, MaLh, TenHh, GiaSp, Ghichu, Soluong) VALUES (:unique_id, :MaHH, :MaNcc, :MaLh, :TenHh, :GiaSp, :Ghichu, :Soluong)';

    $query = $this->conn->prepare($sql);
    $result = $query->execute(array(
        ':unique_id' => $unique_id,
        ':MaHH' => $MaHH,
        ':MaNcc' => $MaNcc,
        ':MaLh' => $MaLh,
        ':TenHh' => $TenHh,
        ':GiaSp' => $GiaSp,
        ':Ghichu' => $Ghichu,
        ':Soluong' => $Soluong,


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


public function checkPermission($Chucvu) {
    
    if ($Chucvu === '1') {
        
        return true;
    } else {
        
        return false;
    }
}

 //tim
 public function timnhanvien($manv) {
    $sql = 'SELECT * FROM nhanvien WHERE manv = :manv';
    $query = $this->conn->prepare($sql);
    $query->execute(array(':manv' => $manv));
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
public function deleteThongtin($manv)
{
    $sql = 'DELETE FROM nhanvien WHERE manv = :manv';

    $query = $this->conn->prepare($sql);
    $query->execute(array(':manv' => $manv));

    return $query->rowCount() > 0;
}


 public function changePassword($name, $password){


    $hash = $this -> getHash($password);
    $encrypted_password = $hash["encrypted"];
    $salt = $hash["salt"];

    $sql = 'UPDATE users SET encrypted_password = :encrypted_password, salt = :salt WHERE name = :name';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array(':name' => $name, ':encrypted_password' => $encrypted_password, ':salt' => $salt));

    if ($query) {

        return true;

    } else {

        return false;

    }

 }

 public function passwordResetRequest($email){

    $random_string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
    $hash = $this->getHash($random_string);
    $encrypted_temp_password = $hash["encrypted"];
    $salt = $hash["salt"];

    $sql = 'SELECT COUNT(*) from password_reset_request WHERE email =:email';
    $query = $this -> conn -> prepare($sql);
    $query -> execute(array('email' => $email));

    if($query){

        $row_count = $query -> fetchColumn();

        if ($row_count == 0){


            $insert_sql = 'INSERT INTO password_reset_request SET email =:email,encrypted_temp_password =:encrypted_temp_password,
                    salt =:salt,created_at = :created_at';
            $insert_query = $this ->conn ->prepare($insert_sql);
            $insert_query->execute(array(':email' => $email, ':encrypted_temp_password' => $encrypted_temp_password,
            ':salt' => $salt, ':created_at' => date("Y-m-d H:i:s")));

            if ($insert_query) {

                $user["email"] = $email;
                $user["temp_password"] = $random_string;

                return $user;

            } else {

                return false;

            }


        } else {

            $update_sql = 'UPDATE password_reset_request SET email =:email,encrypted_temp_password =:encrypted_temp_password,
                    salt =:salt,created_at = :created_at';
            $update_query = $this -> conn -> prepare($update_sql);
            $update_query -> execute(array(':email' => $email, ':encrypted_temp_password' => $encrypted_temp_password,
            ':salt' => $salt, ':created_at' => date("Y-m-d H:i:s")));

            if ($update_query) {

                $user["email"] = $email;
                $user["temp_password"] = $random_string;
                return $user;

            } else {

                return false;

            }

        }
    } else {

        return false;
    }


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
