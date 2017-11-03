<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gunz Website</title>
  <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
  <script type="text/javascript" src="js/getTeams.js"></script>
  <script type="text/javascript">
  </script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,300italic' rel='stylesheet' type='text/css'>
</head>
<body>


  <div class = "content">
    <div class = "inner-content">
      <div class = "top-teams">
        <p id = "noData"></p>
        <div class = "findTeamModule">
          <span id = "close"><a href = "connections/logout.php">&times;</a></span>
          <h1>Team Finder</h1>
          <?php
          echo
          "<script type='text/javascript'>
          $('.current-teams').load('./teams.php');
          window.onload = function() {
            if(!window.location.hash) {
              window.location = window.location + '#l';
              window.location.reload();
            }
          }
          </script>"; ?>
          <?php if (isset($_SESSION['username'])){
            echo "<p style = 'color:#FFF;position: relative;text-align:left;left:20px;'>Welcome {$_SESSION['username']} </p>";

            ?>
            <div class = "current-teams">

            </div>
            <span id = "tip">Don't want to join a team? How about
              creating your own?</span>
              <div class = "new-team">
                <?php
                if ($db->validate('teamName')){
                  $teamName = $_POST['teamName'];
                  if (count($clanInfo) == 4){
                  } else {
                    $newClan = $db->query("INSERT INTO clans(name, members, emblem, password)
                    VALUES('$teamName','','','')");
                  }

                } else {
                }
                ?>
                <form action = "#" id = "sendNew" method = "post" autocomplete="off">
                  <input type = "text" name = "teamName" id = "teamTitle" placeholder = "Team Name">
                  <input type = "submit" name = "createTeam" value = "Create" >
                </form>
              </div>
              <?php
            } else {
              ?>
              <div class = "validateUser">
                <div class = "newUser">
                  <form action = "#" method = "post" id = "registerField" autocomplete="off">
                    <span>Temporaily Username</span><br>
                    <input type = "text" name = "guestname" id = "guestName" placeholder = "Must meet requirements below!">
                    <input type = "submit" value = "Create" name = "sendData" id = "createUser">
                  </form>
                </div>
                <div class = "validation">
                  <div class = "usernameCheck">
                    <span class = "checkBox"><span class = 'check'>&#10004;</span></span><span style = "position:relative;left:5px;">at least 3 characters</span>
                  </div>
                </div>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
    </body>
    </html>
