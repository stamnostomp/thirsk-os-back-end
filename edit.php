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
<?php

$user_levl = $user->get_lvl($uid);

if ($user_levl > 1){
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $sql2 = "SELECT * FROM posts ORDER BY Post_id DESC";
    $query = mysqli_query($mysqli,$sql2);
    $posts = array();
    while ($row = mysqli_fetch_assoc($query)){
        $posts[] = $row;
    }

    }

else {
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $sql2 = "SELECT * FROM posts where uid='$uid' ORDER BY Post_id DESC";
    $query = mysqli_query($mysqli,$sql2);
    $posts = array();
    while ($row = mysqli_fetch_assoc($query)){
        $posts[] = $row;
    }

}

/** $jposts = json_encode($posts); */

/**** echo "<table>";
foreach ($posts as $row) {
   echo "<tr>";
   foreach ($row as $column) {
      echo "<td>$column</td>";
   }
   echo "</tr>";
}    
echo "</table>";
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
<head>
<style>
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
table, th, td {
  border: 1px solid black;
  padding: 5px;
}
table {
  border-spacing: 5px;
}
.edit_tr .text + span {
    display:none
}
</style>
</head>
<body>

<h2>Edit you posts</h2>
<div class="sidenav">
  <a href="home.php">Post</a>
  <a href="edit.php">Manage posts</a>
  <a href="home.php?q=logout">Logout</a>
</div>


<script type="text/javascript">


function show(json) {
    var content = '<table id = "myTable" border = 1>';
    var counter;
    for (counter = 0; counter < json.length; counter++) {
        content += '<tr id =' + counter + ' class="edit_tr"><td class = "edit_td"><span id = "first_' + counter + '" class="text">' + json[counter]['colorName'] + '</span><span><input type="text" value="' + json[counter]['colorName'] + '" class="editbox"  id = "first_input_' + counter + '" /></span></td>'
        '</tr>';
    }
    content += '</table>';
    $('body').append(content);
}

$(document).on("click", ".edit_td", function () {
    $(".text").show().next("span").hide();
    $(this).find(".text").hide().next("span").show().find("input:text").focus();
});

$(document).on("click", function (event) {
    var $target = $(event.target);
    if ($target.closest("table").length == 0) {
        var $input = $("input:text:visible");
        var value = $input.val();
        $input.closest("td").find(".text").text(value).show();
        $input.parent().hide();
    }
});



$(document).on("keyup", "input:text", function (e) {
    if (e.which === 13) {
        var value = $(this).val();
        $(this).closest("td").find(".text").html(value).show();
        $(this).parent().hide();
        return false;
    }
});


show(json);
</script>



</body>
</html>
