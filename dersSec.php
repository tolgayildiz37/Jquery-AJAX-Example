<?php
require "Baglanti/dbBaglanti.php";

if($_POST['okulNu'] != ""){
	$okulNu=$_POST['okulNu'];
	$bolunmus=substr($okulNu, 9,10);
	$secilmis = $bolunmus % 5;

	$dersSorgu = mysql_query("select * from dersler order by sira_no ASC");
	while($dersCek = mysql_fetch_assoc($dersSorgu)){
		if(($dersCek['sira_no']%5)==$secilmis){

				$array["islem"]= "<div class='form-group'>
				  <label for='usr'>Sıra No:</label>
				  <input type='text' class='form-control' id='text_sira' value='".$dersCek['sira_no']."'>
				</div>

				<div class='form-group'>
				  <label for='usr'>Ders Kodu:</label>
				  <input type='text' class='form-control' id='text_ders_kodu' value='".$dersCek['ders_kodu']."'>

				</div>
				<div class='form-group'>
				  <label for='usr'>Ders Adı:</label>
				  <input type='text' class='form-control' id='text_ders_adi' value='".$dersCek['ders_adi']."'>
				</div>";

				$array['gizli'] = "<div class='form-group'>
				  <input type='hidden' class='form-control' id='gizli_ilkSira' value='".$dersCek['sira_no']."'>
				</div>";

				$array['xmlButton'] = "<div class='form-group'>
				<button type='button' class='btn btn-primary'>XML Göster</button>";

				$array['jsonButton'] = "<button type='button' class='btn btn-info'>JSON Göster</button>
				</div>";

				$array['kodlanmisAlan'] = " <div class='form-group'>
			  <label for='comment'>Kodlanmış Alan:</label>
			  <textarea class='form-control' rows='5' id='comment' style='resize: none;'></textarea>
			</div>";
		}
	}
	
}else{
	$array['islem'] = "Lütfen Okul Numaranızı Giriniz";
}
echo json_encode($array);
?>