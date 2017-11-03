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
    }

    $db = new Db();
    $clanInfo = $db->select("SELECT id, name, members, emblem, password FROM clans LIMIT 4");
?>
