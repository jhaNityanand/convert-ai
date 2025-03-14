
<?php

    require_once('config.php');

    function insert($table_name, $data, $conn)
    {
        $query = "INSERT INTO ".$table_name." (".implode(",",array_keys($data)).") VALUES ('".implode("','",$data)."')";
		$return = $conn->query($query);
        if($return) {
            $last_id = $conn->insert_id;
            return ['last_id' => $last_id];
            die;
        } else {
            return ['error' => mysqli_error($conn)];
            die;
        }
        
    }

    function single_row($table_name, $conditions, $conn)
    {
        $query = "select * from ".$table_name." where ";
        foreach($conditions as $key=>$rec) {

          $query .= $key." = ".'"'.$rec.'" and ';
        }
        $last_space_position = strrpos($query, ' and');
        $query = substr($query, 0, $last_space_position);
        $data = $conn->query($query);
        $res = mysqli_fetch_assoc($data);
        if($res && $data) {
            return $res;
            die;
        } else {
            return ['error' => mysqli_error($conn)];
            die;
        }
    }

    function select_all($table_name, $conn)
	{
		$query = "select * from ".$table_name." ORDER BY id DESC";
		$res =  $conn->query($query);
		$data = [];
		foreach($res as $rec){
			$data[] = $rec;
		}
		return $data;
	}

    // use select_all_by_conditions('your table name',array("column_name"=>"value"),connection);
	function select_all_by_conditions($table_name, $conditions, $conn)
	{
		$query = "select * from ".$table_name." where ";
		foreach($conditions as $key=>$rec)
		{
			$query .= $key." = ".'"'.$rec.'" and ';
		}
		$last_space_position = strrpos($query, 'and');
		$query = substr($query, 0, $last_space_position);
		$query = $query." ORDER BY id DESC";
		$res =  $conn->query($query);
		$data = [];
		foreach($res as $rec){
			$data[] = $rec;
		}
		return $data;
	}

	function select_all_by_conditions_ip($table_name, $conditions, $conn)
	{
		$query = "select * from ".$table_name." where ";
		foreach($conditions as $key=>$rec)
		{
			$query .= $key." = ".'"'.$rec.'" and ';
		}
		$last_space_position = strrpos($query, 'and');
		$query = substr($query, 0, $last_space_position);
		$res =  $conn->query($query);
		$data = [];
		foreach($res as $rec){
			$data[] = $rec;
		}
		return $data;
	}
	
	// use select_row_by_like('your table name',array("column_name"=>"%value%"),connection);
	function select_row_by_like($table_name, $conditions, $conn)
	{
		$query = "select * from ".$table_name." where ";
		foreach($conditions as $key=>$rec)
		{
			$query .= $key." LIKE ".'"'.$rec.'" and ';
		}
		$last_space_position = strrpos($query, 'and');
		$query = substr($query, 0, $last_space_position);
		$data =  $conn->query($query);
		$data = mysqli_fetch_assoc($data);		
		return $data;
	}
	
	// use select_all_by_like('your table name',array("column_name"=>"%value%"),connection);
	function select_all_by_like($table_name, $conditions, $conn)
	{
		$query = "select * from ".$table_name." where ";
		foreach($conditions as $key=>$rec)
		{
			$query .= $key." LIKE ".'"'.$rec.'" and ';
		}
		$last_space_position = strrpos($query, 'and');
		$query = substr($query, 0, $last_space_position);
		$res =  $conn->query($query);
		$data = [];
		foreach($res as $rec){
			$data[] = $rec;
		}
		return $data;
	}
	
	// use delete('your table name',array("column_name"=>"%value%"),connection);
	function delete_data($table_name, $conditions, $conn)
	{
		$query = "DELETE FROM ".$table_name." where ";
		foreach($conditions as $key=>$rec)
		{
			$query .= $key." = ".'"'.$rec.'" and ';
		}
		$last_space_position = strrpos($query, 'and');
		$query = substr($query, 0, $last_space_position);
		$res =  $conn->query($query);
		if($res) {
            return $res;
            die;
        } else {
            return ['error' => mysqli_error($conn)];
            die;
        }
	}
	
	// use update_data('your table name',array(data),array("column_name"=>"%value%"),connection);
	function update_data($table_name, $data, $conditions, $conn)
	{
		$query = "UPDATE ".$table_name." SET ";	
		foreach($data as $key=>$rec)
		{
			$query .= "`".$key."`"." = ".'"'.$rec.'",';
		}
		$last_space_position = strrpos($query, ',');
		$query = substr($query, 0, $last_space_position);
		 
		$query .= " where ";
		foreach($conditions as $key=>$rec)
		{
			$query .= $key." = ".'"'.$rec.'" and ';
		}
		$last_space_position = strrpos($query, 'and');
		$query = substr($query, 0, $last_space_position);
		$res =  $conn->query($query);
		if($res) {
            return $res;
            die;
        } else {
            return ['error' => mysqli_error($conn)];
            die;
        }
	}
	
	function single_row_with_column($table_name, $data, $conn)
	{
		$column = "*";
		if(!empty($data['column']))
		{
			$column = implode(",",$data['column']);
		}
		$query = "select ".$column." from ".$table_name." where ";
		
		foreach($data['conditions'] as $key=>$rec)
		{
			$query .= $key." = ".'"'.$rec.'" and ';
		}
		$last_space_position = strrpos($query, 'and');
		$query = substr($query, 0, $last_space_position);
		$data = $conn->query($query);
		$data = mysqli_fetch_assoc($data);
		return $data;
	}
	
	function select_all_by_query($query, $conn)
	{
		$res =  $conn->query($query);
		$data = [];
		foreach($res as $rec){
			$data[] = $rec;
		}
		return $data;
	}

?>
