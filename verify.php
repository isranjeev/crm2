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
  
  <style>
    .Verification {
    padding: 50px;
    /* margin: 50px 0px 50px 0px; */
    width: 400px;
    border: none;
    height: 420px!important;
    box-shadow: 0px 5px 20px 0px #d2dae3;
    z-index: 1;
    display: block;
    justify-content: center;
    align-items: center;
    background-color: white;
    text-align: center;
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
.validate {
    border-radius: 20px;
    height: 40px;
    background-color: red;
    border: 1px solid red;
    width: 340px;
}
.height-100{height:100vh}.card{width:400px;border:none;height:300px;box-shadow: 0px 5px 20px 0px #d2dae3;z-index:1;display:flex;justify-content:center;align-items:center}.card h6{color:red;font-size:20px}.inputs input{width:40px;height:40px}input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button{-webkit-appearance: none;-moz-appearance: none;appearance: none;margin: 0}.card-2{background-color:#fff;padding:10px;width:350px;height:100px;bottom:-50px;left:20px;position:absolute;border-radius:5px}.card-2 .content{margin-top:50px}.card-2 .content a{color:red}.form-control:focus{box-shadow:none;border:2px solid red}.validate{border-radius:20px;height:40px;background-color:red;border:1px solid red;width:240px}

    </style>
</head>
<body>
<?php
include('connect.php');
// to get the data from the url
$ifid = $_GET['profileid']; 
//filtering the user details based on the data fetched from the url
$sql = "SELECT * FROM `contacts` WHERE id='$ifid'";
$data = mysqli_query($conn, $sql);
while($drow = mysqli_fetch_array($data)) {
      $uid = $drow['id'];
      $phone_mobile = $drow['phone_mobile'];
      $phone_work = $drow['phone_work'];
     
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
if(isset($_POST['submit'])) {

  $method = $_POST['method'];
  $reason = $_POST['reason'];
    // create a random code and send it to next page to store in the database as well as send in email or by sms
    $pass= rand(100000, 999999); 
    
    

    // Insert otp record in database
    $ins = "INSERT INTO `otp_verification`(`otp_method`, `otp_code`, `user_id`, `status`, `created`) VALUES ('','$pass','$ifid','Active', now())";
    $insd = mysqli_query($conn, $ins);
    $last_id = $conn->insert_id;

    
    @session_start();
    $_SESSION["OTP"]=$pass;
    $_SESSION['USER']=$ifid;
    $_SESSION['INSERTED']=$last_id;
    $_SESSION['METHOD']=$method;
    $_SESSION['REASON']=$reason;

    header('Location: send_otp.php');

}
?>
<div class="container">
<div class="container height-100 d-flex justify-content-center align-items-center">
    <div class="Verification">
  <h6 style="color: red;">Verification Method</h6>
  <p>Choose a method between Email / SMS for the verification purpose.</p>
  <form action="" class="needs-validation" method="POST" novalidate>
    <div class="form-group">
      <label for="uname">Choose Method</label>
      <select name="method" class="form-control" required="required">
        <option value="">-- CHOOSE METHOD --</option>
        <option value="email">EMAIL (<?php echo $myemail; ?>)</option>
        <option value="mobile">MOBILE NO. (<?php echo $phone_mobile; ?>)</option>
        <option value="office">OFFICE PHONE (<?php echo $phone_work; ?>)</option>
      </select>
      <div class="valid-feedback">Valid.</div> 
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="uname">Reason <span style="color:red;">*</span></label>
      <textarea name="reason" class="form-control" placeholder="Specify the reason for OTP request..." required="required"></textarea>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group text-center">
    <input type="submit" name="submit" class="btn btn-danger px-4 validate" value="SEND OTP TO VERIFY">
  </div>
  </form>
</div>
</div>
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

</body>
</html>
