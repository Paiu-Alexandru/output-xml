<?php
require("../db/conn.php");
if(isset($_POST['submit'])){
 class User{
    public function __construct(
        
    ){
        $this->name  = htmlentities(trim($_POST['name']));
        $this->fName = htmlentities(trim($_POST['fName']));
        $this->phone = htmlentities(trim($_POST['phone']));
        $this->email = htmlentities(trim($_POST['email']));
        $this->conn = Db_conn::conection();
        
    }
     public function output(){
         
         $sql_insert = $this->conn->prepare("INSERT INTO job_task.users (name, fName, phone_nr, email) VALUES (:name, :fName, :phone, :email);");
                try{
                   $sql_insert->bindParam(':name', $this->name);
                   $sql_insert->bindParam(':fName', $this->fName);
                   $sql_insert->bindParam(':phone', $this->phone);
                   $sql_insert->bindParam(':email', $this->email);
                   $sql_insert->execute();
                    
                }
         catch(PDOException $e){
             echo "ERROR something is missing!". $e->getMessage();
         }
         //echo 'user'.count($u).'@test.com';
         
         
         $sql_select = $this->conn->prepare("SELECT * FROM job_task.users;");
         $sql_select->execute();
         
         
            $dom = new DOMDocument();

            $dom->encoding = 'utf-8';
            $dom->xmlVersion = '1.0';
            $dom->formatOutput = true;
            $xml_file_name = 'users.xml';
            $root = $dom->createElement('customers');
          
                 while($row = $sql_select->fetch()){
   
                    $customers_node = $dom->createElement('users');

                    $child_node_name = $dom->createElement('Name', md5($row['name']));
                    $customers_node->appendChild($child_node_name);

                    $child_node_fName = $dom->createElement('FName', md5($row['fName']));
                    $customers_node->appendChild($child_node_fName);
                     
                    $child_node_phone = $dom->createElement('Phone', sha1($row['phone_nr']));
                    $customers_node->appendChild($child_node_phone);

                    $child_node_email = $dom->createElement('email', "Unique Email output is (user".$row['id']."@test.com)");
                    $customers_node->appendChild($child_node_email);
                     
                    $root->appendChild($customers_node);
                 }
    
                   $dom->appendChild($root);
		   

	        $dom->save($xml_file_name);
            
            header("Location: users.xml");
             
         
     }
 }
$output = new User();
$output->output();
}
   

?>
                 