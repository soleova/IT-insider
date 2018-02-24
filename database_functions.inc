<?php

  function connect_to_database(){
    global $connection; 
    
    $connection = mysqli_connect('localhost', 'root', '', 'poslovi');
	
    if(mysqli_connect_errno()){
      die("Problem prilikom povezivanja sa bazom: ".mysqli_connect_error());
    }
  }
  
  function disconnect(){
      global $connection;
      mysqli_close($connection); 
  }

?>