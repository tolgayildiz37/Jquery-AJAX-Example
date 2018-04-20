<?php
require "Baglanti/dbBaglanti.php";

$siraNo = $_POST['json_siraNo'];

	$dersSorgu = mysql_query("select * from dersler where sira_no='".$siraNo."'");
	$dersCek = mysql_fetch_assoc($dersSorgu);

	$array['json'] = array('sira_no' => $dersCek['sira_no'], 'ders_kodu' => $dersCek['ders_kodu'], 'ders_adi' => $dersCek['ders_adi']);

	$array['siraNo'] = $dersCek['sira_no'];
	$array['dersKodu'] = $dersCek['ders_kodu'];
	$array['dersAdi'] = $dersCek['ders_adi'];

	$array['textAlani'] = " <div class='form-group'>
  <label for='comment'>Kodlanmış Alan:</label>
  <textarea class='form-control' rows='5' id='comment' style='resize: none;'>".$dersCek['sira_no']."--".$dersCek['ders_kodu']."--".$dersCek['ders_adi']."</textarea>
</div>";

	echo json_encode($array);

?>