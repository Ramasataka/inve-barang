<?php

Class System extends Database {
    
    public function start_session()
    {
        if( !session_id() ) {
            session_start();
        }
    }

    public function validatehtml($text)
    {
        $field = htmlspecialchars($text);
        return $field;
    }
    
    public function login($username, $password)
    {
    try{

        if (empty($username) || empty($password)){
            Flasher::setFlasher('LOGIN GAGAL', 'FIELD KOSONG', 'danger');
            $redirectUrl = "index.php";
            header("Location: $redirectUrl");
            exit;    
        }else{
            $pdo = $this->connectDB();
            $query = "SELECT * FROM user WHERE username = :username AND password = :password";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $log = $stmt->execute();
            
            if ($log) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row !== false) {
                        $role = $row['role'];
                        $id_user = $row['id_user'];
                        $role= $row['role'];
                        $count = $stmt->rowCount();
                        
                        // session_start();
                        if ($count > 0) {
                            switch($role){
                                case 'ADMIN' :
                                    $_SESSION["user"] = $id_user;
                                    $_SESSION["role"] = $role;  
                                    // var_dump($_SESSION['user']);
                                    header("location:views/admin/homepage.php");
                                    break;
                                case 'KARYAWAN' :
                                    $_SESSION["user"] = $id_user;  
                                    $_SESSION["role"] = $role;  
                                    // var_dump($_SESSION['user']);
                                    header("location:views/user/homepage.php");
                                    break;
                            }
                        } else {
                            Flasher::setFlasher('LOGIN GAGAL', 'DATA TIDAK COCOK', 'danger');
                            $redirectUrl = "index.php";
                            header("Location: $redirectUrl");
                            exit; 
                        }
                    } else {
                        Flasher::setFlasher('LOGIN GAGAL', 'DATA SALAH', 'danger');
                        $redirectUrl = "index.php";
                        header("Location: $redirectUrl");
                        exit; 
                    }
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }

    public function checkLogin()
    {
        return isset($_SESSION['user']);
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user']);
        $redirectUrl = "../../index.php";
        header("Location: $redirectUrl");
        return true;
    }
}