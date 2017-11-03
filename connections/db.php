<?php
    class Db{

        protected static $connection;
        public $getRows = [];

        public function connect(){
            $config = parse_ini_file("config.ini");
            if (!isset(self::$connection)){
                self::$connection = new Mysqli(
                $config['host'], $config['username'],
                $config['password'], $config['dbname']);
            }
            if (self::$connection === false){
                return false;
            }
            return self::$connection;
        }

        public function query($query){
            $connection = $this->connect();
            $result = $connection->query($query);
            return $result;
        }

      public function select($query){
          $rows = [];
          $error_message = 0;
          $connection = $this->connect();
          $result = $connection->query($query);
          while ($row = mysqli_fetch_array($result)){
            $rows[] = $row;
          }
            return $rows;
       }

       public function validate($value){
            if(isset($_POST[$value])){
              if (!empty($_POST[$value])){
                    return true;
              }
          } else {
              return false;
          }
       }

       public function topPlayers(){
           $connection = $this->connect();
           $getRows = $connection->query("SELECT count(username) FROM users");
           $result = $connection->query("SELECT username FROM users LIMIT 5");

           $get_rankings = [1,2,3,4,5];
           $get_image_path = "images/";
           $path = "";
           $total = 0;
           $rows = [];

           if ($getRows->num_rows > 0){
               while ($row = mysqli_fetch_array($getRows)){
                   $count = '';
                   $count .= $row[0];
                   $max_players = $count;
               }
           }

           while ($row = $result->fetch_assoc()){
               $rows[] = $row;
           }
           for ($x = 0; $x < $max_players; $x++){
               $total = $get_rankings[$x];
               $path .=  "<img src = '{$get_image_path}{$total}.png'>\n <span class = 'rank1'>{$rows[$x]['username']}</span><br/>";
           }
           return $path;
       }
    }

    $db = new Db();
    // $top_players = $db->topPlayers();

    $clanInfo = $db->select("SELECT id, name, members, emblem, password FROM clans LIMIT 4");


?>
