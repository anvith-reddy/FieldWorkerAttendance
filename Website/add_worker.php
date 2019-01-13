<?php
include('config.php');

date_default_timezone_set('Asia/Kolkata');
$fullname = $_POST["name"];
$username = $_POST["username"];
$mobile = $_POST["mobile"];
$latitude = $_POST["latitude"];
$password = $_POST["password"];
$longitude = $_POST["longitude"];

$mdate = date("Y-m-d H:i:s");
$file_count = count(array_filter($_FILES['userfile1']['name']));
if ($file_count == 0) $attachment = "0";
	else $attachment = "1";
	
	
$checkuser = "select * from users where username='$username'";
$checkuser = mysqli_num_rows(mysqli_query($db,$checkuser));
	
if ($fullname == ""){ echo '<b style="color:red;">Enter Fullname</b>'; }
else if($username == "") { echo '<b style="color:red;">Enter username</b>'; }
else if($checkuser > 0) { echo '<b style="color:red;">Choose other username</b>'; }
else if($mobile == "") { echo '<b style="color:red;">Enter Mobile number</b>'; }
else if($password == "") { echo '<b style="color:red;">Enter Password</b>'; }
else if($attachment == 0) { echo '<b style="color:red;">Select Profile Picture</b>'; }
else
{
	$query = "INSERT INTO `users`(`name`, `lastlogin`, `username`, `password`, `latitude`, `longitude`) 
	VALUES ('$fullname','$mdate','$username','$password','$latitude','$longitude')";
		if ($db->query($query) === TRUE)
		{
			$inserted = $db->insert_id;
			if ($attachment == "1")
			{
				for($i=0;$i<$file_count;$i++)
				{
					$filename = $_FILES['userfile1']['name'][$i];
					$tmpname = $_FILES['userfile1']['tmp_name'][$i];
					$file_size = $_FILES['userfile1']['size'][$i];
					$file_type = $_FILES['userfile1']['type'][$i];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
				
					$fp      = fopen($tmpname, 'r');
					$content = fread($fp, filesize($tmpname));
					$content = addslashes($content);
					fclose($fp);
				
					$final = "UPDATE `users` SET `profile`='$content' WHERE id='$inserted'";
					if(mysqli_query($db,$final)) { echo '<b style="color:green;">Worker Registration Successful</b>'; }
					else 
					{
						$delete = "delete from users where id = '$inserted'";
						if (mysqli_query($db,$delete)) { echo '<b style="color:red;"> File Upload failed.Please check your files and try again</b>'; }
						else { echo '<b style="color:red;"> Some unknown error occured.Try again</b>'; }
					}
				}
			}
		}
		else { echo '<b style="color:red;">Please check your form inputs and try again</b>'; }
}
?>