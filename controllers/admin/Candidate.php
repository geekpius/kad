<?php
    require_once("../../models/DBLayer.php");
    
    class Candidate{

        public function saveCandidate($name, $position, $gender, $house, $image)
        {
            $maxcon = Model::first("SELECT * FROM positions WHERE name=:n LIMIT 1", array(':n'=>$position));
            $countCandidate = Model::countWhere("SELECT COUNT(*) FROM candidates WHERE position=:p", array(':p'=>$position));
            if($maxcon['maxcon']<=$countCandidate){
                return $position.' has reached it maximum';
            }
            else{
                $con = DB::connection();
                try{
                    $dateTime = gmdate('Y-m-d H:i');
                    $stmt=$con->prepare("INSERT INTO candidates(name, position, gender, house, image, created_at)VALUES(:n,:p,:g,:h,:i,:c)");
                    $stmt->bindParam(':n', $name);
                    $stmt->bindParam(':p', $position);
                    $stmt->bindParam(':g', $gender);
                    $stmt->bindParam(':h', $house);
                    $stmt->bindParam(':i', $image);
                    $stmt->bindParam(':c', $dateTime);
                    $stmt->execute();
                    return 'success';
                }catch(PDOException $e){
                    return 'Something went wrong';
                }
            }
        }

        public function updateCandidate($name, $position, $gender, $id)
        {
            $con = DB::connection();
            try{
                $dateTime = gmdate('Y-m-d H:i');
                $stmt=$con->prepare("UPDATE candidates SET name=:n, position=:m, gender=:g WHERE id=:id");
                $stmt->bindParam(':n', $name);
                $stmt->bindParam(':m', $position);
                $stmt->bindParam(':g', $gender);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }


        public function deleteCandidate($id)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare("SELECT * FROM candidates WHERE id=:id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch();
                if($stmt->rowCount()>0){
                    unlink("../../assets/images/candidates/".$row['image']);
                }

                $stmt=$con->prepare("DELETE FROM candidates WHERE id=:id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }


    }
    
