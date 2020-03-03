<?php
    require_once("../../models/DBLayer.php");
    
    class House{

        public function saveHouse($name, $alias)
        {
            $con = DB::connection();
            try{
                $dateTime = gmdate('Y-m-d H:i');
                $stmt=$con->prepare("INSERT INTO houses(name, alias, created_at)VALUES(:n,:a,:c)");
                $stmt->bindParam(':n', $name);
                $stmt->bindParam(':a', $alias);
                $stmt->bindParam(':c', $dateTime);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }

        public function deleteHouse($id)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare("DELETE FROM houses WHERE id=:id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }


    }
    
