<?php
//header ('Content-type:text/html; charset=utf-8');
?>
<?php
//страница группы
session_start(); 
if(!isset($_SESSION['admin'])){
      echo "<script>
    location.replace('index.php');
    </script>";
}


function __autoload($class){
include("../class_".$class.".php");
}
$connection = new mysqli("localhost", "root", "", "BD_Aptek");
//вывода шапки и меню
$page=new hat_foot;
$page->adm_hat();
$page->menu(4);

echo"<script>
function conf(){
 return(confirm('удалить?!'));}
</script>";

	echo '
	
	
	<script>
 
function st(){

		var xhttp;
  if (window.XMLHttpRequest) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("chh").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "2.php", true);
  xhttp.send();
  
}
}

function st2(){

		var xhttp;
  if (window.XMLHttpRequest) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tbl").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "3.php", true);
  xhttp.send();
  
 
  setTimeout(st,100);  //вызов функции st через секунду
}
}
</script> 
<body onload="st2()">
	';
	
	
$t=new baza;
$tt=new naznn;


//вывод таблицы
echo"<div id=content>
 <h2>Назначение препаратов</h2> <br> <div id=tbl> </div> ";
$t=new baza;
$tt=new naznn;

 echo"
<br>
<form>
<input type=submit value='добавить запись' name=crr class='octava' onclick='st();return false;'>
</form>
<div id=chh> </div>

";



if($_GET['ok'])
{

if ((!$connection->query("DROP PROCEDURE IF EXISTS AddInfo") || (!$connection->query("CREATE PROCEDURE AddInfo( IN d1 CHAR(20),IN d2 CHAR(20))
	BEGIN 
INSERT INTO `BD_Aptek`.`Nazn` (`id_nazn`, `group`, `text`) VALUES (NULL, d1, d2); 
END;")))) {
    echo "An error occurred: (" . $connection->errno . ") " . $connection->error; }

if (!$connection->query("CALL AddInfo('$_GET[24]','$_GET[25]')")) {
    echo "An error occurred: (" . $connection->errno . ") " . $connection->error;}
}

if($_GET['del'])
{

	if ((!$connection->query("DROP PROCEDURE IF EXISTS DeleteInfo") || (!$connection->query("CREATE PROCEDURE DeleteInfo(IN idi INT) BEGIN DELETE FROM Nazn WHERE id_nazn=idi; END;")))) {
    echo "An error occurred: (" . $connection->errno . ") " . $connection->error; }

if (!$connection->query("CALL DeleteInfo($_GET[del])")) {
    echo "An error occurred: (" . $connection->errno . ") " . $connection->error;}
}


//если нажата ссылка изменить
if($_GET['chn'])
{
$r=$tt->get_number_by_id($_GET['chn']);	

echo"
<form >
группа: 
<input type=text  name=1 value=".$r['group']."><br/>
расписание:
<input type=text  name=2 value=".$r['text']."><br/> 
<input type= hidden value='".$_GET[chn]."' name=edddd>
<input type=submit value='добавить' name=okk >
</form>
";


}

if($_GET['okk'])
{
	$mas=array(
$mass[group]=$_GET[1],
$mass[text]=$_GET[2],
$mass[id_nazn]=$_GET[edddd]
);
$tt->chn($mass);
echo"<script> location.replace('naznn.php');   </script>;" ;

}
$page->footer();






?>