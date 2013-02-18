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
    else if($cmd == 'computer_info')
    {
        $id = $_GET['id'];

        #aquire current user
        $query = "SELECT * FROM (SELECT * FROM computerlog WHERE computer='$id' ORDER BY id DESC LIMIT 0,1) AS computerlog INNER JOIN user ON user.id = computerlog.user";

        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);

        if($row['endtime'] == NULL)
            $currentUser = NULL;
        else
        {
            $currentUser = $row['username'];
        }


        $data = array('id' => $id, 'currentUser' => $currentUser);
        $json = json_encode($data);
        echo $json;
    }
    else if($cmd == 'loadSchedule')
    {
        $id = $_GET['id'];
        #generate table for schedule
        #$query = "SELECT * FROM computerlog INNER JOIN booking ON computerlog.computer == booking.computer";
        #$query = "SELECT * FROM computerlog WHERE computer='$id'";
        $query = "SELECT * FROM computerlog INNER JOIN user ON computerlog.user = user.id";
        $result = mysql_query($query);

        echo "<h2>Old entrys</h2>";
        echo "<table border=\"1\">";
        echo "<tr><td>Starttime</td><td>Endtime</td><td>Username</td></tr>";
        while($row = mysql_fetch_assoc($result))
        {
            #print old 
            echo "<tr>";
            echo "<td>";
            echo $row['starttime'];
            echo "</td>";
            
            echo "<td>";
            echo $row['endtime'];
            echo "</td>";

            echo "<td>";
            echo $row['username'];
            echo "</td>";


            echo "</tr>";
        }
        echo "</table>";


        $query = "SELECT * FROM (SELECT * FROM booking WHERE computer='$id') AS booking INNER JOIN user ON user.id = booking.user";
        $result = mysql_query($query);


        echo "<h2>New entrys</h2>";
  
        echo "<table border=\"1\">";
        echo "<tr><td>Starttime</td><td>Hours</td><td>Username</td></tr>";
        while($row = mysql_fetch_assoc($result))
        {
            #print new  
            echo "<tr>";
            echo "<td>";
            echo $row['starttime'];
            echo "</td>";
            
            echo "<td>";
            echo $row['time'];
            echo "</td>";

            echo "<td>";
            echo $row['username'];
            echo "</td>";


            echo "</tr>";

        }
        echo "</table>";
    }
    else if($cmd == 'new_user')
    {
        $username = $_GET['username'];
        $password = $_GET['password'];
        $md5password = md5($password);
        #all users start with 1 hour playtime

    	#check username
	    $query = "SELECT * FROM user WHERE username='$username'";
    	$result = mysql_query($query);
    	$row = mysql_fetch_assoc($result);
    	if(isset($row['password']))
    	{
		
            $data = array('error' => '1', 'message' => 'Username exists');
           	$json = json_encode($data);
            echo $json;
            mysql_close($connection);
            exit(0);
	    }

        $query = "INSERT INTO user(username, password, playTime) VALUES('$username', '$md5password', 1)";
        mysql_query($query);

        $data = array('error' => '0', 'message' => 'User added');
        $json = json_encode($data);
        echo $json;
    }
    else if($cmd == 'listUsers')
    {
        $query = "SELECT * FROM user";
        $result = mysql_query($query);

        $data = array();
        $counter = 0;
        while($row = mysql_fetch_assoc($result))
        {
            $data[$counter] = array('username' => $row['username']); 
            $counter = $counter + 1;
        }
        $json = json_encode($data);
        echo $json;
    }
    else if($cmd == 'add_booking')
    {
        $username = $_GET['username'];
        $id = $_GET['computer'];
        $hours = $_GET['time'];
        $starttime = $_GET['starttime'];

        $query = "SELECT id FROM user WHERE username='$username'";
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        $user_id = $row['id'];

        $query = "INSERT INTO booking(computer, user, time, starttime) VALUES('$id', '$user_id', '$hours', '$starttime')";

        mysql_query($query);

        $data = array('error' => '0', 'message' => 'Booking successful');
        $json = json_encode($data);
        echo $json;
    }
    else
    {
        echo "No command";
    }    
	mysql_close($connection);


?>
