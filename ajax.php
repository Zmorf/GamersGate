<?php


	$cmd = $_GET['cmd'];
	$connection = mysql_connect('localhost', 'test', 'test');
	if(!$connection)
	{
		$data = array(('message' => 'connection failed');
		$json = json_encode($data);
		echo $json;
		exit(0);
	}
	mysql_select_db('test');
	
	if($cmd == 'list_computers')
	{
		$query = "SELECT * FROM computer";
		
		$result = mysql_query($query);
		$data = array();
		$counter = 0;
		while($row = mysql_fetch_assoc($result))
		{
			$arr = array('id' => $row['id']);
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
		$md5password = md5($password);
		
		$query = "INSERT INTO employee(username, password) VALUES('$username', '$md5password')";
		mysql_query($query);
		
		$data = array('message' => 'employee added', 'error' => 0);
		echo json_encode($data);
		//echo $json;
		
	}
	
	mysql_close($connection);


?>