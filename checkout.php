<?php
include 'admin/db_connect.php';
// var_dump($_SESSION);
$chk = $conn->query("SELECT * FROM cart where user_id = {$_SESSION['login_user_id']} ")->num_rows;
if($chk <= 0){
    echo "<script>alert('You don\'t have an Item in your cart yet.'); location.replace('./')</script>";
}
?>
  <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end mb-4 page-title">
                    <h3 class="text-white">Checkout</h3>
                    <hr class="divider my-4" />

                </div>
                
            </div>
        </div>
    </header>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="" id="checkout-frm" name="myForm" onsubmit="return mpesaPay()">
                    <h4>Confirm</h4>
                    <div class="form-group">
                        
                        <input type="text" name="first_name" required="" class="form-control" value="<?php echo $_SESSION['login_first_name'] ?>">
                    </div>
                    <div class="form-group">
                       
                        <input type="text" name="last_name" required="" class="form-control" value="<?php echo $_SESSION['login_last_name'] ?>">
                    </div>
                    <div class="form-group">
                        
                        <input type="tel" name="mobile" required="" class="form-control" value="<?php echo $_SESSION['login_mobile'] ?>">
                    </div>
                   
                    <div class="form-group">
                        
                        <input type="email" name="email" required="" class="form-control" value="<?php echo $_SESSION['login_email'] ?>">
                    </div>  

                    <div class="text-center">
                        <button class="btn btn-block btn-outline-primary">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    
    function mpesaPay() {
      var mobile = document.forms["myForm"]["mobile"].value;
      if (!mobile.startsWith("254")) {
        alert("mobile must start with 2547...");
      }else if (mobile.length != 12) {
        alert("Enter a valid mobile number length");
      }else {
      window.location.href = 
window.location.href =  "https://the-bookhub.co.ke/projects/Herbal/api/mpesa.php?phone="+mobile+"&amount=1"+"&app=vaccine system";

        // alert("Wait for mPesa prompt and enter your pin")
      }
    }

  </script>

    <script>
    $(document).ready(function(){
          $('#checkout-frm').submit(function(e){
            e.preventDefault()
          
            start_load()
            $.ajax({
                url:"admin/ajax.php?action=save_order",
                method:'POST',
                data:$(this).serialize(),
                success:function(resp){
                    if(resp==1){
                        alert_toast("Order successfully Placed. Pick your Ordered Meal(s) from Cafeteria")
                        setTimeout(function(){
                            location.replace('index.php?page=home')
                        },2500)
                    }
                }
            })
        })
        })
    </script>

    
