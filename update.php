<?php 

require('config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:login.php');
}

$id = $_GET['updateid'];
$sql= "SELECT * FROM docu_form WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$company_name = $row['company_name'];
$date = $row['date'];
$order_id = $row['order_id'];
$clientname = $row['clientname'];
$email = $row['email'];
$contact = $row['contact'];
$address = $row['address'];
$card = $row['card']; 
$expiration = $row['expiration'];
$currency = $row['currency'];
$amount = $row['amount'];
$plans = $row['plans'];
$services = unserialize($row['service']);
// $services = explode(",",$service);


if(isset($_POST['update'])){
    $company_name = $_POST['company_name'];
    $date = $_POST['date'];
    $order_id = $_POST['order_id'];
    $clientname = $_POST['clientname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $card = $_POST['card'];
    $expiration = $_POST['expiration'];
    $currency = $_POST['currency'];
    $amount = $_POST['amount'];
    $plans = $_POST['plans'];
    $service = serialize($_POST['service']);

    $sql= "UPDATE docu_form SET id=$id,company_name='$company_name',date='$date',order_id='$order_id',clientname='$clientname',email='$email',contact='$contact',address='$address',card='$card',expiration='$expiration',currency='$currency',amount='$amount',plans='$plans',service='$service' WHERE id=$id";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo 'Update Successfully';
        header('location:index.php');
    }
    else{
        echo 'error';
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
  
  </head>
  <body>
    
    <!-- header -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="images/logo.svg" alt="">
          </a>
          
            
            <span class="navbar-text">
            
            <?php
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
                {
                  echo"<span class='user-name me-3'>
                  Welcome <span>$_SESSION[username]</span>
                  </span>";
                }
              ?>

                <a href="logout.php" class="logout"> 
                  <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1233_22)">
                    <path d="M8 10H15M15 10L12 13M15 10L12 7" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 4V3C15 1.89543 14.1046 1 13 1H3C1.89543 1 1 1.89543 1 3V17C1 18.1046 1.89543 19 3 19H13C14.1046 19 15 18.1046 15 17V16" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_1233_22">
                    <rect width="16" height="20" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg>
                </a>

          </span>
       
        </div>
    </nav>


    <!-- main -->
    <div class="container">

      <div class="d-flex justify-content-between align-items-center py-5"> 
        <h3 class="title m-0 mt-2">Please Fill The Information</h3>
      </div>

      <div class="docu-form">
        <div class="container-fluid">
          <form method="POST" action="" name="docuform">
          <div class="row">
            
            <div class="col-md-8 docu-field-group ps-0">
             
              <div class="row gx-3 gy-2">
                <div class="col-md-4"> 
                  <select id="company" class="form-select" name="company_name" >
                    <option disabled >Select Company</option>
                    <option
                    <?php
                      if($company_name == 'Daphnis')
                      {
                        echo "selected";
                      }
                    ?>
                    >Daphnis</option>

                    <option
                    <?php
                      if($company_name == 'TroubleShooters')
                      {
                        echo "selected";
                      }
                    ?>
                    >TroubleShooters</option>
                    <option
                    <?php
                      if($company_name == 'RevLight')
                      {
                        echo "selected";
                      }
                    ?>
                    >RevLight</option>
                    <option
                    <?php
                      if($company_name == 'SmartNet Store')
                      {
                        echo "selected";
                      }
                    ?>
                    >SmartNet Store</option>
                    <option
                    <?php
                      if($company_name == 'AerosyncYard')
                      {
                        echo "selected";
                      }
                    ?>
                    >AerosyncYard</option>
                    <option
                    <?php
                      if($company_name == 'Analytiq IT Solutions Pvt Ltd')
                      {
                        echo "selected";
                      }
                    ?>
                    >Analytiq IT Solutions Pvt Ltd</option>
                    <option
                    <?php
                      if($company_name == 'BDA')
                      {
                        echo "selected";
                      }
                    ?>
                    >BDA</option>
                    <option
                    <?php
                      if($company_name == 'BITS n PIXELs')
                      {
                        echo "selected";
                      }
                    ?>
                    >BITS n PIXELs</option>
                    <option
                    <?php
                      if($company_name == 'Click2buy Mart LTD')
                      {
                        echo "selected";
                      }
                    ?>
                    >Click2buy Mart LTD</option>
                    <option
                    <?php
                      if($company_name == 'Faretel LLC')
                      {
                        echo "selected";
                      }
                    ?>
                    >Faretel LLC</option>
                    <option
                    <?php
                      if($company_name == 'FaretelTravels')
                      {
                        echo "selected";
                      }
                    ?>
                    >FaretelTravels</option>
                    <option
                    <?php
                      if($company_name == 'IT_World_Pro')
                      {
                        echo "selected";
                      }
                    ?>
                    >IT_World_Pro</option>
                    <option
                    <?php
                      if($company_name == 'Zenix')
                      {
                        echo "selected";
                      }
                    ?>
                    >Zenix</option>
                  </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group date" id="datepicker">
                      <input type="text" class="form-control" id="date" name="date"/>
                      <span class="input-group-append">
                        <span class="input-group-text bg-light d-block">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </span>
                    </div>
                </div>
                <div class="col-md-4">
                  <input type="text" name="order_id" class="form-control order_id" placeholder="Order ID" required value="<?php echo $order_id ?>">
                </div>

                <div class="col-md-4">
                  <input type="text" name="clientname" class="form-control" placeholder="Name" required value="<?php echo $clientname ?>">
                </div>

                <div class="col-md-4">
                  <input type="email" name="email" class="form-control" placeholder="Email" required value="<?php echo $email ?>">
                </div>

                <div class="col-md-4">
                  <input type="text" name="contact" class="form-control contact" placeholder="Contact No." required value="<?php echo $contact ?>">
                </div>

                <div class="col-md-12">
                  <input type="text" name="address" class="form-control" placeholder="Address" required value="<?php echo $address ?>">
                </div>

                <div class="col-md-4">
                  <input type="text" name="card" class="form-control" placeholder="Card Number/PayPal" required value="<?php echo $card ?>">
                </div>

                <div class="col-md-4">
                  <input type="text" name="expiration" class="form-control" placeholder="Card Expiration Date" required value="<?php echo $expiration ?>">
                </div>

                <div class="col-md-4">
                  <select id="company" class="form-select" name="currency">
                    <option
                    <?php
                      if($company_name == 'AUD')
                      {
                        echo "selected";
                      }
                    ?>
                    >AUD</option>
                    <option
                    <?php
                      if($company_name == 'GBP')
                      {
                        echo "selected";
                      }
                    ?>
                    >GBP</option>
                    <option
                    <?php
                      if($company_name == 'CAD')
                      {
                        echo "selected";
                      }
                    ?>
                    >CAD</option>
                    <option
                    <?php
                      if($company_name == 'EUR')
                      {
                        echo "selected";
                      }
                    ?>
                    >EUR</option>
                    <option
                    <?php
                      if($company_name == 'USD')
                      {
                        echo "selected";
                      }
                    ?>
                    >USD</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <input type="text" name="amount" class="form-control amount" placeholder="Amount" required value="<?php echo $amount ?>">
                </div>


                <div class="col-md-4">
                  <input type="text" name="plans" class="form-control plans" placeholder="Plans Category Auto select" required value="<?php echo $plans ?>">
                </div>

              </div>
              
            </div>

            <div class="col-md-4 ps-5" >
              
              <div class="checkbox-title d-flex justify-content-between">
                <span>Select Services*</span><span class="error-msg">Select Amount First*</span>
              </div>

              <div class="check-box-container">

                <div class="form-check" >
                  <input class="form-check-input" type="checkbox" value="IT Project Setup" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("IT Project Setup",$services))
                  {
                    echo "checked";
                  }
                  ?>>
                  <label class="form-check-label" for="flexCheckDefault">
                    IT Project Setup
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Web Development Setup" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Web Development Setup",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Web Development Setup
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="SSL and Website Protection Setup" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("SSL and Website Protection Setup",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    SSL and Website Protection Setup
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Active Directory Configuration" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Active Directory Configuration",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Active Directory Configuration
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="PBX Switch/Dailer Server Installation" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("PBX Switch/Dailer Server Installation",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    PBX Switch/Dailer Server Installation
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Local Server Firewall Setup" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Local Server Firewall Setup",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Local Server Firewall Setup
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Remote Server Installation" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Remote Server Installation",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Remote Server Installation
                  </label> </br>
 
                  <input class="form-check-input" type="checkbox" value="Content Management" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Content Management",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Content Management
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Shopping Cart/Payment Gateway Integration" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Shopping Cart/Payment Gateway Integration",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Shopping Cart/Payment Gateway Integration
                  </label> </br>
    
                  <input class="form-check-input" type="checkbox" value="Business Directory Listing" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Business Directory Listing",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Business Directory Listing
                  </label> </br>
 
                  <input class="form-check-input" type="checkbox" value="Portfolio Showcase" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Portfolio Showcase",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Portfolio Showcase
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Web Application / Business Software" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Web Application / Business Software",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Web Application / Business Software
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Mobile-optimized Website" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Mobile-optimized Website",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Mobile-optimized Website
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Learning Management System (LMS)" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Learning Management System (LMS)",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Learning Management System (LMS)
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Customer Relationship Management (CRM) Integration" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Customer Relationship Management (CRM) Integration",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Customer Relationship Management (CRM) Integration
                  </label> </br>
 
                  <input class="form-check-input" type="checkbox" value="User Interface (UI) Design" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("User Interface (UI) Design",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    User Interface (UI) Design
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="User Experience (UX) Design" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("User Experience (UX) Design",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    User Experience (UX) Design
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Learning Management System (LMS)" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Learning Management System (LMS)",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Learning Management System (LMS)
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Mobile App Marketing Model Consultation" id="flexCheckDefault" name="service[]"
                  <?php
                  if(in_array("Mobile App Marketing Model Consultation",$services))
                  {
                    echo "checked";
                  }
                  ?>
                  >
                  <label class="form-check-label" for="flexCheckDefault">
                    Mobile App Marketing Model Consultation</label>
                </div>


              </div>


            </div>

            <div class="col-12 ps-0 pt-5">
              
              <div class="d-flex justify-content-between">

                <a href="index.php" class="btn backbutton">Cancel</a>
                <button type="submit" class="btn submitbutton" name="update">Update</button>

              </div>

            </div>

          </form>
          </div>
        </div>
      </div>

    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


    <script>
      $(function(){
        $('#datepicker').datepicker({ format: 'dd-mm-yyyy' });
      });

    </script>

    <script>
      // Get the current date
      var currentDate = new Date();
      
      // Format the date as YYYY-MM-DD
      var year = currentDate.getFullYear();
      var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
      var day = ('0' + currentDate.getDate()).slice(-2);
      var formattedDate = day + '-' + month + '-' + year;
      
      // Set the formatted date as the value of the date input
      document.getElementById('date').value = formattedDate;
    </script>


    <script>
      $('.amount').on('keyup', function() {

        const amount = $(this).val();
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;


        if(intRegex.test(amount) != true || floatRegex.test(amount)!= true) {
          const filterval = amount.replace(/[^0-9\.]/g,'');
          $('.amount').val(filterval);
        }

        if(amount <= 0 || amount == "null"){
          $('.plans').val("");
          $('.error-msg').html("Select Amount First*");
        }
        else if(amount <= 200)
        {
          $('.plans').val("Bronze");
          $('.error-msg').html("Max Select 1*");
        }
        else if(amount <= 400) {
          $('.plans').val("Silver");
          $('.error-msg').html("Max Select 2*");
        }
        else if(amount <= 700){
          $('.plans').val("Gold");
          $('.error-msg').html("Max Select 3*");
        }
        else{
          $('.plans').val("Platinum");
          $('.error-msg').html("Minimum 4 or more*");
        }

      });
    </script>

    <script>
       $('.order_id').on('keyup', function() {

        const order_number = $(this).val();
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;


        if(intRegex.test(order_number) != true || floatRegex.test(order_number)!= true) {
          const filterval = order_number.replace(/[^0-9\.]/g,'');
          $('.order_id').val(filterval);
        }
        });

        
        
        $('.contact').on('keyup', function() {

        const ph_number = $(this).val();
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;


        if(intRegex.test(ph_number) != true || floatRegex.test(ph_number)!= true) {
          const filterval = ph_number.replace(/[^0-9\.]/g,'');
          $('.contact').val(filterval);
        }
        });

    </script>





  <script type="text/javascript"> 

    
   
    $('input.form-check-input').on('change', function(evt) {
      
      var plan_name = $('.plans').val();
      console.log(plan_name);

      if(plan_name == "Bronze"){
        var limit = 1;
      }
      else if(plan_name == "Silver")
      {
        var limit = 2;
      }
      else if(plan_name == "Gold")
      {
        var limit = 3;
      }
      else if(plan_name == "Platinum")
      {
        var limit = 30;
      }
      else{
        var limit = 0
      }

      if($(this).siblings(':checked').length >= limit) {
          this.checked = false;
      }
    });
  </script>


  </body>
</html>