<!DOCTYPE html> 
 <html>
    <head>
        <meta name = "viewport" content = "width=device-width, initial-scale = 1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand|Lato|Montserrat">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    
        <style>
            .container-fluid h4{
                font-family: 'Montserrat', sans-serif;
            }
            
            .container-fluid {
                font-family: 'Lato', sans-serif;
                line-height: 1.5;
                padding: 30px 50px 30px 50px;
                justify-content: center;
		        align-items: center;
		        margin: 0 auto;
		        text-align:center;
                background-color: #4b515d;
                color: #33b5e5;
	        }
        
            .icon-comment{
                position:relative;
                left: 5px;
            }
        
            .fa {
                font-size: 50px;
                margin: 0 auto;
                padding: 10px 10px 30px 10px;
                color:white;
                -webkit-transition: color 2s; 
                transition: color 2s;
            }
        
            .fa:hover{
                color: #286177;
            }
        
            th{
                text-align: center;
            }
        
            .header-comment{
                padding: 0px 0px 20px 0px;
            }
       
	        .table-hover thead tr:hover th, .table-hover tbody tr:hover td {
                background-color: #286177;
            }
    
    </style>
    
    <script type='text/javascript'>
      
        $(document).ready(function(){
          $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").alert('close'); 
          });
      });
        
    </script>
    
  </head>
 
<body>

    <?php
      include 'database_functions.inc';
      
      connect_to_database();
		 
      $firma=$_GET['firma'];
      $komentar=$_GET['komentar'];
      $pozicija_id=$_GET['pozicije'];
          
      $ocena_beneficije = 0;
      $ocena_napredovanje = 0;
      $ocena_balans = 0;
      $finalna_ocena = 0;
          
      if(isset($_GET["ocena-beneficije"])){
          $ocena_beneficije = $_GET["ocena-beneficije"];
      }

      if(isset($_GET["ocena-napredovanje"])){
          $ocena_napredovanje= $_GET["ocena-napredovanje"];
      }
      
      if(isset($_GET["ocena-balans"])){
          $ocena_balans = $_GET["ocena-balans"];
      }
      
      /* finalna ocena za unos u bazu se racuna tako sto se prethodne 3 ocene saberu i izracuna njihov prosek */
	  $finalna_ocena = round((($ocena_beneficije + $ocena_napredovanje + $ocena_balans)/3), 2);
     
      $preporuka = "";
        
      if(isset($_GET["preporuka"])){
          $preporuka = $_GET["preporuka"];
      }
          
          
      $upit_pozicija = mysqli_query($connection,  "select naziv from pozicije where sifra = '$pozicija_id'");
        
      if($upit_pozicija){
          $pozicija_naziv = mysqli_fetch_assoc($upit_pozicija);
          $pozicija = $pozicija_naziv['naziv'];
      }
      else{
          echo "Problem sa upitom - naziv pozicije".mysqli_error($connection);
      }
          
      $upit = "insert into anketa (kompanija, pozicija, ocena_beneficije, ocena_napredovanje, ocena_balans, prosecna_ocena, komentar, preporuka) 
                values ('$firma', '$pozicija', $ocena_beneficije, $ocena_napredovanje, $ocena_balans, $finalna_ocena, '$komentar', '$preporuka')";

      $unos = mysqli_query($connection, $upit);
        
      if($unos){
          $upit_statistika="select round(avg(prosecna_ocena),2) as prosek, count(*) as ukupno, sum(ocena_beneficije) as ukupno_beneficije, sum(ocena_balans) as ukupno_balans,
                                    sum(ocena_napredovanje) as ukupno_napredovanje
                                    from anketa
                                    where kompanija = '$firma'";
          
          $rezultat_statistika = mysqli_query($connection, $upit_statistika) or 
                                 die("Problem prilikom izvrsavanja upita - statistika".mysqli_error($connection));
		 
          $statistika = mysqli_fetch_assoc($rezultat_statistika);

          $komentari = mysqli_query($connection, "select prosecna_ocena, pozicija, komentar, preporuka from anketa where kompanija = '$firma'") 
					   or die("Problem prilikom izvrsavanja upita - komentari".mysqli_error($connection));
          
          $prosecna_ocena = $statistika['prosek'];
          $ukupno_glasaca = $statistika['ukupno'];
          $prosecna_beneficije = round($statistika['ukupno_beneficije']/$statistika['ukupno'], 2);
          $prosecna_napredovanje = round($statistika['ukupno_napredovanje']/$statistika['ukupno'], 2);
          $prosecna_balans = round($statistika['ukupno_balans']/$statistika['ukupno'], 2);
          
            
          $preporuke = mysqli_query($connection, "select count(*) as ukupno_preporuka from anketa where kompanija = '$firma' and preporuka = 'da'")
                              or die("Problem prilikom izvrsavanja upita - preporuke".mysqli_error($connection));
         
          $ukupno_preporuka = mysqli_fetch_assoc($preporuke);
          $broj_preporuka = $ukupno_preporuka['ukupno_preporuka'];
          $procenat_preporuka = round($broj_preporuka/$ukupno_glasaca*100.0, 2);
            
		  echo "<div class = 'container-fluid bg-1'>
                    <div class = 'alert alert-success' role='alert'>
				        <strong> Uspesno ste popunili anketu!</strong> Hvala na izdvojenom vremenu.
				    </div>
                
                    <br>
                
                    <div class='row_1'>
                        <div class='icon'>
                            <i class='fa fa-users' aria-hidden='true'></i>
                        </div>
                        <div class='text-wrapper'>
                            <h4 class='text-uppercase'> <strong> Broj ispitanika </strong> </h4>
                            <p> Ukupan broj osoba koje su popunile anketu je $ukupno_glasaca. <br>
                                Shodno ocenama ispitanika, ukupna opsta ocena firme $firma je $prosecna_ocena. <br>
                                Firmu preporucuje $procenat_preporuka% ispitanika.</p>
                        </div>
                    </div>
                    
                    <br>
                    
                    <div class = 'row_2'>
                        <div class='col-md-4'>
                            <div class='icon'>
                                <i class = 'fa fa-arrow-circle-up' aria-hidden='true'></i>
                            </div>
                            <div class='text-wrapper'>
                                <h4 class='text-uppercase'> <strong> Beneficije </strong> </h4>
                                <p> Prosecna ocena beneficija u firmi $firma je $prosecna_beneficije </p>
                            </div>
                        </div>
                    
                        <div class='col-md-4'>
                            <div class='icon'>
                                <i class = 'fa fa-bar-chart' aria-hidden='true'></i>
                            </div>       
                            <div class='text-wrapper '>
                                <h4 class='text-uppercase'> <strong> Mogucnost napredovanja </strong> </h4>
                                <p> Prosecna ocena mogucnosti napredovanja u firmi $firma je $prosecna_napredovanje </p>
                            </div>
                        </div>
                    
                        <div class='col-md-4'>
                            <div class='icon'>
                                <i class = 'fa fa-balance-scale' aria-hidden='true'></i>
                            </div>       
                            <div class='text-wrapper'>
                                <h4 class='text-uppercase'> <strong> Balans </strong> </h4>
                                <p> Prosecna ocena balansa izmedju karijere i privatnog zivota u firmi $firma je $prosecna_balans </p>
                            </div>
                        </div>
                    </div>
            </div>";
            
            echo "<div class = 'container-fluid bg-2'>
                    <div class = 'comment-row'>
                        <i class = 'fa fa-commenting icon-comment' aria-hidden = 'true'> </i>
                        <h4 class = 'text-uppercase header-comment'> <strong> Komentari </strong> </h4>";
                    
            $table = '<table class="table table-hover table-dark table-responsive-md">
                        <thead class = "thead-light">
                            <tr>
                                <th >Prosecna ocena</th>
                                <th >Pozicija</th>
                                <th >Komentar</th>
                                <th >Preporuka</th>
                            </tr>
                        </thead>
                        <tbody>';
               
	        while($row = mysqli_fetch_assoc($komentari)) {
                $table .= '<tr>
                    <td>'.$row['prosecna_ocena'].'</td>
                    <td>'.$row['pozicija'].'</td>
                    <td>'.$row['komentar'].'</td>
                    <td>'.$row['preporuka'].'</td>
                </tr>';
            }
          
            $table .= '</tbody> </table>';
               
            echo $table;
			echo "</div>
                </div>";
        }
        else{
            echo "Problem sa unosom".mysqli_error($connection);
        }
       
        disconnect();
    
      ?>
  
  </body>

</html>