<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db_config.php";

class User{

	public $db;

	public function __construct(){
		$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

		if(mysqli_connect_errno()) {
			echo "Error: Could not connect to database.";
						exit;
		}
	}

	/*** for registration process ***/
	public function reg_user($name,$username,$password,$email){

		$password = md5($password);
		$sql="SELECT * FROM users WHERE uname='$username' OR uemail='$email'";

		//checking if the username or email is available in db
		$check =  $this->db->query($sql) ;
		$count_row = $check->num_rows;

		//if the username is not in db then insert to the table
		if ($count_row == 0){
			$sql1="INSERT INTO users SET uname='$username', upass='$password', fullname='$name', uemail='$email'";
			$result = mysqli_query($this->db,$sql1) or die(mysqli_connect_errno()."Data cannot inserted");
					return $result;
		}
		else { return false;}
	}

	/*** for login process ***/
	public function check_login($emailusername, $password){

				$password = md5($password);
		$sql2="SELECT uid from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";
		

		//checking if the username is available in the table
				$result = mysqli_query($this->db,$sql2);
				$user_data = mysqli_fetch_array($result);
				$count_row = $result->num_rows;



				if ($count_row == 1) {
						// this login var will use for the session thing
						$_SESSION['login'] = true;
						$_SESSION['uid'] = $user_data['uid'];
						$_SESSION['level'] = $user_data1['level'];
						return true;
				}
				else{
				return false;
		}
		}

		/*** for showing the username or fullname ***/
		public function get_fullname($uid){
			$query = "SELECT fullname FROM users WHERE uid = $uid";

			$result = $this->db->query($query) or die($this->db->error);

			$user_data = $result->fetch_array(MYSQLI_ASSOC);
			return $user_data['fullname'];

		}

		public function get_lvl($uid){
			$query = "SELECT user_levl FROM users WHERE uid = $uid";

			$result = $this->db->query($query) or die($this->db->error);

			$user_data = $result->fetch_array(MYSQLI_ASSOC);
			return $user_data['user_levl'];
			
		}

		/*** starting the session ***/
		public function get_session(){
				return $_SESSION['login'];
		}

		public function user_logout() {
				$_SESSION['login'] = FALSE;
				session_destroy();
		}
		/** for writing posts to the db */
		public function post_data($name, $Title, $Post){ 
        		$qwery = $this->db->prepare("INSERT INTO posts (title, content, uid, postDate, name) VALUES (?,?,?,?, ?)");
        		$todays_date = date('d-m-Y (H:i:s)');
				$qwery->bind_param('ssiss', $Title, $Post, $_SESSION['uid'], $todays_date, $name );
				if ($qwery->execute()){
					echo "Your post has been added successfully.";
				} else {
                	echo($qwery->error());
                }
        	$qwery->close();
        	return true;
			}
			/** for displaying all posts*/
		public function all_posts(){
			$sql2 = "SELECT * FROM posts ORDER BY Post_id DESC";
			$query = mysqli_query($this->db,$sql2);
			$rows = array();
			while($row = mysqli_fetch_assoc($query)) {
				$rows[] = $row;
			}

			return json_encode($rows);
			
	
			}
		}

