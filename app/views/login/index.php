<html>

<head>

   <base href="<?= URL ?>">
   <link rel="stylesheet" href="public/css/stylelogin.css">
</head>

<body>

   <div class="login">
      <H1>ورود</H1>
      <form onsubmit="return false;">

         <input id="username" class="select" name="username" placeholder="شماره تلفن" /><br>
         <input id="password" class="select" name="password" type="password" placeholder="رمز عبور" /><br>
         <button id="btn" type="submit" class="btn btn-primary btn-block btn-large"> ورود</button><br />
         <a href="register"> ثبت نام</a>
      </form>

      <span id="showError"></span>
   </div>

   <style>
      #label {
         font-size: 16px !important;
         position: absolute;
         background: #fff;
         top: -10px;
         right: 20px;
         padding: 2px 10px !important;
         border-radius: 5px;
         color: #000 !important;

      }
   </style>







   <script src="public/js/jquery-3.4.1.min.js"></script>

   <script>
      function CheckPassword(inputtxt) {
         var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
         if (inputtxt.match(passw)) {
            return true;
         } else {
            return false;
         }
      }

      function chekphone(phone) {
         var phone = /^09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}/;
         if (inputtxt.match(phone)) {
            return true;
         } else {
            return false;
         }
      }

      $("#btn").on('click', function() {

         if ($("#username").val() == '') {
            $("#showError").text(" شماره تلفن نمیتواند خالی باشد ");

         } else if ($("#password").val() == '') {
            $("#showError").text("رمز عبور نمیتواند خالی باشد ");
         } else if (!CheckPassword($("#password").val())) {
            $("#showError").text("رمز عبور باید بین 6 تا 20 رقم و شامل حروف فارسی یا انگلیسی باشد");
         } else {
            $.ajax({
               url: "<?= URL . 'login/check_data' ?>",
               type: "POST",
               data: {
                  "username": $("#username").val(),
                  "password": $("#password").val()
               },
               success: function(response) {
                  response = JSON.parse(response);
                  if (response.status_code == "404") {
                     $("#showError").text("شماره تلفن یا رمز عبور صحیح نیست");
                  } else {
                     window.location = "<?= URL; ?>";
                  }
               },
               error: function(response) {
                  alert("dsgdgfdgdfgd");
               }
            });
         }
      });
   </script>

</body>

</html>