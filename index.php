<!DOCTYPE html> 

<html>
  <head>
    <title> Anketa o poslovima </title>
    <meta charset="utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1">
    <link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Dancing+Script|Quicksand" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 
    
    <style>
        html, body {
            margin: 0; 
            height: 100%; 
            overflow: hidden;
        }
       
        .bg {
            background-color: #4b515d; 
	    }
        
        .container-fluid {
            padding: 30px 30px 30px 30px;
        }
        
        .container-fluid .first-col {
            padding-top: 50px;    
        }
        
        .container-fluid .second-col {
            font-family: 'Quicksand', sans-serif;
            color:#33b5e5;
            padding: 0 50px 0 50px;
            text-align: center;
        }
        
        .container-fluid .third-col {
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
        }
        
        .footer p {
            position: relative;
            top:-13px;
        }
        
        a:hover {
            color: hotpink;
        }
        
        .icon-footer {
            font-size: 10px;
            margin: 0 5px 0 2px;
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
          
          
      });
        
    </script>
    
  </head>
 
  <body>
    <div class='container-fluid bg'> 
	   <div class = "row">
           <div class = "col col-md-4 first-col">
				<img class = "logo" id = "logo" src = "icons/first-col-logo.svg"> 
           </div>
            
           <div class = "col col-md-4 second-col">
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
                       
                       <div class="slidecontainer1">
                           <label class = "control-label"> Beneficije </label>
                           <input type="range" min="1" max="5" value="3" step = "1" class="slider" id="beneficije" name = "ocena-beneficije"> 
                       </div>
                
                       <br>

                       <div class="slidecontainer2">
                           <label class = "control-label"> Mogucnost napredovanja </label>
                           <input type="range" min="1" max="5" value="3" step = "1" class="slider" id="napredovanje" name = "ocena-napredovanje">
                       </div>
                
                       <br>
                
                       <div class="slidecontainer3">
                           <label class = "control-label"> Balans izmedju karijere i privatnog zivota </label>
                           <input type="range" min="1" max="5" value="3" step = "1" class="slider" id="balans" name = "ocena-balans">
                       </div>
                
                       <br>
                
			           <div class="form-group">
                           <textarea name='komentar' id='komentar' cols='30' rows='5' class='form-control'> Unesite svoj licni utisak o ovoj firmi </textarea>
                       </div>
        
       
			           <label for="user-message" class="control-label"> Da li biste preporucili ovu firmu? </label> 
                       
                       <br>
                       
			           <div class="form-check checkbox-inline ">
                           <label class="form-check-label">
                               <input class="form-check-input" type="checkbox" name = "preporuka" value="da"> da
                           </label>
			           </div>
                       
			           <div class="form-check checkbox-inline ">
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
  
           <div class = "col col-md-4 third-col">
               <div class = "page-name">
                   <h1 class = "display-1 animated bounceInRight" > Podeli svoje </h1>
                   <h2 class = "display-2 animated zoomIn"> iskustvo </h2>
               </div>
           </div>
        </div>
      </div>
      
      <footer class = "container-fluid footer">
          <p class = "footer-content author">
              <i class="glyphicon glyphicon-copyright-mark icon-footer"></i> made with 
              <i class="glyphicon glyphicon-heart animated infinite pulse icon-footer"></i> 
              <span> by <a href="https://github.com/soleova">gala</a></span>
          </p> 
      </footer>
      
  </body>

</html>