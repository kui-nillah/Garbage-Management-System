<?php 

   // require '../Databases/Database.php';
     
    class Librarie{

	

		public static function getTodayDate(){
			$sql = "SELECT DATE_FORMAT(NOW(),'%Y-%m-%d %h:%i %s %p') as 'Date' ";
			$query = Database::query($sql);
			if ($row = Database::mysqli_fetch_array($query)) {
				return $row['Date'];
			}
	   }

	  public static function getTmoroDate($date = "" , $num = ""){
		$sql = " SELECT DATE_ADD('$date', INTERVAL '$num' DAY) as tmrdate ";
		$query = Database::query($sql);
		if ($row = Database::mysqli_fetch_array($query)) {
			return $row['tmrdate'];
		}
      }


	  public static function getRequiredDateMonth(){
		$sql = " SELECT DATE_ADD(NOW(), INTERVAL 30 DAY) as month_to_add ";
		$query = Database::query($sql);
		if ($row = Database::mysqli_fetch_array($query)) {
			return $row['month_to_add'];
		}
            }

		public static function getcheckPhonenumaberIfExist($phone_no){
			$txt = mysqli_real_escape_string(Database::getDatabaseConnect(),$phone_no);
			$sql = "SELECT phone_no FROM user_info WHERE phone_no = '$txt'";
			$query = Database::query($sql);
			 if ($row = Database::mysqli_fetch_array($query)) {
				 return true;
			 } else {
				 return false;
			 }
		 }

		 public static function getcheckEmailIfExist($email){
					 $txt = mysqli_real_escape_string(Database::getDatabaseConnect(),$email);
					 $sql = "SELECT email FROM user_info WHERE email = '$txt'";
					 $query = Database::query($sql);
					  if ($row = Database::mysqli_fetch_array($query)) {
						  return true;
					  } else {
						  return false;
					  }
				  }

				  public static function getUserIDByUsername($username = '' ){
					$sql = "SELECT user_id  FROM user_info  WHERE username  ='$username' ";
					$query = Database::query($sql);
					if($row = Database::mysqli_fetch_array($query)){
							return $row['user_id'];
					  }
				   }
				   public static function getcheckUsernameIfExist($username){
					$txt = mysqli_real_escape_string(Database::getDatabaseConnect(),$username);
					$sql = "SELECT username FROM user_info WHERE username = '$username' AND status = 'active' ";
					$query = Database::query($sql);
					 if ($row = Database::mysqli_fetch_array($query)) {
						 return true;
					 } else {
						 return false;
					 }
				 }
		public static function setUsersRegistration( $user_type = "" , $fname = "" , $lname = "" , $password = "" , $email = "" , $phone_no = "" , $username ="") {
				$fname_ = mysqli_real_escape_string(Database::getDatabaseConnect(), $fname);
				$lname_ = mysqli_real_escape_string(Database::getDatabaseConnect(), $lname);
				$email_ = mysqli_real_escape_string(Database::getDatabaseConnect(), $email);
				$phone_no_ = mysqli_real_escape_string(Database::getDatabaseConnect(), $phone_no);
				$username_ = mysqli_real_escape_string(Database::getDatabaseConnect(), $username);
				$date = self::getTodayDate();
			
				$sql = "INSERT INTO user_info VALUES ('' , '$fname_' , '$lname_' , '$email_' , '$phone_no_' , '$username_' , '$password' , '$date' , 'active' , '$user_type')";
			
				if (Database::query($sql)) {
					return true;
				} else {
					return false;
				}
			}



		public static function fileUsersComplain($region = "" , $municipal = "" , $street = "" , $house_no = "" , $image = "" , $userID = ""){
			$region_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$region);
			$municipal_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$municipal);
			$street_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$street);
			$house_no_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$house_no);
			$image_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$image);
			$date = self::getTodayDate();

			$complain = "INSERT INTO lodgedcomplain VALUES ('', '$userID' ,  '$region_', '$municipal_', '$street_', '$house_no_', '$image_','Active', '$date')";
			if (Database::query($complain)) {
                return true;
            } else {
                return false;
            }
		}


		public static function setUpDateUserComplainStatus($complain_id = ""){
			$sql = "UPDATE lodgedcomplain SET status = 'InProgress'  WHERE complain_id = '$complain_id'";
			if (Database::query($sql)) {
                return true;
            } else {
                return false;
            }
		}


		public static function setUpdateDriverComplainStatus($complain_id = ""){
			$sql = "UPDATE lodgedcomplain SET status = 'Complete'  WHERE complain_id = '$complain_id'   ";
			if (Database::query($sql)) {
                return true;
            } else {
                return false;
            }
		}

		public static function setDeleteUserInfo($id = ""){
			$id_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$id);
			$sql = "UPDATE user_info SET status = 'Delete'  WHERE user_id = '$id_'   ";
			if (Database::query($sql)) {
                return true;
            } else {
                return false;
            }
		}


		public static function setUpDateUserInfo($user_id = "" , $fname ="", $lname="" , $phone_no = '' , $email =''){
			$user_id_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$user_id);
			$fname_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$fname);
			$lname_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$lname);
			$phone_no_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$phone_no);
			$email_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$email);

			$sql = "UPDATE user_info SET fname = '$fname_' , lname = '$lname_' , email = '$email_' , phone_no = '$phone_no_'   WHERE user_id = '$user_id_'   ";
			if (Database::query($sql)) {
                return true;
            } else {
                return false;
            }
		}

		public static function setUpDateComplainInfo($complain_id = "" , $region = "" , $municipal = "" , $street = "" , $house_no = "" , $userID = ""){
			$complain_id_ = mysqli_real_escape_string(Database::getDatabaseConnect(), $complain_id);
			$region_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$region);
			$municipal_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$municipal);
			$street_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$street);
			$house_no_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$house_no);

			$complain = "UPDATE lodgedcomplain SET region = '$region_' , municipal = '$municipal_' , street = '$street_' , house_no = '$house_no_'   WHERE complain_id = '$complain_id_'   ";
			if (Database::query($complain)) {
                return true;
            } else {
                return false;
            }
		}

		public static function setDeleteComplainInfo($id = ""){
			$id_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$id);
			$sql = "UPDATE lodgedcomplain SET status = 'Delete'  WHERE complain_id = '$id_'   ";
			if (Database::query($sql)) {
                return true;
            } else {
                return false;
            }
		}


		public static function setUpdateDriverComplainStatus2($complain_id = ""){
			$sql = "UPDATE driver_info SET status = 'Complete'  WHERE complain_id = '$complain_id'   ";
			if (Database::query($sql)) {
                return true;
            } else {
                return false;
            }
		}

		public static function setDriverAssign($driverID = "" , $complain_id = "" ){
			$driverID_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$driverID);
			$complain_id_ = mysqli_real_escape_string(Database::getDatabaseConnect(),$complain_id);
		
			$date = self::getTodayDate();

			$complain = "INSERT INTO driver_info VALUES ('', '$complain_id_' ,  '$driverID_', 'Pass', '$date')";
			if (Database::query($complain)) {
                return true;
            } else {
                return false;
            }
		}
		

		public static function getUserPhoneNumber($id = '' ){
			$sql = "SELECT phone_no  FROM user_info  WHERE user_id ='$id' ";
			$query = Database::query($sql);
			if($row = Database::mysqli_fetch_array($query)){
					return $row['phone_no'];
			  }
	   }
	   

	  public static function getUserEmailAddress($id = '' ){
		$sql = "SELECT email  FROM user_info  WHERE user_id ='$id' ";
		$query = Database::query($sql);
		if($row = Database::mysqli_fetch_array($query)){
				return $row['email'];
		  }
      }

	  
	  public static function getDriverList( $userType = ""){
		$sql = "SELECT user_id ,  fname , lname   FROM user_info  WHERE user_type  ='$userType'  AND status = 'active' ";
		$query = Database::query($sql);
		while($row = Database::mysqli_fetch_array($query)){

			  echo '<option value="'.$row['user_id'].'">'.$row['fname'].' ' .$row['lname']. '</option>';
		  }
      }

	  public static function getUserComplainHistory($userID = '') {
		$sql = "SELECT lodgedcomplain.complain_id as complain_id , lodgedcomplain.region as region  , lodgedcomplain.municipal  as municipal , lodgedcomplain.street as street  
		, lodgedcomplain.house_no as house_no , lodgedcomplain.image as image ,lodgedcomplain.date as date , user_info.fname as fname ,  user_info.lname as lname
		    FROM lodgedcomplain   INNER JOIN user_info   ON lodgedcomplain.user_id  = user_info.user_id  WHERE user_info.user_id = '$userID' AND lodgedcomplain.status = 'Active'";
        $query = Database::query($sql);
    $i = 2022100;
    $html = '<table>
	<thead>
                <tr>
                    <th>Complain ID</th>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Municipal</th>
                    <th>Street</th>
                    <th>House Number</th>
					<th>Image</th>
					<th>Date</th>
					<th colspan="2">Action</th>
                </tr>
	</thead>
	<tbody>';

	 while($row = Database::mysqli_fetch_array($query)){
        $html .= '
		<tr>
                    <td>' . $i . '</td>
                    <td>' . $row['fname'].' '.$row['lname']. '</td>
                    <td>' . $row['region'] . '</td>
                    <td>' . $row['municipal'] . '</td>
                    <td>' . $row['street'] . '</td>
                    <td>' . $row['house_no'] . '</td>
					<td> <img src="'.$row['image'].'" width="100px" height="100px"  > </td>
					<td>' . $row['date'] . '</td>
                    <td><a href="update.php?id=' . $row['complain_id'] .'"> <button class="btn1">Update</button></a></td>
					<td><a href="delete.php?id=' . $row['complain_id'] .'"> <button class="btn2">Delete</button></a></td>
                </tr>
				';

        $i++;
    }

    $html .= '</tbody></table>';
    return $html;
}

public static function getReport($startDate, $endDate){
	$sql = "SELECT lodgedcomplain.complain_id as complain_id , lodgedcomplain.region as region  , lodgedcomplain.municipal  as municipal , lodgedcomplain.street as street  
		, lodgedcomplain.house_no as house_no , lodgedcomplain.image as image ,lodgedcomplain.date as date ,lodgedcomplain.status as status , user_info.fname as fname ,  user_info.lname as lname
		    FROM lodgedcomplain   INNER JOIN user_info   ON lodgedcomplain.user_id  = user_info.user_id  WHERE lodgedcomplain.date BETWEEN '$startDate' and '$endDate'";
    $query = Database::query($sql);
    $i = 2022100;
    $html = '<table>
	<thead>
                <tr>
                    <th>Complain ID</th>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Municipal</th>
                    <th>Street</th>
                    <th>House Number</th>
					<th>Image</th>
					<th>Date</th>
					<th>Status</th>
                </tr>
	</thead>
	<tbody>';

	 while($row = Database::mysqli_fetch_array($query)){
        $html .= '
		<tr>
                    <td>' . $i . '</td>
                    <td>' . $row['fname'].' '.$row['lname']. '</td>
                    <td>' . $row['region'] . '</td>
                    <td>' . $row['municipal'] . '</td>
                    <td>' . $row['street'] . '</td>
                    <td>' . $row['house_no'] . '</td>
					<td> <img src="'.$row['image'].'" width="100px" height="100px" > </td>
					<td><p class="status delivered">'. $row['status'] .'</p></td>
                </tr>
				';

        $i++;
    }

    $html .= '</tbody></table>';
    return $html;
}

public static function getSearchList($userID = '') {
	$sql = "SELECT lodgedcomplain.complain_id as complain_id , lodgedcomplain.region as region  , lodgedcomplain.municipal  as municipal , lodgedcomplain.street as street  
	, lodgedcomplain.house_no as house_no , lodgedcomplain.image as image ,lodgedcomplain.date as date ,lodgedcomplain.status as status , user_info.fname as fname ,  user_info.lname as lname
		FROM lodgedcomplain   INNER JOIN user_info   ON lodgedcomplain.user_id  = user_info.user_id";
	$query = Database::query($sql);
$i = 2022100;
$html = '<table class="customers-list">
<thead>
			<tr>
				<th>Complain ID</th>
				<th>Name</th>
				<th>Region</th>
				<th>Municipal</th>
				<th>Street</th>
				<th>House Number</th>
				<th>Image</th>
				<th>Date</th>
				<th>Status</th>
			</tr>
</thead>
<tbody>';

 while($row = Database::mysqli_fetch_array($query)){
	$html .= '
	<tr>
				<td>' . $i . '</td>
				<td>' . $row['fname'].' '.$row['lname']. '</td>
				<td>' . $row['region'] . '</td>
				<td>' . $row['municipal'] . '</td>
				<td>' . $row['street'] . '</td>
				<td>' . $row['house_no'] . '</td>
				<td> <img src="'.$row['image'].'" width="100px" height="100px" > </td>
				<td>' . $row['date'] . '</td>
				<td><p class="status delivered" name="Active">'. $row['status'] .'</p></td>
			</tr>';

	$i++;
}

$html .= '</tbody></table>';
return $html;
}


public static function getAdminInfo($user_type = ''){
	$sql = "SELECT user_id,  fname , lname , email , phone_no , username FROM  user_info WHERE user_type = '$user_type' AND status = 'Active'";
	$query = Database::query($sql);
	$i = 1022100;
	$html = '<table>
	<thead>
		<tr>
			<th> Admin_ID <span class="icon-arrow">&UpArrow;</span></th>
			<th> Name <span class="icon-arrow">&UpArrow;</span></th>
			<th> Email <span class="icon-arrow">&UpArrow;</span></th>
			<th> Phone Number Date <span class="icon-arrow">&UpArrow;</span></th>
			<th> Username <span class="icon-arrow">&UpArrow;</span></th>
			<th colspan="2"> Action <span class="icon-arrow">&UpArrow;</span></th>
		</tr>
	</thead>
	<tbody>';

while($row = Database::mysqli_fetch_array($query)){
$html .= '
<tr>
		<td>' . $i . '</td>
		<td>' . $row['fname'].' '.$row['lname']. '</td>
		<td>' . $row['email'] . '</td>
		<td>' . $row['phone_no'] . '</td>
		<td>' . $row['username'] . '</td>
		<td><a href="updateAdmin.php?id=' . $row['user_id'] .'"> <button class="btn1">Update</button></a></td>
		<td><a href="deleteAdmin.php?id=' . $row['user_id'] .'"> <button class="btn2">Delete</button></a></td>


</tr>
       ';

$i++;
}

$html .= '</tbody></table>';
return $html;

    	
	  
}

public static function getDriverInfo($user_type = ''){
	$sql = "SELECT user_id,  fname , lname , email , phone_no , username FROM  user_info WHERE user_type = '$user_type' AND status = 'Active'";
	$query = Database::query($sql);
	$i = 3022100;
	$html = '<table>
	<thead>
		<tr>
			<th> Driver_ID <span class="icon-arrow">&UpArrow;</span></th>
			<th> Name <span class="icon-arrow">&UpArrow;</span></th>
			<th> Email <span class="icon-arrow">&UpArrow;</span></th>
			<th> Phone Number Date <span class="icon-arrow">&UpArrow;</span></th>
			<th> Username <span class="icon-arrow">&UpArrow;</span></th>
			<th colspan="2"> Action <span class="icon-arrow">&UpArrow;</span></th>
		</tr>
	</thead>
	<tbody>';

while($row = Database::mysqli_fetch_array($query)){
$html .= '
<tr>
		<td>' . $i . '</td>
		<td>' . $row['fname'].' '.$row['lname']. '</td>
		<td>' . $row['email'] . '</td>
		<td>' . $row['phone_no'] . '</td>
		<td>' . $row['username'] . '</td>
		<td><a href="updateDriver.php?id=' . $row['user_id'] .'"> <button class="btn1">Update</button></a></td>
		<td><a href="deleteDriver.php?id=' . $row['user_id'] .'"> <button class="btn2">Delete</button></a></td>


</tr>';

$i++;
}

$html .= '</tbody></table>';
return $html;

    	
	  
}

public static function getUserInfo($user_type = ''){
	$sql = "SELECT user_id,  fname , lname , email , phone_no , username , status FROM  user_info WHERE user_type = '$user_type' AND status = 'Active'";
	$query = Database::query($sql);
	$i = 4022100;
	$html = '<table>
	<thead>
		<tr>
			<th> User_ID <span class="icon-arrow">&UpArrow;</span></th>
			<th> Name <span class="icon-arrow">&UpArrow;</span></th>
			<th> Email <span class="icon-arrow">&UpArrow;</span></th>
			<th> Phone Number Date <span class="icon-arrow">&UpArrow;</span></th>
			<th> Username <span class="icon-arrow">&UpArrow;</span></th>
			<th> Status <span class="icon-arrow">&UpArrow;</span></th>
			<th> Action <span class="icon-arrow">&UpArrow;</span></th>
		</tr>
	</thead>
	<tbody>';

while($row = Database::mysqli_fetch_array($query)){
$html .= '<tr>
		<td>' . $i . '</td>
		<td>' . $row['fname'].' '.$row['lname']. '</td>
		<td>' . $row['email'] . '</td>
		<td>' . $row['phone_no'] . '</td>
		<td>' . $row['username'] . '</td>
		<td><p class="status">'. $row['status'] .'</p></td>
		<td><a href="deleteUser.php?id=' . $row['user_id'] .'"> <button class="btn2">Delete</button></a></td>


</tr> ';

$i++;
}

$html .= '</tbody></table>';
return $html;

    	  
}

public static function getUserComplain($userID = '') {
	$sql = "SELECT lodgedcomplain.complain_id as complain_id , lodgedcomplain.region as region  , lodgedcomplain.municipal  as municipal , lodgedcomplain.street as street  
	, lodgedcomplain.house_no as house_no , lodgedcomplain.image as image ,lodgedcomplain.date as date , user_info.fname as fname ,  user_info.lname as lname
		FROM lodgedcomplain   INNER JOIN user_info   ON lodgedcomplain.user_id  = user_info.user_id  WHERE   lodgedcomplain.status = 'Active'";
	$query = Database::query($sql);
$i = 2022100;
$html = '<table>
<thead>
	<tr>
		<th> Complain_ID <span class="icon-arrow">&UpArrow;</span></th>
		<th> Name <span class="icon-arrow">&UpArrow;</span></th>
		<th> Region <span class="icon-arrow">&UpArrow;</span></th>
		<th> Municipal <span class="icon-arrow">&UpArrow;</span></th>
		<th> Street <span class="icon-arrow">&UpArrow;</span></th>
		<th> House Number <span class="icon-arrow">&UpArrow;</span></th>
		<th> Image <span class="icon-arrow">&UpArrow;</span></th>
		<th> Date <span class="icon-arrow">&UpArrow;</span></th>
		<th> View <span class="icon-arrow">&UpArrow;</span></th>
	</tr>
</thead>
<tbody>';

 while($row = Database::mysqli_fetch_array($query)){
	$html .= '
	<tr>
				<td>' . $i . '</td>
				<td>' . $row['fname'].' '.$row['lname']. '</td>
				<td>' . $row['region'] . '</td>
				<td>' . $row['municipal'] . '</td>
				<td>' . $row['street'] . '</td>
				<td>' . $row['house_no'] . '</td>
				<td> <img src="'.$row['image'].'" width="100px" height="100px" > </td>
				<td>' . $row['date'] . '</td>
				<td><a href="assign.php?id=' . $row['complain_id'] .'"> <button class="btn3">Assign</button></a></td>
	</tr>';

	$i++;
}

$html .= '</tbody></table>';
return $html;
}



public static function getComplainDriver_2($userID = '') {
	$sql = "SELECT complain_id FROM  driver_info  WHERE driverID = '$userID' AND status = 'Pass' ";
	$query = Database::query($sql);
	while($row = Database::mysqli_fetch_array($query)){
		$complain_id = $row['complain_id'];
		$sql_2 = "SELECT lodgedcomplain.complain_id as complain_id , lodgedcomplain.region as region  , lodgedcomplain.municipal  as municipal , lodgedcomplain.street as street  
		, lodgedcomplain.house_no as house_no , lodgedcomplain.image as images ,lodgedcomplain.date as date , user_info.fname as fname ,  user_info.lname as lname
			FROM lodgedcomplain   INNER JOIN user_info   ON lodgedcomplain.user_id  = user_info.user_id  WHERE lodgedcomplain.complain_id = '$complain_id' AND   lodgedcomplain.status = 'InProgress'";
		$query_2 = Database::query($sql_2);
		$i = 2022100;
		$html = '<table>
<thead>
	<tr>
		<th> Complain_ID <span class="icon-arrow">&UpArrow;</span></th>
		<th> Name <span class="icon-arrow">&UpArrow;</span></th>
		<th> Region <span class="icon-arrow">&UpArrow;</span></th>
		<th> Municipal <span class="icon-arrow">&UpArrow;</span></th>
		<th> Street <span class="icon-arrow">&UpArrow;</span></th>
		<th> House Number <span class="icon-arrow">&UpArrow;</span></th>
		<th> Image <span class="icon-arrow">&UpArrow;</span></th>
		<th> Date <span class="icon-arrow">&UpArrow;</span></th>
		<th> Action <span class="icon-arrow">&UpArrow;</span></th>
	</tr>
</thead>
<tbody>';
while($row_2 = Database::mysqli_fetch_array($query_2)){
	$html .= '
	<tr>
				<td>' . $i . '</td>
				<td>' . $row_2['fname'].' '.$row_2['lname']. '</td>
				<td>' . $row_2['region'] . '</td>
				<td>' . $row_2['municipal'] . '</td>
				<td>' . $row_2['street'] . '</td>
				<td>' . $row_2['house_no'] . '</td>
				<td> <img src="'.$row_2['images'].'" width="100px" height="100px" > </td>
				<td>' . $row_2['date'] . '</td>
				<td><a href="assigndriver.php?id=' . $row_2['complain_id'] .'"> <button class="btn3">Done</button></a></td>
	</tr>
';

	$i++;
}
$html .= '</tbody></table>';
		return $html;
}

}

public static function getDriverResponse($userID = '') {
	$sql = "SELECT lodgedcomplain.complain_id as complain_id , lodgedcomplain.region as region  , lodgedcomplain.municipal  as municipal , lodgedcomplain.street as street  
	, lodgedcomplain.house_no as house_no , lodgedcomplain.image as image ,lodgedcomplain.date as date , user_info.fname as fname ,  user_info.lname as lname
		FROM lodgedcomplain   INNER JOIN user_info   ON lodgedcomplain.user_id  = user_info.user_id  WHERE   lodgedcomplain.status = 'Complete'";
	$query = Database::query($sql);
$i = 2022100;
$html = '<table>
<thead>
	<tr>
		<th> Complain_ID <span class="icon-arrow">&UpArrow;</span></th>
		<th> Name <span class="icon-arrow">&UpArrow;</span></th>
		<th> Region <span class="icon-arrow">&UpArrow;</span></th>
		<th> Municipal <span class="icon-arrow">&UpArrow;</span></th>
		<th> Street <span class="icon-arrow">&UpArrow;</span></th>
		<th> House Number <span class="icon-arrow">&UpArrow;</span></th>
		<th> Image <span class="icon-arrow">&UpArrow;</span></th>
		<th> Date <span class="icon-arrow">&UpArrow;</span></th>
		<th> Response <span class="icon-arrow">&UpArrow;</span></th>
	</tr>
</thead>
<tbody>';

 while($row = Database::mysqli_fetch_array($query)){
	$html .= '
	<tr>
				<td>' . $i . '</td>
				<td>' . $row['fname'].' '.$row['lname']. '</td>
				<td>' . $row['region'] . '</td>
				<td>' . $row['municipal'] . '</td>
				<td>' . $row['street'] . '</td>
				<td>' . $row['house_no'] . '</td>
				<td> <img src="'.$row['image'].'" width="100px" height="100px" > </td>
				<td>' . $row['date'] . '</td>
				<td><p class="status delivered">Completed</p></td>
	</tr>
';

	$i++;
}

$html .= '</tbody></table>';
return $html;

}




public static function getStatusUsersTotal($status = ""){
	$sql = "SELECT count(*) FROM `user_info` WHERE `status`= 'active'  AND  user_type = '002'";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }

  public static function getStatusDriverTotal($status = ""){
	$sql = "SELECT count(*) FROM `user_info` WHERE `status`= 'active'  AND  user_type = '003'";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }

  public static function getStatusComplainTotal($userID = ""){
	$sql = "SELECT count(*) FROM `lodgedcomplain` WHERE user_id = '$userID' AND `status`= 'Active'";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }

  public static function getTotalComplain($UserID=""){
	$sql = "SELECT count(*) FROM `lodgedcomplain` WHERE user_id = '$UserID' ";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }

  public static function getTotalComplain2($UserID=""){
	$sql = "SELECT count(*) FROM `driver_info` WHERE driverID = '$UserID' ";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }

  public static function getStatusAssignedComplainTotal($UserID = ""){
	$sql = "SELECT count(*) FROM `lodgedcomplain` WHERE user_id = '$UserID' And  `status`= 'InProgress'";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }


  public static function getStatusAssignedComplainTotal2($UserID = ""){
	$sql = "SELECT count(*) FROM `driver_info` WHERE driverID = '$UserID' And  `status`= 'Pass'";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }

  public static function getStatusCompleteComplainTotal($UserID = ""){
	$sql = "SELECT count(*) FROM `lodgedcomplain` WHERE user_id = '$UserID' AND  `status`= 'Complete'";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }

  public static function getStatusCompleteComplainTotal2($UserID = ""){
	$sql = "SELECT count(*) FROM `driver_info` WHERE driverID = '$UserID' AND  `status`= 'Complete'";
	$query = Database::query($sql);
	$row = Database::mysqli_fetch_array($query);
	return array_shift($row);
  }
 


  }

   
?>