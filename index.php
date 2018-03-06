<!DOCTYPE html> 

<html>
  <head>
    <title> Anketa o poslovima </title>
    <meta charset="utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Dancing+Script|Quicksand">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 
    
    <style>
        html, body {
            margin: 0; 
            height: 100%; 
        }
       
        .bg-1 {
            background-color: #343a40;
            background: url("img/center-bg.jpeg") no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding-top: 160px;
            padding-bottom: 160px;
            color: #212121;
            font-family: 'Quicksand', sans-serif;
            text-shadow: #000 0px 0px 1px;
            -webkit-font-smoothing: antialiased;
	    }
        
        .survey{
            font-size: 13px;
        }
        .survey .first-col {
            padding-top: 100px;    
        }
        
        .survey .second-col {
            font-family: 'Quicksand', sans-serif;
            color:#33b5e5;
            padding: 0 50px 0 50px;
            text-align: center;
        }
        
        .survey .third-col {
            color:#33b5e5;
        }
        
        .third-col .page-name {
            padding-top: 150px;
            margin-left: 20px;
        }
        
        .page-name .display-1 {
            font-family: 'Alfa Slab One', cursive;
            font-size: 55px;
        }
        
        .page-name .display-2 {
             margin-left: 80px;
             font-family: 'Dancing Script', cursive;
             font-size: 60px;
        }
        
        .footer {
            font-family: 'Dancing Script', cursive;
            font-size: 20px;
            text-align: center;
            color:#33b5e5;
            padding-top: 65px;
            padding-bottom: 65px;
        }
        
        
        a:hover {
            color: hotpink;
        }
        
        .icon-footer {
            font-size: 10px;
            margin: 0 5px 0 2px;
        }
        
        .fa-heart {
            color:hotpink;
        }
         
	    .button-sumbit{
		    text-align:center;
		    margin-top: 20px;
	    }
        
        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 10px;
            border-radius: 5px;   
            background:#d3d3d3;
            outline: none;
            opacity: 0.5;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }
        
        .slider:hover {
            opacity: 1;
        }
        
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%; 
            background:  #33b5e5;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background:  #33b5e5;
            cursor: pointer;
        }
        
        .features-icons {
            padding-top: 120px;
            padding-bottom: 120px;
        }

        .features-icons .features-icons-item {
            max-width: 320px;
        }

        .features-icons .features-icons-item .features-icons-icon {
            height: 120px;
        }

        .features-icons .features-icons-item .features-icons-icon i {
            font-size: 70px;
        }

        .features-icons .features-icons-item:hover .features-icons-icon i {
            font-size: 80px;
        }
        
        .find-company{
            background-color: #343a40;
            background: url("img/find-company-bg.jpg") no-repeat center center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding-top: 120px;
            padding-bottom: 120px;
            color: #212121;
            font-family: 'Quicksand', sans-serif;
            text-shadow: #000 0px 0px 1px;
            -webkit-font-smoothing: antialiased;
        }
        
    </style>
    
    <script type='text/javascript'>
    
      $(document).ready(function(){
      
        $.ajax({
          url: 'job_titles.php',  
          method: 'GET', 
          data: {}, 
          success: function(rezultat){
            var pozicije = rezultat.split("::"); 
            for(var i = 0; i < pozicije.length-1; i++){
              var razmak = pozicije[i].indexOf(" "); 
              var sifra = pozicije[i].substr(0, razmak); 
              var naziv = pozicije[i].substr(razmak + 1); 
              
              $("#pozicije").append("<option value='"+sifra+"'>"+naziv+"</option>"); 
            }
          },
            
          error: function(){
            window.alert("Problem - probajte sa koriscenjem aplikacije kasnije!"); 
          }
        });
        
          
        $("#f").submit(function(){
          
          var firma = $("#firma").val();
          if(firma == ""){            
              alert("Niste uneli ime firme!");
              return false; 
          }
         
          var pozicija = $("#pozicije").val();
          if(pozicija == ""){
              alert("Niste odabrali poziciju!");
              return false; 
          }
          
          var komentar = $("#komentar").val().trim();
          if(komentar == "Unesite svoj licni utisak o ovoj firmi" || komentar == ""){
              alert("Niste uneli komentar!");
              return false;
          }
          
          var prvo_slovo = komentar.charAt(0); 
          if("ABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf(prvo_slovo)==-1){
              alert("Komentar - prvo slovo nije veliko!");
              return false;
          }
            
          var poslednje_slovo = komentar.charAt(komentar.length-1);
          if(poslednje_slovo != "."){
              alert("Komentar - bez tackice na kraju!");
              return false;
          }
            
          var checkbox = document.getElementsByName('preporuka');
          var checkboxChecked = 0;
          for(var i = 0; i < checkbox.length; i++){
              if(checkbox[i].checked) 
                  checkboxChecked = 1;
          }
            
          if(checkboxChecked == 0){
              alert("Niste odgovorili da li biste dali preporuku!");
              return false;
          }

        });

          
        $("#komentar").click(function(){
            var sadrzaj = $("#komentar").val();
            if(sadrzaj.trim() == "Unesite svoj licni utisak o ovoj firmi"){
                $("#komentar").val("");
            }
          });
        
        $("#komentar").blur(function(){
            var sadrzaj = $("#komentar").val();
            if(sadrzaj.trim() == ""){
                $("#komentar").val("Unesite svoj licni utisak o ovoj firmi");
            }         
        });
        
           
        $('#firma').focus(function(){
            $(this).attr('placeholder', '');
        });
          
        $('#firma').focusout(function(){
            $(this).attr('placeholder', 'Unesite ime firme');
        });
        
            
        $('[type="checkbox"]').change(function(){
            if(this.checked){
                $('[type="checkbox"]').not(this).prop('checked', false);
            }  
        });
        
        $("nav").find("a").click(function(e) {
            e.preventDefault();
            var section = $(this).attr("href");
            $("html, body").animate({
                scrollTop: $(section).offset().top
            });
        });
          
      });
        
    </script>
    
  </head>
 
  <body>
      
    <nav class="navbar navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">IT Insajder</a>
        <div class = "row">
        <a class="btn btn-primary mr-2" href="#survey">Popuni anketu</a>
        <a class="btn btn-primary mr-2" href="#find-company">Nadji firmu</a>
        <a class="btn btn-primary" href="#">Rang liste</a>
        </div>
      </div>
    </nav>
      
    <div class="container-fluid features-icons bg-light text-center bg-1">
        <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">Saznaj vise o firmama koje te zanimaju i podeli svoje iskustvo sa drugima!</h1>
        </div>
        <div class="row mb-5 ml-3 mr-3">
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto">
              <div class="features-icons-icon d-flex">
                <i class="fa fa-desktop m-auto text-primary"></i>
              </div>
              <h3>Tudja iskustva</h3>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto">
              <div class="features-icons-icon d-flex">
                <i class="fa fa-comment m-auto text-primary"></i>
              </div>
              <h3>Podeli misljenje</h3>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto">
              <div class="features-icons-icon d-flex">
                <i class="fa fa-check m-auto text-primary"></i>
              </div>
              <h3>Rang liste</h3>
            </div>
          </div>
        </div>
    </div>
      
    <div class="container-fluid survey" id = "survey"> 
	   <div class = "row">
           <div class = "col col-md-4 first-col">
				<img class = "logo" id = "logo" src = "icons/first-col-logo.svg"> 
           </div>
            
           <div class = "col col-md-4 second-col mt-4 mb-4">
               <div class = "survey">
                   <form action='results.php' method='GET' id='f'>
                       <div class='form-group'>
                           <input type='text' name='firma' id='firma' class='form-control' placeholder = "Unesite ime firme"> 
				       </div>
                       
                       <div>
                           <select class="form-control" name='pozicije' id='pozicije'>
					       <option value=""> --- odaberite poziciju ---</option>
				           </select>
			           </div>
                       
                       <br>
                       
                       <div class="slidecontainer-1">
                           <label class = "control-label"> Beneficije </label>
                           <input type="range" min="1" max="5" value="3" step = "1" class="slider" id="beneficije" name = "ocena-beneficije"> 
                       </div>
                
                       <br>

                       <div class="slidecontainer-2">
                           <label class = "control-label"> Mogucnost napredovanja </label>
                           <input type="range" min="1" max="5" value="3" step = "1" class="slider" id="napredovanje" name = "ocena-napredovanje">
                       </div>
                
                       <br>
                
                       <div class="slidecontainer-3">
                           <label class = "control-label"> Balans izmedju karijere i privatnog zivota </label>
                           <input type="range" min="1" max="5" value="3" step = "1" class="slider" id="balans" name = "ocena-balans">
                       </div>
                
                       <br>
                
			           <div class="form-group">
                           <textarea name='komentar' id='komentar' cols='30' rows='5' class='form-control'> Unesite svoj licni utisak o ovoj firmi </textarea>
                       </div>
        
       
			           <label for="user-message" class="control-label"> Da li biste preporucili ovu firmu? </label> 
                       
                       <br>
                       
			           <div class="form-check checkbox-inline">
                           <label class="form-check-label">
                               <input class="form-check-input" type="checkbox" name = "preporuka" value="da"> da
                           </label>
			           </div>
                       
			           <div class="form-check checkbox-inline">
                           <label class="form-check-label">
                               <input class="form-check-input" type="checkbox" name = "preporuka" value="ne" > ne
                           </label>
                       </div>
		    
			
			           <div class = "button-sumbit">
                           <input type='submit' id='submit' class='btn btn-primary btn-lg' value='prosledi odgovor'>
                       </div>
                   </form>
               </div>
           </div>
  
           <div class = "col col-md-4 third-col mt-5">
               <div class = "page-name">
                   <h1 class = "display-1"> Podeli svoje </h1>
                   <h2 class = "display-2"> iskustvo </h2>
               </div>
           </div>
        </div>
      </div>
      
      <div class="container-fluid find-company text-center" id = "find-company">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h2 class="mb-4">Zelis da saznas nesto vise?</h2>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form>
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" name="company" list="companies" class ="form-control form-control-lg" placeholder = "Unesi ime firme..">
                    <datalist id="companies">
                    </datalist>
                </div>
                <div class="col-12 col-md-3 mb-5">
                  <button type="submit" class="btn btn-block btn-lg btn-primary">Pretrazi</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <footer class = "footer bg-dark">
          <p class = "footer-content author">
              <i class="fa fa-copyright icon-footer"></i> made with 
              <i class="fa fa-heart animated infinite pulse icon-footer"></i> 
              <span> by <a href="https://github.com/soleova">gala</a></span>
          </p> 
      </footer>
      
  </body>

</html>
