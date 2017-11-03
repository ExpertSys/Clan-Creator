<?php error_reporting(0); session_start();
require 'connections/db.php';

    $user = $_POST['user_page'];
    if (isset($user)){
        if (!empty($user)){
          $db->query("INSERT INTO users(username)
          VALUES('$user')");
          session_start();
          $_SESSION['username'] = $user;
        }
    }

try {
    if (count($clanInfo) <= 0){
        throw new Exception("<span id ='noData'>-- No Clans Created --</span>");
    } else {
      $total = 0;
      for ( $x = 0; $x < count($clanInfo); $x++){
        echo '<div class = "team">';
        echo '<img src = "images/teamimg.png"/>';
        echo '<span class = "clanName"><span id="highlight">'.$clanInfo[$x]['name'].'</span></span>';
        echo '<span class = "clanMembers">'.$clanInfo[$x]['members'].' Team Members</span>';
        echo '<span class = "join" id = "'.$clanInfo[$x]['id'].'">Join</span>';
        echo '<span id = "'.$clanInfo[$x]['id'].'" name = "leaveClan" class = "leaveTeam" style = "color:#FFF;position:absolute;right:10px;cursor:pointer;">&times;</span>';
        echo "</div>";
      }
 }
} catch (Exception $e){
      echo $e->getMessage();
    }
    $newuser = $_SESSION['username'];
    $id = $_POST['id'];

    $checkClan = $db->select("SELECT clan_id FROM users WHERE username = '$newuser'");
    foreach($checkClan as $inClan){
        if (empty($inClan['clan_id'])){
          $db->query("UPDATE clans SET members = members + 1 WHERE id = '$id'");
          $clanname = $db->select("SELECT name FROM clans WHERE id = '$id'");
          foreach ($clanname as $val){
            $db->query("UPDATE users SET clan = '$val[name]' WHERE username = '$newuser'");
            $db->query("UPDATE users SET clan_id = '$id' WHERE username = '$newuser'");
          }
        } else {
        }
    }

    $team = $_POST['leaveteam'];
    $db->query("DELETE FROM clans WHERE id = '$team'");
    $db->query("UPDATE users SET clan = '' WHERE clan_id = '$team'");
    $db->query("UPDATE users SET clan_id = '' WHERE clan_id = '$team'");






?>
