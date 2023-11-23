<?php 

require('config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:login.php');
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
          <form method="POST" action="form.php" name="docuform">
          <div class="row">
            
            <div class="col-md-8 docu-field-group ps-0">
             
              <div class="row gx-3 gy-2">
                <div class="col-md-4"> 
                  <select id="company" class="form-select" name="company_name">
                    <option disabled selected>Select Company</option>
                    <option>Novitek</option>
                    <option>Daphnis</option>
                    <option>TroubleShooters</option>
                    <option>RevLight</option>
                    <option>SmartNet Store</option>
                    <option>AerosyncYard</option>
                    <option>Analytiq IT Solutions Pvt Ltd</option>
                    <option>BDA</option>
                    <option>BITS n PIXELs</option>
                    <option>Click2buy Mart LTD</option>
                    <option>Faretel LLC</option>
                    <option>FaretelTravels</option>
                    <option>IT_World_Pro</option>
                    <option>Zenix</option>
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
                  <input type="text" name="order_id" class="form-control order_id" placeholder="Order ID" required>
                </div>
                <div class="col-md-4" style="display:none;">
                  <input type="hidden" name="user_name" class="form-control" placeholder="Username">
                </div>

                <div class="col-md-4">
                  <input type="text" name="clientname" class="form-control" placeholder="Name" required style="text-transform: capitalize;">
                </div>

                <div class="col-md-4">
                  <input type="email" name="email" class="form-control" placeholder="Email" required >
                </div>

                <div class="col-md-4">
                  <input type="text" name="contact" class="form-control" placeholder="Contact No." required>
                </div>

                <div class="col-md-12">
                  <input type="text" name="address" class="form-control" placeholder="Address" required style="text-transform: capitalize;">
                </div>

                <div class="col-md-4">
                  <input type="text" name="card" class="form-control" placeholder="Card Number/PayPal" required>
                </div>

                <div class="col-md-4">
                  <input type="text" name="expiration" class="form-control" placeholder="Card Expiration Date" required>
                </div>

                <div class="col-md-4">
                  <select id="company" class="form-select" name="currency" required>
                    <option disabled selected>Select Currency</option>
                    <option>AUD</option>
                    <option>GBP</option>
                    <option>CAD</option>
                    <option>EUR</option>
                    <option>USD</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <input type="text" name="amount" class="form-control amount" placeholder="Amount" required>
                </div>


                <div class="col-md-4">
                  <select class="form-select plans" name="plans" required>
                    <option disabled selected>Plans Category Auto select</option>
                    <option>Bronze</option>
                    <option>Silver</option>
                    <option>Gold</option>
                    <option>Platinum</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <input type="text" name="comments" class="form-control comments" placeholder="comment">
                </div>

              </div>
              
            </div>

            <div class="col-md-4 ps-5" >
              
              <div class="checkbox-title d-flex justify-content-between">
                <span>Select Services*</span><span class="error-msg">Select Plan First*</span>
              </div>

              <div class="check-box-container">

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="IT Project Setup" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    IT Project Setup
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Web Development Setup" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Web Development Setup
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="SSL and Website Protection Setup" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    SSL and Website Protection Setup
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Active Directory Configuration" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Active Directory Configuration
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="PBX Switch/Dailer Server Installation" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    PBX Switch/Dailer Server Installation
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Local Server Firewall Setup" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Local Server Firewall Setup
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Remote Server Installation" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Remote Server Installation
                  </label> </br>
 
                  <input class="form-check-input" type="checkbox" value="Content Management" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Content Management
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Shopping Cart/Payment Gateway Integration" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Shopping Cart/Payment Gateway Integration
                  </label> </br>
    

                  <input class="form-check-input" type="checkbox" value="Business Directory Listing" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Business Directory Listing
                  </label> </br>
 
                  <input class="form-check-input" type="checkbox" value="Portfolio Showcase" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Portfolio Showcase
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Web Application / Business Software" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Web Application / Business Software
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Mobile-optimized Website" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Mobile-optimized Website
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Learning Management System (LMS)" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Learning Management System (LMS)
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Customer Relationship Management (CRM) Integration" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Customer Relationship Management (CRM) Integration
                  </label> </br>
 
                  <input class="form-check-input" type="checkbox" value="User Interface (UI) Design" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    User Interface (UI) Design
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="User Experience (UX) Design" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    User Experience (UX) Design
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Learning Management System (LMS)" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Learning Management System (LMS)
                  </label> </br>

                  <input class="form-check-input" type="checkbox" value="Mobile App Marketing Model Consultation" id="flexCheckDefault" name="service[]">
                  <label class="form-check-label" for="flexCheckDefault">
                    Mobile App Marketing Model Consultation                  </label>
                </div>


              </div>


            </div>

            <div class="col-12 ps-0 pt-5">
              
              <div class="d-flex justify-content-between">

                <a href="index.php" class="btn backbutton">Cancel</a>
                <button type="submit" class="btn submitbutton" name="submit">Submit</button>

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
        }
        else if(amount <= 200)
        {
          $('.plans').val("Bronze").trigger('change');
        }
        else if(amount <= 400) {
          $('.plans').val("Silver").trigger('change');
        }
        else if(amount <= 700){
          $('.plans').val("Gold").trigger('change');
        }
        else{
          $('.plans').val("Platinum").trigger('change');
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

    $('.form-select.plans').on('change', function(evt) {

      var plan_name = $('.plans').val();
      console.log(plan_name);

      var limit = 0;

      if(plan_name == "Bronze"){
        $('.error-msg').html("Max Select 1*");
      }
      else if(plan_name == "Silver")
      {
        $('.error-msg').html("Max Select 2*");
      }
      else if(plan_name == "Gold")
      {
        $('.error-msg').html("Max Select 3*");
      }
      else if(plan_name == "Platinum")
      {
        $('.error-msg').html("Minimum 4 or more*");
      }
      else{
        $('.error-msg').html("Select Plan First*");
      }

    });


    $('input.form-check-input').on('change', function(evt) {
      
      var plan_name = $('.plans').val();
      console.log(plan_name);

      var limit = 0;

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
        var limit = 0;
      }

      if($(this).siblings(':checked').length >= limit) {
          this.checked = false;
      }
    });

  </script>


  </body>
</html>