<?php 

class DVclass {

	public function open() {
        $server = "cicd.server247.info";
        $username = "processmaker";
    	$password  = "P@ssw0rd@processmaker";
    	$database  = "wf_workflow"; 
        $con = mysqli_connect($server,$username,$password,$database); 
        
	return $con;
    }

    public function pdocon() {
        $db=new PDO("mysql:host=cicd.server247.info;port=33064;dbname=wf_workflow;", "processmaker", "P@ssw0rd@processmaker");
        $db->exec('SET NAMES utf8');
        return $db;
    }

    public function close($con) {
        mysqli_close($con);
    }

	public function selectAll($object){
		$count = 0;
        $fields = '';
        $con = $this->open();
        $query = "SELECT * FROM `$object` ORDER BY id DESC";
        $result = mysqli_query($con, $query);
        if ($result){
            $count = mysqli_num_rows($result);
            if ($count >= 1) { 
                while ($rows = $result->fetch_object()) {
                    $objects[] = $rows;
                }
                $this->close($con);
                return $this->jesonEncode($objects);
            }
        }
	}
    
	public function SelectAllByID($object, $object_array) {
        //print_r($object_array);
        $count = 0;
        $fields = '';
        $con = $this->open();
        if (count($object_array) <= 1) {
            foreach ($object_array as $col => $val) {
                if ($count++ != 0)
                    $fields .= ', ';
                $col = mysqli_real_escape_string($con, $col);
                $val = mysqli_real_escape_string($con, $val);
                $fields .= "`$col` = '$val'";
            }
        }
        $query = "SELECT * FROM `$object` WHERE $fields";
        //echo $query; die();
        $result = mysqli_query($con, $query);
        if ($result) {
            $count = mysqli_num_rows($result);
            if ($count >= 1) { 
                while ($rows = $result->fetch_object()) {
                    $objects[] = $rows;
                }
                $this->close($con);
                return $this->jesonEncode($objects);
            }
        } else {
            $this->close($con);
            return 0;
        }
    }

    public function jesonEncode($data){
        /*header('Access-Control-Allow-Origin: *');*/
    	header('Content-Type: application/json');
        return json_encode($data);
    }

    function SelectAllByID_Multiple($object, $object_array, $data)
    {
        $count = 0;
        $fields = '';
        $con = $this->open();
            foreach ($object_array as $col => $val)
            {
                if ($count++ != 0)
                $fields .= ' AND ';
            $col = mysqli_real_escape_string($con, $col);
            $val = mysqli_real_escape_string($con, $val);
            $fields .= "`$col` = '$val' ";
            }

        $query = "SELECT * FROM `$object` WHERE $fields GROUP BY `$data` ASC";
        $result = mysqli_query($con, $query);
        if ($result) {
            $count = mysqli_num_rows($result);

            if ($count >= 1)
			{
                //$object[]=array();
                while ($rows = $result->fetch_object())
				{
                    $objects[] = $rows;
                }
                $this->close($con);
                return $this->jesonEncode($objects);
            }
        } else {
            $this->close($con);
            return 0;
        }
    } 

    function insert($object, $object_array) {
        $count = 0;
        $fields = '';
        $con = $this->open();
        foreach ($object_array as $col => $val) {
            if ($count++ != 0)
                $fields .= ', ';
            $col = mysqli_real_escape_string($con, $col);
            $val = mysqli_real_escape_string($con, $val);
            $fields .= "`$col` = '$val'";
        }
        $query = "INSERT INTO `$object` SET $fields";
        if (mysqli_query($con, $query)) {
            $this->close($con);
            return 1;
        } else {
            return 0;
        }
    }

    function insertbatch($query) { 
        $con = $this->open();
        if (mysqli_query($con, $query)) {
            $this->close($con);
            return 1;
        } else {
            return 0;
        }
    }

    function update($object, $object_array) {
        $con_key_from_arr = array_keys($object_array);
        $key = $con_key_from_arr[0];
        $value = array_shift($object_array);
        $fields = array();
        $con = $this->open();
        foreach ($object_array as $field => $val) {
            $fields[] = "$field = '" . mysqli_real_escape_string($con, $val) . "'";
        }
        $query = "UPDATE `$object` SET " . join(', ', $fields) . " WHERE $key = '$value'";

        if (mysqli_query($con, $query)) {

            $this->close($con);
            return 1;
        } else {
            return 0;
        }
    }

    function FlyQuery($slysql) {
        $db=$this->pdocon();
        $sql=$db->prepare($slysql);
        if ($sql->execute()) {
            // echo 1;
            $datacount=$sql->rowCount();
            if ($datacount == 0) {
                return 0;
            }else {
                return $this->jesonEncode($sql->fetchAll(PDO::FETCH_OBJ));
            }
        }else {
            return 0;
        }
    }

    function insertAndReturnID($object, $object_array) {
        $db = $this->pdocon();
        $fields = '';
        $bindfields = '';
        $ss = 1;
        $count_col = count($object_array);
        foreach ($object_array as $col => $val) {
            if ($ss != $count_col) {
                $fields .= $col;
                $bindfields .= ":" . $col;
                $bindfields .= ', ';
                $fields .= ', ';
            } else {
                $fields .= $col;
                $bindfields .= ":" . $col;
            }
            $ss++;
        }
        $sql = $db->prepare('
          INSERT INTO ' . $object . ' (' . $fields . ')
          VALUES (' . $bindfields . ')
        ');
        foreach ($object_array as $col => $val) {
            $sql->bindValue(':' . $col, $val, PDO::PARAM_STR);
        }
        if ($sql->execute() == 1) {
            return $db->lastInsertId();
        } else {
            return 0;
        }
    }



    public function FlyQry($sql){
       // echo $sql; die();
        //echo $sql;
        $con = $this->open();
       // $query = "SELECT * FROM `$object` ORDER BY id DESC";
        $result = mysqli_query($con, $sql);
        if ($result){
            $count = mysqli_num_rows($result);
            if ($count >= 1) { 
                while ($rows = $result->fetch_object()) {
                    $objects[] = $rows;
                }
                $this->close($con);
                //print_r($objects);
                return $this->jesonEncode($objects);
            }else{

		$objects = [];
		return $this->jesonEncode($objects);
			
	    }
        }
    }

    public function FlyQryNew($sql){
        //echo $sql;
        $con = $this->open();
       // $query = "SELECT * FROM `$object` ORDER BY id DESC";
        $result = mysqli_query($con, $sql);
        if ($result){
            $count = mysqli_num_rows($result);
            if ($count >= 1) { 
                while ($rows = $result->fetch_object()) {
                    $objects[] = $rows;
                }
                $this->close($con);
                //print_r($objects);
                return $objects;
            }else{ 
            return 0;  
        }
        }
    }

}


?>

