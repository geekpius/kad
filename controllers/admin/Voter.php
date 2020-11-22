<?php
    require_once("../../models/DBLayer.php");
    
    class Voter{

        public function saveVoter($accessNo, $name, $gender, $cls, $house)
        {
            $dateTime = gmdate('Y-m-d H:i');
            if(Model::countWhere("SELECT COUNT(*) FROM voters WHERE access_number=:a",array(':a'=>$accessNo))>0){
                return 'Access Number <'.$accessNo.'> is already taken';
            }
            else{
                $voter = Model::save("INSERT INTO voters(access_number,name,gender,cls,house,created_at)VALUES(:a,:n,:g,:c,:h,:ca)", array(':a'=>$accessNo,':n'=>$name, ':g'=>$gender,':c'=>$cls,':h'=>$house,':ca'=>$dateTime));
                if($voter){
                    return 'success';
                }else{
                    return 'Something went wrong';
                }
            }
        }

        public function updateVoter($id, $name, $gender, $cls, $house)
        {
            $voter = Model::update("UPDATE voters SET name=:n,cls=:c,house=:h,gender=:g WHERE id=:id", array(':n'=>$name,':c'=>$cls,':h'=>$house,':g'=>$gender,':id'=>$id));
            if($voter){
                return 'success';
            }else{
                return 'Something went wrong';
            }
        }


        public function deleteVoter($id)
        {
            $voter = Model::deleteWithID('voters', $id);
            return 'success';
        }

        public function resetVoter($id)
        {
            $candidates = Model::filter("SELECT * FROM votes WHERE voter_id=:id", array(':id'=>$id));
            $con = DB::connection();
            try{
                $con->beginTransaction();
                foreach($candidates as $can){
                    // if candidate is not skipped or no deduct 1 from candidates voted for
                    $candidate = $can['candidate'];
                    if($candidate!=='Skipped' && $candidate!=='No'){
                        $stmt = $con->prepare("UPDATE candidates SET vote=vote-:v WHERE name=:n");
                        $stmt->execute(array(':v'=>1, ':n'=>$candidate));
                    }
                }
                //delete votes
                $stmt = $con->prepare("DELETE FROM votes WHERE voter_id=:id");
                $stmt->execute(array(':id'=>$id));
                // delete voter cart
                $stmt = $con->prepare("DELETE FROM voter_carts WHERE voter_id=:id", array(':id'=>$id));
                $stmt->execute(array(':id'=>$id));
                //update voter status back to false
                $stmt = $con->prepare("UPDATE voters SET status=:s WHERE id=:id");
                $stmt->execute(array(':s'=>false, ':id'=>$id));
                $con->commit();
                return 'success';
            }catch(PDOException $e){
                $con->rollBack();
                return 'Something went wrong';
            }
        }

        public function verifyVoter($id)
        {
            $voter = Model::update("UPDATE voters SET verify=:v WHERE id=:id", array(':v'=>true, ':id'=>$id));
            return 'success';
        }

        public function importVoters($file)
        {
            $conn = DB::connection();
            try{
                $conn->beginTransaction();
                //$file_name=explode(".",$_FILES['excel']['name']);
                $openfile=fopen($file,"r");
                $number=0;
                while($dataFile=fgetcsv($openfile,3000,",")){
                    $number++;
                    $accessNo=$dataFile[0];
                    $name=$dataFile[1];
                    $gender=$dataFile[2];
                    $cls=empty($dataFile[3])? null : $dataFile[3];
                    $house=empty($dataFile[4])? null : $dataFile[4];
                    
                    if($number!=1){
                        $stmt=$conn->prepare("INSERT INTO voters(access_number,name,gender,house,cls)VALUES(:id,:n,:g,:h,:c)");
                        $stmt->execute(array(':id'=>$accessNo, ':n'=>$name, ':g'=>$gender, ':h'=>$house, ':c'=>$cls));
                    }
                }
                $conn->commit();
                return 'success';
                }catch(PDOException $ex){
                    $conn->rollBack();
                    return 'Something went wrong';
                }
        }

    }
    
