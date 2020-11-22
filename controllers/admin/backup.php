
<?php

require_once("../../models/DBLayer.php");

$con = DB::connection();
function backUPDatabase($con, $tables = '*'){
    try{
        if($tables=='*'){
            $tables = array();
            $result = $con->prepare("SHOW TABLES");
            $result->execute();
            $rows = $result->fetchAll();
            foreach($rows as $row){
                $tables[] = $row[0];
            }
        }else{
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }

        //cycle through
        $return='';
        foreach($tables as $table)
        {
            $result = $con->prepare("DESCRIBE ".$table);
            $result->execute();
            $num_fields = $result->fetchAll(PDO::FETCH_COLUMN);

            $select = $con->prepare("SELECT * FROM ".$table);
            $select->execute();
            
            $return.= 'DROP TABLE '.$table.';';
            $row2 = $con->prepare("SHOW CREATE TABLE ".$table);
            $row2->execute();
            $get = $row2->fetch(PDO::FETCH_NUM);
            $return.= "\n\n".$get[1].";\n\n";

            for ($i = 0; $i < $num_fields = $result->fetch(PDO::FETCH_COLUMN); $i++)
            {
                while($row = $select->fetchAll())
                {
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$num_fields = $result->fetch(PDO::FETCH_COLUMN); $j++)
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                        if ($j<($num_fields-1)) { $return.= ','; }
                    }
                    $return.= ");\n";
                }
            }
            $return.="\n\n\n";
        }

        //save file
        $handle = fopen('../../dbase/evotingBackup.sql','w+');
        fwrite($handle,$return);
        fclose($handle);
    }catch(Exception $e){

    }
}

backUPDatabase($con);


?>
<div style="text-align: center; margin-top: 20px; margin-bottom:20px;" id="move">
Database Backup successfully<br>
<!--Backup File can be found in db-backup.sql<br>-->
<a href="../dbase/evotingBackup.sql" target="_blank">Download Backup</a><br>
</div>