<?php
    require_once("../../models/DBLayer.php");
    
    class Admin{

        public function adminLogin($username, $password){
            $conn = DB::connection();
            try{
                $stmt=$conn->prepare("SELECT * FROM users WHERE username=:id");
                $stmt->bindParam(':id', $username);
                $stmt->execute();
                $row=$stmt->fetch();
                if($stmt->rowCount()<1){
                    echo 'Your credentials are invalid';
                }else{
                    if(password_verify($password,$row['password'])){
                        $_SESSION['admin']=$row;
                        echo 'success';
                    }else{
                        echo 'Your credentials are invalid';
                    }
                }
            }catch(PDOException $e){
                echo 'Login failed';
            }
        }

        public function changePassword($id, $currentPassword, $password)
        {
            $con = DB::connection();
            try{
                $row = Model::findorFail('users', $id);
                if(password_verify($currentPassword, $row['password'])){
                    $hash=password_hash($password,PASSWORD_DEFAULT);
                    $stmt=$con->prepare("UPDATE users SET password=:pass WHERE id=:id");
                    $stmt->bindParam(':pass', $hash);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    return 'success';
                }
                else{
                    return 'Current password does not exist';
                }
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }

        public function saveUser($username, $name, $type, $password)
        {
            $con = DB::connection();
            try{
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $dateTime = gmdate('Y-m-d H:i');
                $stmt=$con->prepare("INSERT INTO users(username, name, password,role,created_at)VALUES(:u,:n,:p,:r,:c)");
                $stmt->bindParam(':u', $username);
                $stmt->bindParam(':n', $name);
                $stmt->bindParam(':p', $hash);
                $stmt->bindParam(':r', $type);
                $stmt->bindParam(':c', $dateTime);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }

        public function deleteUser($id)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare("DELETE FROM users WHERE id=:id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }


    }
    
