<?php
require "Baglanti/dbBaglanti.php";

	$siraNo = $_POST['xml_siraNo'];

	$dersSorgu = mysql_query("select * from dersler where sira_no='".$siraNo."'");
	$dersCek = mysql_fetch_assoc($dersSorgu);

	$xml='<?xml version="1.0" encoding="UTF-8"?><dersler>';
	$xml.="<ders><sira_no>".$dersCek['sira_no']."</sira_no><ders_kodu>".$dersCek['ders_kodu']."</ders_kodu><ders_adi>".$dersCek['ders_adi']."</ders_adi></ders></dersler>";

	print($xml);

?>