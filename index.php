<?php
  include 'Baglanti/dbBaglanti.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Ağ Programlama Ödevi</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Regna
    Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->

  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script>
    $(document).ready(function(){
      var textAlani;
      $('#btn_okulNo').click(function(){

        var form_data ={
          okulNu: $("#okulNu").val()
        };
          $.ajax({
              url: "dersSec.php",
              type: "POST",
              dataType: "JSON",
              data: form_data,
              success: function(msg){
                $("#dersDetay").html(msg.islem);
                $("#ilkSira").html(msg.gizli);
                $("#xmlButton").html(msg.xmlButton);
                $("#jsonButton").html(msg.jsonButton);
                $("#kodlanmisAlan").html(msg.kodlanmisAlan);
              },
              error: function(){
                alert("Hata Meydana Geldi!");
              }
          });

      });

      $('#dersDetay').keyup(function(){

        var ders_data = {
          ilkSira: $("#gizli_ilkSira").val(),
          siraNo: $("#text_sira").val(),
          dersKodu:$("#text_ders_kodu").val(),
          dersAdi: $("#text_ders_adi").val()
        };
        
        $.ajax({
          url: "dersGuncelle.php",
          type: "POST",
          dataType: "JSON",
          data: ders_data,
          success: function(cevap){
            $("#ilkSira").html(cevap.islem);
          },
          error: function(){
            alert("Ders Bilgileri Güncellenemiyor!");
          }
        });

      });

      $("#xmlButton").click(function(){

        var xml_data = {
          xml_siraNo: $("#text_sira").val()
        };

        $.ajax({
          url: "xmlGoster.php",
          type: "POST",
          dataType: "XML",
          data: xml_data,
          success: function(xmlVeri){
            $("#kodlanmisAlan").empty();

            $(xmlVeri).find('ders').each(function(index){
                var sNo = $(this).find('sira_no').text();
                var dKodu= $(this).find('ders_kodu').text();
                var dAdi = $(this).find('ders_adi').text();

                $('#kodlanmisAlan').append(" <div class='form-group'><label for='comment'>Kodlanmış Alan:</label>  <textarea class='form-control' rows='5' id='comment' style='resize: none;'><dersler>\n<ders>\n<sira_no>"+sNo+"</sira_no>\n<ders_kodu>"+dKodu+"</ders_kodu>\n<ders_adi>"+dAdi+"</ders_adi>\n</ders>\n</dersler></textarea></div>");
            });
          },
          error: function(){
            alert("XML Formatı Oluşturulamadı!");
          }
        });
      });

      $("#jsonButton").click(function(){
          var json_data = {
          json_siraNo: $("#text_sira").val()
        };

        $.ajax({
          url: "jsonGoster.php",
          type: "POST",
          dataType: "JSON",
          data: json_data,
          success: function(jsonVeri){
            var veri="<div class='form-group'><label for='comment'>Kodlanmış Alan:</label>  <textarea class='form-control' rows='5' id='comment' style='resize: none;'>{\n   \"sira_no\" : "+jsonVeri.siraNo+"\",\n   \"ders_kodu\" : \""+jsonVeri.dersKodu+"\",\n   \"ders_adi\" : \""+jsonVeri.dersAdi+"\"\n}</textarea></div>";
            $("#kodlanmisAlan").html(veri);
          },
          error: function(){
            alert("JSON Formatı Oluşturulamadı!");
          }
        });
      });

    });
</script>
</head>

<body>

  <section id="hero">
    <div class="hero-container">
      <div class="pic"><img src="img/sau_logo2.png" witdh="300px" height="400px" alt=""></div>
      <h1>AĞ PROGRAMLAMA DERSİ 1.ÖDEVİ</h1>
      <h2>TOLGA YILDIZ | G141210013</h2>
      
        <div class="form-group">
              <h3><label>Okul Numaranızı Giriniz</label></h3>
              <input type="text" class="form-control" id="okulNu">
              <a href="#about" class="btn-get-started" id="btn_okulNo">Ders Seç</a>
        </div>

    </div>
  </section><!-- #hero -->

  <main id="main">

    <!--==========================
      Dersler Section
    ============================-->
    <section id="about">
      <div class="container">
        <div class="row about-container">

          <div class="col-lg-12 content order-lg-1 order-2">
            <table class="table">

              <thead class="thead-dark">
                <tr> 
                  <th scope="col-12">Ders Programı</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <thead class="thead-light">
                <tr> 
                  <th scope="col-12">Sıra No</th>
                  <th>Ders Kodu</th>
                  <th>Ders Adı</th>
                </tr>
              </thead>
              <tbody>

                <?php 
                  $dersSorgu = mysql_query("select * from dersler order by sira_no ASC");
                  
                  while ($dersCek = mysql_fetch_assoc($dersSorgu)) {                        
                ?>

                <tr>
                  <th><?php echo $dersCek['sira_no']?></th>
                  <td><?php echo $dersCek['ders_kodu']?></td>
                  <td><?php echo $dersCek['ders_adi']?></td>
                </tr>

                <?php }?>

              </tbody>
            </table>   

            <div id="dersDetay">
            </div> 

             <div class="row">
              <div id="xmlButton" style="margin-left: 43%;">
              </div>
              <div id="jsonButton" style="margin-left: 5px;">
              </div>
            </div> 

            <div id="kodlanmisAlan">
            </div>

            <div id="ilkSira">
            </div>     

          </div>

        </div>

      </div>
    </section><!-- #Dersler -->

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        <strong>Ağ Programlama 1.Ödevi</strong>
      </div>
      <div class="credits">
        Tolga Yıldız | G141210013
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>

  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>