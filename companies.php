<?php

  include 'database_functions.inc'; 
  
  $kompanije = ""; 
  
  connect_to_database();
  
  $upit = "select distinct kompanija from anketa";
  $rezultat = mysqli_query($connection, $upit) or die("Problem prilikom izvrsavanja skripta".mysqli_error($connection));
  
  while($red = mysqli_fetch_assoc($rezultat)){
    $kompanije .= $red['kompanija']."::";
  }
  
  echo $kompanije;
  
  disconnect();
  
?>