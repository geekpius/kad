<?php
    require_once("../../models/DBLayer.php");
    
    class Setting{

        public function setTime($endDate, $endTime){
            $date = $endDate.' '.$endTime;
            $conn = DB::connection();
            try{
                $stmt=$conn->prepare("UPDATE general_settings SET timer=:d");
                $stmt->bindParam(':d', $date);
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }
        }

        public function factoryReset(){
            $conn = DB::connection();
            try{
                $stmt=$conn->prepare("TRUNCATE TABLE votes");
                $stmt->execute();
                //reset cart
                $stmt=$conn->prepare("TRUNCATE TABLE voter_carts");
                $stmt->execute();
                //reset voters
                $stmt=$conn->prepare("TRUNCATE TABLE voters");
                $stmt->execute();
                //reset candidates
                $stmt = $conn->prepare("SELECT image FROM candidates");
                $stmt->execute();
                $rows = $stmt->fetchAll();
                foreach($rows as $row){
                    unlink("../../assets/images/candidates/".$row['image']);
                }
                $stmt=$conn->prepare("TRUNCATE TABLE candidates");
                $stmt->execute();
                
                //reset positions
                $stmt=$conn->prepare("TRUNCATE TABLE positions");
                $stmt->execute();
                // reset house
                $stmt=$conn->prepare("TRUNCATE TABLE houses");
                $stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }      
        }

        public function testReset(){
            $conn = DB::connection();
            try{
                $stmt=$conn->prepare("TRUNCATE TABLE votes");
                $stmt->execute();
                //reset cart
                $stmt=$conn->prepare("TRUNCATE TABLE voter_carts");
                $stmt->execute();
                //reset voters
                $stmt = $conn->prepare("UPDATE voters SET status=:s, verify=:v");
                $stmt->execute(array(':s'=>false, ':v'=>false));
                //reset candidates
                $stmt = $conn->prepare("UPDATE candidates SET vote=:v");
                $stmt->execute(array(':v'=>0));
                return 'success';
            }catch(PDOException $e){
                return 'Something went wrong';
            }       
        }


    }
    
