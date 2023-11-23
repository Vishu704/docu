
<?php 

require('config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:login.php');
}

$user = $_SESSION['username'];

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Docu Generater</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
 
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
                
                <a href="/logout" class="logout"> 
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
    <div class="container btns"> 


      <div class="grid-wrapper grid-col-auto">

        <!-- <a href="/docu-list"> -->
            <label for="radio-card-1" class="radio-card">
            <input type="radio" name="radio-card" id="radio-card-1" />
            <div class="card-content-wrapper">
                <span class="check-icon"></span>
                <div class="card-content">
                <img
                    src="images/doc.png"
                    alt=""
                />
                <a href="/docu-list"><h4>Docu Generator</h4> </a>
                </div>
            </div>
            </label> 
        <!-- </a> -->

        <!-- <a href="/receipt/receipt-list"> -->
            <label for="radio-card-2" class="radio-card">
            <input type="radio" name="radio-card" id="radio-card-2" />
            <div class="card-content-wrapper">
                <span class="check-icon"></span>
                <div class="card-content">
                <img
                    src="images/receipt.png"
                    alt=""
                />
                <a href="/receipt/receipt-list"><h4>Receipt Generator</h4></a>
                </div>
            </div>
            </label> 
        <!-- </a> -->

    </div> 


    </div>
    <!-- /.container -->

    
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
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
