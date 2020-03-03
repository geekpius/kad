<?php
    require_once("../../models/DBLayer.php");
    
    class Position{

        public function savePosition($name, $criteria, $type, $max_con)
        {
            $con = DB::connection();
            try{
                $dateTime = gmdate('Y-m-d H:i');
                $stmt=$con->prepare("INSERT INTO positions(name, criteria, type, maxcon, created_at)VALUES(:n,:cr,:t,:m,:c)");
                $stmt->bindParam(':n', $name);
                $stmt->bindParam(':cr', $criteria);
                $stmt->bindParam(':t', $type);
                $stmt->bindParam(':m', $max_con);
                $stmt->bindParam(':c', $dateTime);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }

        public function updatePosition($name, $max_con, $id)
        {
            $con = DB::connection();
            try{
                $dateTime = gmdate('Y-m-d H:i');
                $stmt=$con->prepare("UPDATE positions SET name=:n, maxcon=:m WHERE id=:id");
                $stmt->bindParam(':n', $name);
                $stmt->bindParam(':m', $max_con);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }


        public function deletePosition($id)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare("DELETE FROM positions WHERE id=:id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }


    }
    
