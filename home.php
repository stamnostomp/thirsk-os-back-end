<?php

session_start();
  include_once 'include/class.user.php';
    $user = new User();

    $uid = $_SESSION['uid'];

    if (!$user->get_session()){
       header("location:login.php");
    }

    if (isset($_GET['q'])){
        $user->user_logout();
        header("location:login.php");
    }
	
?>
<!DOCTYPE HTML>
<html>
<head>

<style>
.error {color: #FF0000;}
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.inline-div {
    display:inline-block;
}
.inline-txtarea {
    resize: none;
    border : 2px solid red;
    height:125px;
}
div.r {
  position: absolute;
  left: 300px;
  width: 200px;
  height: 120px;
  margin-top: 210px;
}
div.rs {
  position: absolute;
  left: 1000px;
  margin-top: 590px;

}
.header img {
  float: right;
  width: 448px;
  height: 187px;
  padding-right: 790px;
}

</style>
</head>
<body>

<?php


          // define variables and set to empty values
        $TitleErr = "";
        $Post = $Title = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {




          if (empty($_POST["Title"])) {
            $Title = "";
          } else {
            $Title = test_input($_POST["Title"]);


            }
          }

          if (empty($_POST["Post"])) {
            $Post = "";
          } else {
            $Post = test_input($_POST["Post"]);
          }






        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;


        }
 if(array_key_exists('submit',$_POST)){
    $todays_date = date('d-m-Y (H:i:s)');  
 $name = $user->get_fullname($uid);
 	$result = $user->post_data($name, $Title,  $Post);
 	if ($result){
    	$Title = $Post = "";
    }
    }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

?>


<div class="sidenav">
  <a href="home.php">Post</a>
  <a href="edit.php">Manage posts</a>
  <a href="home.php?q=logout">Logout</a>

</div>
<div class="header">
<img src="/assets/img/tostp.png" align="center" alt='logo'/>
</div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<br><br>
  <div class="r">
    Title: <input type="text" name="Title" value="<?php echo $Title;?>">
  <span class="error"><?php echo $TitleErr;?></span>
  </div>
  <br><br>

  <div class="r">
  Post: <textarea name="Post" rows="20" cols="90"><?php echo $Post;?></textarea>
</div>
<br><br>
<div class="rs">
  <input type="submit" name="submit" id="submit" value="Submit" /><br/>
</div>
</form>
<?php

include_once 'include/class.user.php';

$email = "6";
$todays_date = date('d-m-Y (H:i:s)');
$sql = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
/*$data = array(


  //'name' => $name,
  //"email" => $email,
  //'Title' => $Title,
  //"post" => $Post,
  //'date'=> $todays_date,
  //'uid'=> $uid

//);
//$tittle = $name. "_post_on_" . $todays_date . ".json";



//    function testfun($tittle, $data)
//    {
//
//    $fh = fopen("posts/$tittle", 'w')
//    or die("error opening output file");
//    fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
//    fclose($fh);
//    }
*/
  

?>




</body>
</html>