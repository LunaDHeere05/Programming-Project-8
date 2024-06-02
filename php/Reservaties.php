<?php include 'sessionStart.php'; //AN: om te weten welke mail er gebruikt wordt om in te loggen
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reservaties</title>
    <style>

.reservatiesEnTerug{
    display: flex;
}
.reservatiesEnTerug img{
    width: 1.5em;
    height: auto;
    margin: 1.5em;
}
.reservatiesEnTerug h1{
    margin: 0.6em 0.5em 0em 0.5em;
}
.reservatie-chevron-left img{
  width: 1em;
  height: auto;
  padding: 1em;
}
.reservatie-chevron-left {
    display: flex;
}
.alles_annuleren, .alles_verlengen{
  display: flex;
  background-color: #E30613;
  width: 15%;
  height: 2em;
  border-radius: 1em;
  align-items: center;
}
.alles_annuleren a, .alles_verlengen a{
  display: flex;
  text-decoration: none;
  margin: auto;
  color: white;
}
.alles_verlengen{
  background-color: #1bbcb6;

}
.reservatie-top h2{
  color: #1bbcb6;
  padding: 1em;
  }

.reservatie-top{
    width: 100%;
    display: flex;
    align-items: center;
    padding: 1em;
}

.reservatie-top form p{
  font-weight: bold;
  font-size: 16px;
}

.reservatie-top input[type=submit]{
  background-color: transparent;
  font-weight: bold;
  border: none;
  font-size: 16px;
  color:#ccc;

}

#alles_annuleren{
  color:#E30613
}
#forms{
  display: flex;
  flex-direction: column;
  margin-left: auto;
  margin-right: 1em;
  text-align: right;
  gap:0.5em;

}

#forms input{
  text-transform: uppercase;
  letter-spacing: 2px;
  border:2px solid ;
  padding:5px;
  border-radius: 1em;


}
.reservatie-top a img {
    margin: auto;
    height: 1em;
    width: auto;
    padding: 0em 0em 0em 0.5em;
    filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(129deg) brightness(107%) contrast(100%);
}
.ophalen_reservatie_container, .opgehaald_reservatie_container{
  display: flex;
  align-items: center;
  justify-content: center;
}
.ophalen_reservatie_container input[type=checkbox], .opgehaald_reservatie_container input[type=checkbox]{
    appearance: none;
    -webkit-appearance: none;
    display: flex;
    align-content: center;
    justify-content: center;
    padding: 1em;
    border: 0.25rem solid #1bbcb6;
    border-radius: 50%;
    margin-left: 2em;
}
.ophalen_reservatie_container input[type=checkbox]:checked, .opgehaald_reservatie_container input[type=checkbox]:checked{
    background-color: #1bbcb6;
}
.reservatie_item{
  width: 90%;
  margin:1em;
}
.reservatie_item ul{
  display: flex;
  list-style: none;
  border-radius: 2em;
  padding:0.5em;
  justify-content: space-between;
}
.reservatie_item ul li{
  width: 30%;
  height: 80%;
  display: flex;
  flex-direction: column;
  margin: auto;
  text-align: center;
  justify-content: space-between;
}
.reservatie_item ul li:last-child{
  margin-right: 3em;
  align-items: flex-end;
}
.reservatie_item ul li:first-child img{
  width: 10em;
  height:10em;
  margin: 1em auto;
  background-color: white;
  padding: 0.5em;
}

.status h3{
  color:black;
  font-weight: bold;
}
.status p{
  font-weight: normal;
  color: #E30613;
}
.status span{
  color: black;
  font-weight: normal;

}
.annuleer_btn img{
  width: 1.5em;
  height: auto;
  margin: 1em;
}
.annuleer_btn{ 
  width: 50%;
}
.annuleer_btn button{
  margin: auto;
  display: flex;
  padding: 0 10px;
  background-color: transparent;
  border: 3px solid #E30613;
  border-radius: 2em;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #E30613;
  font-weight: bold;
  font-size: 16px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.annuleer_btn button img{
  background-color: transparent;
  margin:5px;
  padding:5px;
  width:2em;
  filter: invert(27%) sepia(96%) saturate(7476%) hue-rotate(355deg) brightness(93%) contrast(100%);

}

.opgehaald_reservatie_container .status p{
  color: #1bbcb6;

}
.opgehaald_reservatie_container .reservatie_item ul li:last-child{
  width: 15%;
}
.defect_btn button, .verleng_btn button{
  display: flex;
  width: 100%;
  justify-content: center;
  background-color: #303030;
  color: white;
  border: none;
  border-radius: 2em;
  align-items: center;
}
.defect_btn button p, .verleng_btn button p{
  margin-left: 1em;
  font-weight: bold;
  font-size: 16px;
}
.defect_btn button img, .verleng_btn button img{
  width: 1.5em;
  height: auto;
  margin: 1em;
  filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(8deg) brightness(109%) contrast(101%);
}
.verleng_btn button{
  background-color: #1bbcb6;
  width: 100%;
  margin-top: 2em;
}
    </style>
  </head>
  <body>
    <?php include 'top_nav.php'?>
        <div class="reservatiesEnTerug">
          <a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><img src="images/svg/chevron-left-solid.svg" alt=""></a>
        <h1>Mijn reservaties</h1>
        </div>
   
        <div class="reservatie-top">
        <h2>Nog op te halen</h2>
        <?php include 'functies\reservatie_ophalen.php'?>
        </div>

        <div class="reservatie-top">
          <h2>Opgehaald</h2>
          <div class="alles_verlengen">
            <a href="#">
              <p>Alles verlengen</p>
              <img src="images/svg/calendar-regular.svg" alt="xmark" />
            </a>
          </div>
          <form>
            <input type="submit" value="Selectie verlengen" style="color: #1bbcb6;" id="selectie_verlengen">
          </form>
        </div>
        <?php include 'functies\reservatie_opgehaald.php'?>
        
        <script>

  //anuleren van items
let arrayAnnuleerItems=[];

  function annuleerItems(exemplaarId,uitleenId){
    this.exemplaarId=exemplaarId;
    this.uitleenId=uitleenId
  };

function toevoegenAanArray(eId,uId){
  let item=new annuleerItems(parseInt(eId),parseInt(uId));
  arrayAnnuleerItems.push(item);
}

function verwijderenUitArray(uId) {
    arrayAnnuleerItems = arrayAnnuleerItems.filter(item => item.uitleenId !== parseInt(uId));
}

  document.querySelectorAll('.annulerenCheck').forEach(function(button) {
    button.addEventListener('click', function() {
      if (button.checked) {
        button.src = 'images/svg/plus-circle-fill.svg';
        toevoegenAanArray(button.value,button.id)

      } else {
        button.src = 'images/svg/plus-circle.svg';
        verwijderenUitArray(button.id);
      }

      if(arrayAnnuleerItems.length>0){
    document.getElementById('selectie_annuleren').style.color='#E30613'
    document.getElementById('selectie_annuleren').style.borderColor='#E30613'

    document.getElementById('selectie_annuleren').style.cursor='pointer'
  }else{
    document.getElementById('selectie_annuleren').style.color='#ccc'
    document.getElementById('selectie_annuleren').style.borderColor='#ccc'
    document.getElementById('selectie_annuleren').style.cursor='none'

  }
    });
  });

  //selectie annuleren
  document.getElementById('formAnnuleer').addEventListener('submit',function(e){
    e.preventDefault();
    if(arrayAnnuleerItems.length>0){
      document.getElementById('hidden').value=JSON.stringify(arrayAnnuleerItems);
      document.getElementById('formAnnuleer').submit();
    }
  })

  //item annuleren
  document.querySelectorAll('.annuleer').forEach(function(button) {
    button.addEventListener('click', function() {
      arrayAnnuleerItems=[];
      toevoegenAanArray(parseInt(button.value),parseInt(button.id));
      document.getElementById('hidden').value=JSON.stringify(arrayAnnuleerItems);
      document.getElementById('formAnnuleer').submit();
      console.log(document.getElementById('hidden').value)
    });
  });
  
  //alles annuleren 
  if(document.querySelectorAll('.annulerenCheck').length==0){
    document.getElementById('alles_annuleren').style.color="#ccc";
    document.getElementById('alles_annuleren').style.borderColor="#ccc";
  }
  
  document.getElementById('formAnnuleerAll').addEventListener('submit',function(e){
    e.preventDefault();
    arrayAnnuleerItems=[];
    document.querySelectorAll('.annulerenCheck').forEach(function(button) {
        button.checked
        button.src = 'images/svg/plus-circle-fill.svg';
        toevoegenAanArray(parseInt(button.value),parseInt(button.id));
    })

    if(arrayAnnuleerItems.length>0){
      document.getElementById('hiddenAll').value=JSON.stringify(arrayAnnuleerItems);
     this.submit();
    }
  })

  

  var defect_buttons = document.querySelectorAll('.defect_button');
  defect_buttons.forEach(function(button) {
    button.addEventListener('click', function() {
      window.location.href = 'DefectMelden.php';
    });
  });


</script>
<?php include 'footer.php'?>
  </body>
</html>