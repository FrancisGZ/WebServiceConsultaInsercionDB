<?php
//include_once '../adodb5/adodb-exceptions.inc.php';
include ('adodb5/adodb.inc.php');
class conexo 
{
     private $db='mysql',$servidor='localhost', $user='root', $password='dep_sis1', $based='ftbsis3';
      
        public function __construct() {
        }
       
       public function conectar() {
           $db = ADONewConnection($this->db); # eg 'mysql' or 'postgres'
           $db->debug = false;
           $db->Connect($this->servidor, $this->user, $this->password, $this->based);
           return $db;
        }

        /*public function close(){
        $db = ADONewConnection($this->db)
        	$db->close();
        }	*/
}
?>
