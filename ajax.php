<?php
	$cmd = $_GET['cmd'];
    $connection = mysql_connect('localhost', 'gamersgate', 'gamersgate');
	if(!$connection)
	{
		$data = array('message' => 'connection failed');
		$json = json_encode($data);
		echo $json;
		exit(0);
	}
    mysql_select_db('gamersgate');
	
	if($cmd == 'list_computers')
	{
		$query = "SELECT * FROM computer";
		
		$result = mysql_query($query);
		$data = array();
		$counter = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$arr = array('id' => $row['id'], 'x' => $row['x'], 'y' => $row['y'], 'name' => $row['name']);
			$data[$counter] = $arr;
			$counter = $counter + 1;
		}
		$json = json_encode($data);
		echo $json;
	}
	else if($cmd == 'add_computer')
	{
		$name = $_GET['name'];
		$query = "INSERT INTO computer(name) VALUES('$name')";
		mysql_query($query);
		
		$data = array('status' => 'ok');
		$json = json_encode($data);
		echo $json;
	}
	else if($cmd == 'employee_login')
	{
		$username = $_GET['username'];
		$password = $_GET['password'];
		
		$query = "SELECT * FROM employee WHERE username='$username'";
		
		$md5password = md5($password);
		$result = mysql_query($query);
		
		$row = mysql_fetch_assoc($result);
		
		if($row['password'] == $md5password)
		{
			$data = array('message' => 'login success', 'error' => '0');
			$json = json_encode($data);
			echo $json;
		}
		else
		{
			$data = array('message' => 'wrong password', 'error' => '1');
			$json = json_encode($data);
			echo $json;
		}
	}
	else if($cmd == 'new_employee')
	{
		$username = $_GET['username'];
        $password = $_GET['password'];
        $name = $_GET['name'];
		$md5password = md5($password);
		
		$query = "INSERT INTO employee(username, password, name) VALUES('$username', '$md5password', '$name')";
		mysql_query($query);
		
		$data = array('message' => 'employee added', 'error' => 0);
		echo json_encode($data);
		//echo $json;
		
	}
    else
    {
        echo "No command";
    }    
	mysql_close($connection);


?>
