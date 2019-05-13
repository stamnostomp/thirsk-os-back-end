<?php
function write_data(){
  $user->get_fullname($uid);

  $data = array(

              'name' => $fullname,
              "email" => $email,
              'Title' => $Title,
              "post" => $Post,
              'date'=> $todays_date,
              'uid'=> $uid

              );


              $tittle = $fullname . "_post_on_" . $todays_date . ".json";

              $fh = fopen("posts/$tittle", 'w')
              or die("error opening output file");
              fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
              fclose($fh);
              echo "this ran";
}
?>
