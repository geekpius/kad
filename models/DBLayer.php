<?php 
    class DB {

        public static function connection()
        {
            try{
                $con=new PDO('mysql:host=localhost;dbname=kad;charset=utf8mb4', 'root', '');
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                return $con;
            }catch(PDOException $ex){
                return "Connection Error ";
            }
        }  
 
    }


    class Model {
        
        public static function save($query, array $param)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare($query);
                $stmt->execute($param);
                return true;            
            }catch(PDOException $ex){
                return false;
            }
        } 

        public static function update($query, array $param)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare($query);
                $stmt->execute($param);
                return true;            
            }catch(PDOException $ex){
                return false;
            }
        } 

        public static function deleteWithID(string $tableName, int $id)
        {
            $con = DB::connection();
            try{
                $query = "DELETE FROM ".$tableName." WHERE id=:id";
                $stmt=$con->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return true;       
            }catch(PDOException $ex){
                return false;
            }
        } 

        public static function delete($query, array $param)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare($query);
                $stmt->execute($param);
                return true;            
            }catch(PDOException $ex){
                return false;
            }
        } 

        public static function all(string $tableName)
        {
            $con = DB::connection();
            try{
                $query = "SELECT * FROM ".$tableName." ORDER BY id";
                $stmt=$con->prepare($query);
                $stmt->execute();
                $rows=$stmt->fetchAll();
                return $rows;             
            }catch(PDOException $ex){
                return 'Something went wrong';
            }
        } 

        public static function first($query, array $param)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare($query);
                $stmt->execute($param);
                $row=$stmt->fetch();
                return $row;             
            }catch(PDOException $ex){
                return 'Something went wrong';
            }
        } 

        public static function findorFail(string $tableName, int $id)
        {
            $con = DB::connection();
            try{
                $query = "SELECT * FROM ".$tableName." WHERE id=:id";
                $stmt=$con->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row=$stmt->fetch();
                if(empty($row)){
                    return 'Data not found';
                }    
                else{
                    return $row;
                }        
            }catch(PDOException $ex){
                return 'Something went wrong';
            }
        } 

        
        public static function filter($query,array $param)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare($query);
                $stmt->execute($param);
                $rows=$stmt->fetchAll();
                return $rows;       
            }catch(PDOException $ex){
                return 'Something went wrong';
            }
        } 

        public static function count($query)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare($query);
                $stmt->execute();
                $row=$stmt->fetch();
                return $row['COUNT(*)'];       
            }catch(PDOException $ex){
                return 'Something went wrong';
            }
        } 

        public static function countWhere($query, array $param)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare($query);
                $stmt->execute($param);
                $row=$stmt->fetch();
                return $row['COUNT(*)'];       
            }catch(PDOException $ex){
                return 'Something went wrong';
            }
        } 


        public static function sum(string $columnName, string $tableName)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare("SELECT SUM(".$columnName.") FROM ".$tableName);
                $stmt->execute();
                $row=$stmt->fetch();
                return $row['SUM('.$columnName.')'];       
            }catch(PDOException $ex){
                return 'Something went wrong';
            }
        } 


        public static function sumWhere(string $columnName, string $tableName, string $whereClause, array $param)
        {
            $con = DB::connection();
            try{
                $stmt=$con->prepare("SELECT SUM(".$columnName.") FROM ".$tableName." ".$whereClause);
                $stmt->execute($param);
                $row=$stmt->fetch();
                return $row['SUM('.$columnName.')'];       
            }catch(PDOException $ex){
                return 'Something went wrong';
            }
        } 




        










    }

    





