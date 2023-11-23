<?php 

require('../config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:../login.php');
}

$user = $_SESSION['username'];
$u_query = mysqli_query($conn,"SELECT * FROM registered_users WHERE username = '$user'");
$row = mysqli_fetch_array($u_query);
$id = $row['id'];

include 'invoice.php';
$invoice = new Invoice();
if(!empty($_POST['company']) && $_POST['company']) {	
	$invoice->saveInvoice($_POST);
	header("Location:/invoice/invoice-list.php");
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
    <link rel="stylesheet" href="../css/receipt.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    
    <!-- header -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="../images/logo.svg" alt="">
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

                <a href="../logout.php" class="logout"> 
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
    <div class="container pb-5">

      <div class="d-flex justify-content-between align-items-center py-5"> 
        <h3 class="title m-0 mt-2">Invoice Form</h3>
      </div>

      <div class="docu-form">
        <div class="container-fluid">
          <form action="" method="post" name="docuform" id="re-form">
          <div class="row">
            <input type="hidden" class="form-control" value="<?php echo $id?>" name="user_id"/>
            <input type="hidden" class="form-control" value="<?php echo "$_SESSION[username]"?>" name="user_name"/>
            <!-- company info -->
            <div class="col-md-6 docu-field-group ps-0 pe-2">
              <div class="bordered" id="billing-form">
                <div class="checkbox-title d-flex justify-content-between px-2 pb-4"> 
                  <span>Company Information*</span>  
                </div>
                <div class="row gx-3 gy-2">
                  <div class="col-6"> 
                    <select id="company" class="form-select" name="company" required>
                      <option disabled selected hidden value="">Select Company</option>
                      <option>Micron IT</option>
                      <option>IT World</option> 
                    </select>
                  </div>
                  <div class="col-6">
                    <input type="text" name="transaction_id" class="form-control order_id" placeholder="Transaction ID" required>
                  </div>
                  <div class="col-6">
                      <div class="input-group date" id="datepicker">
                        <input type="text" class="form-control" id="date" name="date"  placeholder="Date">
                        <span class="input-group-append">
                          <span class="input-group-text bg-light d-block">
                            <i class="fa fa-calendar"></i>
                          </span>
                        </span>
                      </div>
                  </div>
                  <div class="col-6">
                    <div class="input-group date" id="datepicker-due-date">
                      <input type="text" class="form-control" id="date" name="due_date" placeholder="Due Date">
                      <span class="input-group-append">
                        <span class="input-group-text bg-light d-block">
                          <i class="fa fa-calendar"></i>
                        </span>
                      </span>
                    </div>
                  </div>
                
                
                </div>
              </div>
            </div>

            <!-- Billing info --> 
            <div class="col-lg-6 docu-field-group ps-0 ps-2 pe-0">
             
                <div class="bordered" id="billing-form">
                      <div class="checkbox-title d-flex justify-content-between px-2 pb-4"> 
                        <span>Billing Information*</span>  
                      </div>
                    <div class="row gx-3 gy-2">    
                        <div class="col-md-6">
                            <input type="text" name="b_name" class="form-control" placeholder="Name" required id="billing-name">
                        </div>
        
                        <div class="col-md-6">
                            <input type="email" name="b_email" class="form-control" placeholder="Email" required  id="billing-email">
                        </div> 

                        <div class="col-md-12">
                            <input type="text" name="b_address" class="form-control" placeholder="Billing Address:" required id="billing-address">
                        </div>
                    </div>
                </div>  
                
            </div> 

            <div class="receipt-container docu-field-group">
              <table class="_table">
                <thead>
                  <tr> 
                    <th>ITEM NAME</th>
                    <th>ITEM Services</th>
                    <th class="mw-12">QUANTITY</th>
                    <th class="mw-12">Rate</th>
                    <th class="mw-12">AMOUNT</th>
                    <th width="50px">
                      <div class="action_container">
                        <button class="success" onclick="create_tr('table_body')">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </th>
                  </tr>
                </thead>
                <tbody id="table_body">
                  <tr>
                    <td style="max-width: 150px;">
                      <input type="text" name="name[]" class="form-control mb-0" placeholder="Xyz">
                    </td>
                    <td>
                      <input type="text" name="services[]" class="form-control mb-0" placeholder="Services separate with comma (,)"  data-bs-toggle="tooltip" data-bs-placement="bottom" title=" 
                      Example : Cloud Server, Software Opt, Network Firewall">
                    </td>
                    <td class="mw-12">
                      <input type="text" name="quantity[]" class="form-control mb-0" placeholder="Quantity">
                    </td>
                    <td class="mw-12">
                      <input type="text" name="rate[]" class="form-control mb-0" placeholder="Price">
                    </td>
                    <td class="mw-12">
                      <input type="text" name="amount[]" class="form-control mb-0 amount" placeholder="Total">
                      <input type="hidden" id="total_amount" name="total_amount" class="form-control">
                    </td>
                    <td>
                      <div class="action_container">
                        <button class="danger" onclick="remove_tr(this)">
                          <i class="fa fa-close"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <div class="col-lg-2 docu-field-group ps-0 pe-2" style="margin-top: 25px;">
              <div class="bordered">
                <div class="checkbox-title d-flex justify-content-between px-2 pb-4"> 
                  <span>Currency*</span> 
                </div>
                <select id="company" class="form-select px-2 currency-change" name="currency" required>
                    <option disabled selected hidden value="">Currency</option> 
                    <option>US$</option> 
                    <option>CAD$</option>
                    <option>A$</option>
                    <option>EUR €</option>  
                    <option>GBP£</option>  
                </select>
              </div> 
            </div>
 

            <div class="col-md-5 docu-field-group ps-2 pe-2" style="margin-top: 25px;">
              <div class="bordered" id="billing-form">
                <div class="checkbox-title d-flex justify-content-between px-2 pb-4"> 
                  <span>Notice</span>  
                </div>
                <div class="row gx-3 gy-2">
                  <div class="col-12"> 
                    <input type="text" name="notice" class="form-control" placeholder="Message" required="" id="shipping-address">
                  </div>  
                </div>
              </div>
            </div>
            <div class="col-md-5 docu-field-group ps-2 pe-0" style="margin-top: 25px;">
              <div class="bordered" id="billing-form">
                <div class="checkbox-title d-flex justify-content-between px-2 pb-4"> 
                  <span>Payment Link:</span>  
                </div>
                <div class="row gx-3 gy-2"> 
                  <div class="col-12">
                    <input type="text" name="payment_link" class="form-control" placeholder="Payment Link:" required="" id="shipping-address">
                  </div> 
                </div>
              </div>
            </div>
            <div class="col-12 px-0 pt-4">
              
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

    <script type="text/javascript">
      $(function(){

        var total_amount = function(){
          var sum=0;
          $('.amount').each(function(){
            var num = $(this).val().replace(',','');

            if(num != 0){
              sum += parseFloat(num);
            }
          });
          $('#total_amount').val(sum);
        }

        $('.amount').keyup(function(){
          total_amount();
        });
      });
    </script>

    <script>
        // tooltip code
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <!-- Auto Fill Address -->
    <script>
      $(document).ready(function(){
          $('input[type="checkbox"]').click(function(){
              if($(this).prop("checked") == true){
                $('#shipping-name').val($('#billing-name').val());
                  $('#shipping-email').val($('#billing-email').val());
                  $('#shipping-phone').val($('#billing-phone').val());
                  $('#shipping-address').val($('#billing-address').val());
              }
              else if($(this).prop("checked") == false){
                $('#shipping-name').val("");
                  $('#shipping-email').val("");
                  $('#shipping-phone').val("");
                  $('#shipping-address').val("");
              }
          });
      });


      $("#billing-name,#billing-email,#billing-phone,#billing-address").keyup(function(){ 
              if($('input[type="checkbox"]').prop("checked") == true){ 
                  $('#shipping-name').val($('#billing-name').val());
                  $('#shipping-email').val($('#billing-email').val());
                  $('#shipping-phone').val($('#billing-phone').val());
                  $('#shipping-address').val($('#billing-address').val());
                }
      });


    </script>

    <!-- add or delete Row -->
    <script>
      function create_tr(table_id) {
    let table_body = document.getElementById(table_id),
        first_tr   = table_body.firstElementChild
        tr_clone   = first_tr.cloneNode(true);

    table_body.append(tr_clone);

    clean_first_tr(table_body.firstElementChild);
    }

    function clean_first_tr(firstTr) {
        let children = firstTr.children;
        
        children = Array.isArray(children) ? children : Object.values(children);
        children.forEach(x=>{
            if(x !== firstTr.lastElementChild)
            {
                x.firstElementChild.value = '';
            }
        });
    }



    function remove_tr(This) {
        if(This.closest('tbody').childElementCount == 1)
        {
            alert("You Don't have Permission to Delete This ?");
        }else{
            This.closest('tr').remove();
        }
    }
    </script> 

 

    <script>
      $(function(){
        $('#datepicker,#datepicker-due-date').datepicker({ format: 'mm-dd-yyyy' });
      });

    </script>

    <script>
      // Get the current date
      var currentDate = new Date();
      
      // Format the date as YYYY-MM-DD
      var year = currentDate.getFullYear();
      var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
      var day = ('0' + currentDate.getDate()).slice(-2);
      var formattedDate = month + '-' + day + '-' + year;
      
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

        $('.phone').on('keyup', function() {

        const ph_number = $(this).val();
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;


        if(intRegex.test(ph_number) != true || floatRegex.test(ph_number)!= true) {
          const filterval = ph_number.replace(/[^0-9\.]/g,'');
          $('.phone').val(filterval);
        }
        });

        
        $('.company-contact').on('keyup', function() { 
        const ph_number = $(this).val();
        var intRegex = /^\d+$/;
        var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/; 
        if(intRegex.test(ph_number) != true || floatRegex.test(ph_number)!= true) {
          const filterval = ph_number.replace(/[^0-9\.]/g,'');
          $('.company-contact').val(filterval);
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