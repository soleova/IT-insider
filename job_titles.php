<?php

  include 'database_functions.inc'; 
  
  $pozicije = ""; 
  
  connect_to_database();
  
  $upit = "select sifra, naziv from pozicije";
  $rezultat = mysqli_query($connection, $upit) or die("Problem prilikom izvrsavanja skripta".mysqli_error($connection));
  
  while($red = mysqli_fetch_assoc($rezultat)){
    $pozicije .= $red['sifra']." ".$red['naziv']."::";
  }
  
  echo $pozicije;
  
  disconnect();
  
?>