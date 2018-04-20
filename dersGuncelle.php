<?php
require "Baglanti/dbBaglanti.php";

$array['siraNo']=$_POST['siraNo'];
$array['dersKodu']=$_POST['dersKodu'];
$array['dersAdi']=$_POST['dersAdi'];
$array['ilkSiraNo']=$_POST['ilkSira'];

$dersGuncelle = mysql_query("update dersler set sira_no='".$array['siraNo']."', ders_kodu='".$array['dersKodu']."', ders_adi='".$array['dersAdi']."' where sira_no='".$array['ilkSiraNo']."'");

$array["islem"]= "<div class='form-group'>
	  <input type='hidden' class='form-control' id='gizli_ilkSira' value='".$array['siraNo']."'>
	</div>";

echo json_encode($array);

?>