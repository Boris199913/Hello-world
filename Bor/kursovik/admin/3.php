<?php 
function __autoload($class){
 include("../class_".$class.".php");
}

$t=new baza;
$tt=new naznn;


$list=$tt->show('','');
 


echo "<table border=1 align='center'>";
echo "<tr id=tr align='center'>
	<td>v�����$sort[0] </a></td>
	<td>�������� $sort[1] </td>
	<td colspan=2>��������������</td>

	</td>
	</tr>";
 for($i=0; $i<count($list); $i++){
   $el=$list[$i];
   echo "<tr>
         
	   <td>".$el[group]."
           </td>
		    <td>".$el[text]."
           </td>
		   <td><a href=?del=$el[id_nazn] onclick = 'return(conf())' > �������  </a>
           </td>
		   <td><a href=?chn=$el[id_nazn] )' > ��������  </a>
           </td>
         </tr>";
 }//for 	   
echo "</table>";
 
 ?>