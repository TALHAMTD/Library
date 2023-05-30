<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitap Kayıt Sayfası</title>
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <script src="../src/js/fontawesome.js"></script>
    <script src="../src/js/jquery.js"></script>
</head>
<body class="bg-light">
    <div>
        <div style="z-index:-1;width:100%;height:100%;background-color:black;position:fixed;top:-50%;transform:rotate(-65deg);left:-40%;"></div>
        <div class="container">
            <h2 style="color:white;position:sticky;top:0;" class="display-4">Kitap Kayıt</h2>
            <div style="width:50%;margin-left:auto;">
                <form action="allin.php" enctype="multipart/form-data" method="post">
                    <label for="1">Kitabın Adı <b class="text-danger">*</b></label>
                    <input required id="1" name="1" type="text" placeholder="1984" class="form-control">
                    <label for="2">Kitabın Yazarı <b class="text-danger">*</b></label>
                    <input required id="2" name="2" type="text" placeholder="George Orwell" class="form-control">
                    <label for="3">Sayfa Sayısı</label>
                    <input id="3" name="3" type="number" placeholder="489" class="form-control">
                    <label for="4">Kitabın Dili <b class="text-warning">(Default "Türkçe")</b></label>
                    <input id="4" name="4" type="text" placeholder="English" class="form-control">
                    <label for="5">Yayımcı</label>
                    <input id="5" name="5" type="text" placeholder="Kodlab" class="form-control">
                    <label for="6">Kitaba Başlanma Tarihi</label>
                    <input id="6" name="6" type="date" class="form-control">
                    <label for="7">Kitabı Bitirme Tarihi</label>
                    <input id="7" name="7" type="date" class="form-control">
                    <label for="8">Okundu mu<b class="text-warning">(Default "0")</b></label>
                    <input id="8" name="8" maxlength="1" type="number" max="1" min="0" class="form-control">
                    <label for="9">Set mi? <b class="text-warning">(Default "0")</b></label>
                    <input id="9" name="9" maxlength="1" type="number" max="1" min="0" class="form-control">
                    <label for="10">Öncelikli mi? <b class="text-warning">(Default "0")</b></label>
                    <input id="10" name="10" maxlength="1" type="number" max="1" min="0" class="form-control">
                    <label for="11">Elinde var mı? <b class="text-warning">(Default "0")</b></label>
                    <input id="11" name="11" maxlength="1" type="number" max="1" min="0" class="form-control">
                    <label for="12">Salon | Kod (Kütüphane için)</label>
                    <input id="12" name="12" type="text" placeholder="Dil ve Edebiyat Salonu | PS 3503 .R167 F3419 2018" class="form-control">
                    <label for="13">Kitabın Türü</label>
                    <input id="13" name="13" type="text" placeholder="Eğitim" class="form-control">
                    <label for="14">Okunan Sayfa</label>
                    <input id="14" name="14" type="number" placeholder="125" class="form-control">
                    <label for="15">Orijinal Dili</label>
                    <input id="15" name="15" type="text" placeholder="Français" class="form-control">
                    <label for="16">Çeviren</label>
                    <input id="16" name="16" type="text" placeholder="Vedat Günyol" class="form-control">
                    <label for="17">Orijinal Adı</label>
                    <input id="17" name="17" type="text" placeholder="Du Contrat Social" class="form-control">
                    <label for="18">Kimin Listesinde</label>
                    <input id="18" name="18" type="number" min="1" max="6" placeholder="1" class="form-control">
                    <label for="19">Konusu</label>
                    <input id="19" name="19" type="text" placeholder="10 Kişi, hava karardıktan sonra zenciye benzemesinden dolayı ismini aldığı zenci adasında toplanırlar. Ancak her biri farklı sebeplerden hayattan kopmaktadırlar." class="form-control">
                    <label for="20">Kitap Görseli</label>
                    <input id="20" name="20" type="file" accept="image/*" class="form-control">
                    <input type="submit" name="kayit" class="mt-2 btn btn-light w-50" style="display:block;margin-left:auto;margin-right:auto;" value="Kaydet">
                </form>
            </div>
        </div>
    </div>
</body>
</html>