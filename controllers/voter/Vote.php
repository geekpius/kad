<?php
    require_once("../../models/DBLayer.php");
    
    class Vote{

        public function login($accessNo){
            $conn = DB::connection();
            try{
                $stmt=$conn->prepare("SELECT * FROM voters WHERE access_number=:id");
                $stmt->bindParam(':id', $accessNo);
                $stmt->execute();
                $row=$stmt->fetch();
                if($stmt->rowCount()<1){
                    return 'Your access number is invalid.';
                }else{
                    if(!$row['verify']){
                        return 'Contact verification point.';
                    }elseif($row['status']){
                        return 'You have already voted.';
                    }else{
                        $_SESSION['voter']=$row;
                        return 'success';
                    }
                }
            }catch(PDOException $e){
                return 'Login failed';
            }
        }

        public function saveVoterCart($userId, $candidate, $position, $createdAt){
            $countCart = Model::countWhere("SELECT COUNT(*) FROM voter_carts WHERE voter_id=:id AND position=:pos", array(':id'=>$userId, ':pos'=>$position));
            if($countCart>0){
                $updateCart = Model::update("UPDATE voter_carts SET candidate=:can WHERE voter_id=:id AND position=:pos", array(':id'=>$userId, ':can'=>$candidate, ':pos'=>$position));
            }
            else{
                $saveCart  = Model::save("INSERT INTO voter_carts(voter_id,candidate,position,created_at)VALUES(:id,:can,:pos,:cr)", array(':id'=>$userId, ':can'=>$candidate, ':pos'=>$position,':cr'=>$createdAt));
            }
        }

        public function submitVotes($userId, array $candidates, $createdAt){
            $con = DB::connection();
            try{
                $con->beginTransaction();
                for($i=0; $i<count($candidates); $i++){
                    $can = $candidates[$i];
                    if($can!=='Skipped' && $can!=='No'){
                        $stmt = $con->prepare("UPDATE candidates SET vote=vote+:v WHERE name=:n");
                        $stmt->execute(array(':v'=>1, ':n'=>$can));
                    }

                    $stmt = $con->prepare("INSERT INTO votes(voter_id,candidate,created_at)VALUES(:id,:c,:cr)");
                    $stmt->execute(array(':id'=>$userId, ':c'=>$can, ':cr'=>$createdAt));
                }
                //update voter status
                $stmt = $con->prepare("UPDATE voters SET status=:s WHERE id=:id");
                $stmt->execute(array(':s'=>true, ':id'=>$userId));
                $con->commit();
                header('Location: ../../vote/notification.php');
            }catch(PDOException $e){
                $con->rollBack();
                echo 'Something went wrong';
            }
        }

        


    }
    
