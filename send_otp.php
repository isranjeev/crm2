<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Verification</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Script to move control on next input field -->
<script>
$(document).ready(function() {
    $("input.form-control.input-box").keyup(function() {
        if ($(this).val().length == $(this).attr("maxlength")) {
            $(this).next('input.form-control.input-box').focus();
        }
    });
});
</script>
<script>
$(".inputs").keyup(function () {
    if (this.value.length == this.maxLength) {
      var $next = $(this).next('.inputs');
      if ($next.length)
          $(this).next('.inputs').focus();
      else
          $(this).blur();
    }
});
</script>
  <style>
    .Verification {
    padding: 50px;
    margin: 50px 0px 50px 0px;
}
body {
    margin: 0;
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #f5f5f5;
}
input.form-control.input-box {
    width: 50px;
    height: 50px;
    text-align: center;
    margin: auto;
}

.height-100{height:100vh}.card{width:400px;border:none;height:300px;box-shadow: 0px 5px 20px 0px #d2dae3;z-index:1;display:flex;justify-content:center;align-items:center}.card h6{color:red;font-size:20px}.inputs input{width:40px;height:40px}input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button{-webkit-appearance: none;-moz-appearance: none;appearance: none;margin: 0}.card-2{background-color:#fff;padding:10px;width:350px;height:100px;bottom:-50px;left:20px;position:absolute;border-radius:5px}.card-2 .content{margin-top:50px}.card-2 .content a{color:red}.form-control:focus{box-shadow:none;border:2px solid red}.validate{border-radius:20px;height:40px;background-color:red;border:1px solid red;width:140px}
    

    </style>
</head>
<body>
<script type="text/javascript">
    window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave? Think of the kittens!";
    }
</script>


<div class="container">
    <div class="row">
    
</div>
   

 <!-- custom verification input box design -->
 <div class="container height-100 d-flex justify-content-center align-items-center"> 
    <div class="position-relative"> 
        <div class="card p-2 text-center"> 
        <?php
include('connect.php');
@session_start();
//echo $_SESSION["OTP"];
$otpcode = $_SESSION['OTP'];
$ifidi = $_SESSION['USER'];
$ifid = $_SESSION['USER'];
$lastid = $_SESSION['INSERTED'];
// $reason = $_POST['reason'];
// echo $reason;
// to get the data from the url
// $ifid = $_GET['profileid']; 
//filtering the user details based on the data fetched from the url

$sql = "SELECT * FROM `contacts` WHERE id='$ifid'";
$data = mysqli_query($conn, $sql);
while($drow = mysqli_fetch_array($data)) {
      $uid = $drow['id'];
      $phone_mobile = $drow['phone_mobile'];
      $phone_work = $drow['phone_work'];
      $first_name = $drow['first_name'];

      
      // echo $uid;
     // finding the email connection by using the primary id of a user
      $sqlt = "SELECT * FROM `email_addr_bean_rel` where bean_id='$uid'";
      $eabr = mysqli_query($conn, $sqlt) or die( mysqli_error($conn));
      while($earow = mysqli_fetch_array($eabr)){
        $umailid = $earow['email_address_id'];
      }
     // matching the record and fetching the email address from the table by using the fetched id, contact id and than the bean email address id
      $sesql = "SELECT * FROM `email_addresses` WHERE id='$umailid'";
      $edata = mysqli_query($conn, $sesql) or die(mysqli_error($conn));
      while($eedata = mysqli_fetch_array($edata)){
        $myemail = $eedata['email_address'];
      }
     
    }

    $method = $_SESSION['METHOD'];
    $reason = $_SESSION['REASON'];
   
    
    $upd = "UPDATE `otp_verification` SET `otp_method`='$method', `reason`='$reason' WHERE id='$lastid'";
    mysqli_query($conn, $upd);



if(isset($_POST['submit'])) {
    include('connect.php');
    $otp1 = $_POST['otp1'];
    $otp2 = $_POST['otp2'];
    $otp3 = $_POST['otp3'];
    $otp4 = $_POST['otp4'];
    $otp5 = $_POST['otp5'];
    $otp6 = $_POST['otp6'];
    $otpfinal = $otp1 . '' . $otp2 . '' . $otp3 . '' . $otp4 . '' . $otp5 . '' . $otp6;
    //echo $otpfinal;
    // echo "SELECT * FROM `otp_verification` WHERE user_id='$ifidi' order by id desc limit 1";
    $otv = "SELECT * FROM `otp_verification` WHERE user_id='$ifidi' order by id desc limit 1";
    $otvf  = mysqli_query($conn, $otv);
    while($fro = mysqli_fetch_array($otvf)){
        $vf = $fro['otp_code'];
        $createdd = $fro['created'];
        //echo $vf;
    }
    @session_start();
    //echo $_SESSION["OTP"];
   // $otpcode = $_SESSION['OTP'];
   // echo $otpcode;

    if($otpfinal == $vf) {

        ?>
        <span class="alert alert-success" style="width:100%;">Congratulations! Your OTP has been verified.</span>
        <meta http-equiv = "refresh" content = "5; url = index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DContacts%26action%3Dindex%26parentTab%3DAll" />
        <?php
    }else{

        ?>
        <span class="alert alert-danger" style="width:100%;">Sorry! OTP is incorrect. Please try again!</span>
        <?php
    }
                   
}
?>
            <h6>Please enter the one time password <br> to verify customer's account</h6> 
            <div> <span>A code has been sent to</span> <small>
            <?php
            if($method == 'email') {
                echo $myemail;
                 // email function...
            //$to = 'user@example.com'; 
            $from = 'heyyesonlyyou@gmail.com'; 
            $fromName = 'Ocom - Optical, Communication Expert'; 
             
            $subject = "Customer Verification"; 
             
            $htmlContent = ' 
                <html> 
                <head> 
                    <title>Hello .".$first_name.".</title> 
                </head> 
                <body> 
                    <h1>Please share the OTP with our representative to verify your identity.!</h1> 
                    <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                        <tr> 
                            <th>OTP</th> 
                        </tr> 
                        <tr style="background-color: #e0e0e0;"> 
                            <h2><?php echo $_SESSION["OTP"]; ?></h2> 
                        </tr> 
                       
                    </table> 
                </body> 
                </html>'; 
             
            // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
             
            // Additional headers 
            $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
            $headers .= 'Cc: customercare@occom.com.au' . "\r\n"; 
             
            // Send email 
            if(mail($myemail, $subject, $htmlContent, $headers)){ 
                echo 'Email has sent successfully.'; 
            }else{ 
               //echo 'Email sending failed.'; 
            }
            // Twilio configuration
            }else if($method == 'mobile') {
                echo $phone_mobile;
            }else if($method == 'office') {
                echo $phone_work;
            }else if($method == '') {
                echo "*******";
            }
            ?>
            <?php
            date_default_timezone_set("Asia/Kolkata");
            $current = date("h:i:s");
            echo $current;
            echo  "<br/>";
            echo date( $createdd, 'h:i:s');
            ?>
            </small> </div> 
            <form action="" method="post" enctype="multipart/form-data">
            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
            <form action="" method="post" enctype="multipart/form-data">
                <input class="m-2 text-center form-control rounded" type="text" id="first" name="otp1" maxlength="1" /> 
                <input class="m-2 text-center form-control rounded" type="text" id="second" name="otp2" maxlength="1" /> 
                <input class="m-2 text-center form-control rounded" type="text" id="third" name="otp3" maxlength="1" /> 
                <input class="m-2 text-center form-control rounded" type="text" id="fourth" name="otp4" maxlength="1" /> 
                <input class="m-2 text-center form-control rounded" type="text" id="fifth" name="otp5" maxlength="1" /> 
                <input class="m-2 text-center form-control rounded" type="text" id="sixth" name="otp6" maxlength="1" /> 
            </div> <div class="mt-4"> 
            <input type="submit" name="submit" class="btn btn-danger px-4 validate" value="Validate" />    
        </div>
</form> 
    </div> 
    <div class="card-2"> 
        <div class="content d-flex justify-content-center align-items-center"> 
            <span>Didn't get the code</span> &nbsp;&nbsp;<a href="verify.php?profileid=<?php echo $ifid; ?>" class="text-decoration-none ms-3">Try again!</a> 
        </div> 
    </div> 
</div>
</div>
<!-- custom verification input box design -->

</div>
<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
  
  function OTPInput() {
const inputs = document.querySelectorAll('#otp > *[id]');
for (let i = 0; i < inputs.length; i++) { inputs[i].addEventListener('keydown', function(event) { if (event.key==="Backspace" ) { inputs[i].value='' ; if (i !==0) inputs[i - 1].focus(); } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } } OTPInput();

    
});
</script>
<script>
$(".inputs").keyup(function () {
    if (this.value.length == this.maxLength) {
      var $next = $(this).next('.inputs');
      if ($next.length)
          $(this).next('.inputs').focus();
      else
          $(this).blur();
    }
});
</script>

</body>
</html>
