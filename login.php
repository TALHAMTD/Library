<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <script src="../src/js/fontawesome.js"></script>
    <script src="../src/js/jquery.js"></script>
    <title>Document</title>
    <style>
        @keyframes animas{from{font-size:10em;transform:rotate(-30deg);}to{font-size:15em;transform:rotate(0deg);}}
        form{<?=empty($_SESSION["kitap_kullanici_mail_123789"])?"display:block;":"display:none;"?>}
        .alreadyyouhave{<?=empty($_SESSION["kitap_kullanici_mail_123789"])?"display:none;":"display:block;"?>}
        @media only screen and (max-width:768px){
            .kapsayici{
                flex-wrap:wrap!important;
            }
            .kapsayici>div{
                width:100%!important;
            }
        }
    </style>
</head>
<body style="background-image:linear-gradient(45deg, #02F2BA,#09DB6F);height:100vh">
    <div class="container">
        <div style="width:80%;height:80%;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%)">
            <div class="kapsayici d-flex" style=" border-radius:20px;overflow:hidden;height:100%;">
                <div style="background-color:#0AAFF9;width:50%;padding:2em;">
                <div style="background-image:url('src/img/girl-reading-book-3863818-3238408.png');width:100%;height:100%;background-position:center;background-size:contain;background-repeat:no-repeat;"><h1 class="display-5" style="color:#F2FBFF;text-align:center;">Giriş Sayfası</h1></div>
                </div>
                <div style="background-color:#F2FBFF;width:50%;padding:2em;">
                    <div style="width:80%;height:100%;margin-left:auto;margin-right:auto;position:relative;">
                        <form novalidate action="javascript:void(0)" id="login" method="post" style="width:80%;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%)">
                            <div style="margin-bottom:2em;"><h3 style="text-align:center;margin">Tekrar Hoş Geldin!</h3><p>Kitap sistemimizi kullanabilmek için giriş yapmamız gerekiyor.</p></div>
                            <label for="mail">E-Mail Adresiniz</label>
                            <input id="mail" name="mail" style="margin-top:5px;margin-bottom:10px;" type="email" required class="form-control">
                            <span style="font-size:12px;color:#dc3545;display:none;">Mail Adresinizde bir problem var</span>
                            <label for="sifre">Şifreniz</label>
                            <input name="sifre" id="sifre" required style="margin-top:5px;" type="password" class="form-control">
                            <span style="font-size:12px;color:#dc3545;display:none;">Şifrenizde bir problem var</span>
                            <input style="width:100%;margin-top:5px;background-color:#0AAFF9;color:white;display:block;margin:1em auto;" type="submit" class="btn">
                        </form>
                        <div class="islembasarili" style="display:none;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);">
                            <i style="font-size:10em;" class="display-1 fa-regular text-success fa-thumbs-up"></i>
                        </div>
                        <div class="alreadyyouhave" style="width:100%;height:100%;position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);">
                            <h1 class="text-success text-center" style="top:50%;position:absolute;transform:translate(0,-50%);">Zaten Giriş Yapmışsın.</h1>
                            <button class="btn" style="position:absolute;bottom:0;left:50%;transform:translate(-50%,-50%)"><a style="text-decoration:none;" href="">Çıkış Yap<a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var form = document.getElementById("login");
        var mail = document.getElementsByName("mail")[0];
        var sifre = document.getElementsByName("sifre")[0];
        form.addEventListener("submit",(e)=>{
            if(!form.checkValidity()){
                e.preventDefault();
                e.stopPropagation();
                aktif();
            }else{
                veriler = Array(mail.value,sifre.value);
                $.ajax({
                    url:"allin.php",
                    type:"POST",
                    data:{veriler},
                    success:function(e){
                        console.log(e);
                        if(e==="nomail"){
                            mail.classList.add("is-invalid");
                            mail.classList.remove("is-valid");
                            sifre.classList.add("is-invalid");
                            sifre.classList.remove("is-valid");
                            document.querySelector("input[type=email]+span").style.display="block";
                            document.querySelector("input[type=password]+span").style.display="block";
                        }
                        else if(e==="nosifre"){
                            mail.classList.remove("is-invalid");
                            mail.classList.add("is-valid");
                            sifre.classList.add("is-invalid");
                            sifre.classList.remove("is-valid");
                            document.querySelector("input[type=password]+span").style.display="block";
                        }
                        if(e==="successfull"){
                            form.style.display="none";
                            document.getElementsByClassName("islembasarili")[0].style.display="block";
                            document.querySelector(".islembasarili > i").style.animation = "animas 1s infinite alternate";
                            setTimeout(function(){
                                window.location.href="index.php";
                            },5000);
                        }
                    }
                });
            }
            if(!mail.checkValidity()){
                mail.classList.add("is-invalid");
            }
            if(!sifre.checkValidity()){
                sifre.classList.add("is-invalid");
            }
            aktif();
        });
        mail.addEventListener("focusout",(e)=>{
            if(!mail.checkValidity()){
                    mail.classList.add("is-invalid");
                    mail.classList.remove("is-valid");
                }else{
                    mail.classList.add("is-valid");
                    mail.classList.remove("is-invalid");
                }
        });
        sifre.addEventListener("focusout",(e)=>{
            if(!sifre.checkValidity()){
                sifre.classList.add("is-invalid");
                sifre.classList.remove("is-valid");
                }else{
                    sifre.classList.add("is-valid");
                    sifre.classList.remove("is-invalid");
                }
        });

        function aktif(){
            mail.addEventListener("keyup",function(){
                if(!mail.checkValidity()){
                    mail.classList.add("is-invalid");
                    mail.classList.remove("is-valid");
                }else{
                    mail.classList.add("is-valid");
                    mail.classList.remove("is-invalid");
                }
            });
            sifre.addEventListener("keyup",function(){
                if(!sifre.checkValidity()){
                    sifre.classList.add("is-invalid");
                    sifre.classList.remove("is-valid");
                }else{
                    sifre.classList.add("is-valid");
                    sifre.classList.remove("is-invalid");
                }
            });
        }
    </script>
</body>
</html>