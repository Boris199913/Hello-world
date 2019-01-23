<?php
session_start(); 
if(!isset($_SESSION['login'])){
      echo "<script>
    location.replace('entry.php');
    </script>";
}


function __autoload($class){
  include("class_".$class.".php");
}
//вывод шапки и меню
$page=new hat_foot;
$page->hat();
$page->menu(4);

echo"<div id=content>";
$t=new baza;
$tt=new goods;


if(isset($_GET[delim]))
{
	$tt->del_bucket($_GET[delim],$_SESSION['login']);
	echo "<script>
    location.replace('backet.php');
   </script>";
	
}

$grandsumm=0;
$list=$tt->show_bucket($_SESSION['login']);

 for($i=0; $i<count($list); $i++){
   $el=$list[$i];
   
   $summ= $el['amount']*$el['price'];
   echo "<div class=box >
   <div class=cross> <a href='backet.php?delim=$el[id]'> 555 </a> </div>
   <div class=img_res>
         <img src='img/".$el['photo']."' />
		 </div>
	  	   
	   <p><h4>".$el['name']."</h4>
	    <h5>÷ена за штуку = ".$el['price'].".0 р <br />  ол-во =  $el[amount] шт <br />  —умма к оплате= ".$summ." .0 р</h5></p>
         </div>";
		 $grandsumm+=$summ; }
		 
		 if($grandsumm==0)
		 {
			 	echo "
	<div class=inbacket >
   
	   <p> <h2>Корзина пуста! <a href='index.php' >Пора исправить это!</a> </h2></p>
         </div>
	</div>";
		 }
		 else
		 {
	echo "
	<div class=inbacket >
   
	   <p> <h2>ќЅўјя —”ћћј «ј ј«ј = $grandsumm .0 р </h2></p>
         </div>
	</div>";
		 }


?>