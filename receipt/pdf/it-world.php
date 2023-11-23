<?php 

require('../../config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:../../login.php');
}

$id = $_GET['pdf_id'];
$sql= "SELECT * FROM order_receipt WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$company = $row['company'];
$transaction_id = $row['transaction_id'];
$b_name = $row['b_name'];
$b_email = $row['b_email'];
$b_phone = $row['b_phone'];
$b_address = $row['b_address'];
$s_name = $row['s_name'];
$s_email = $row['s_email']; 
$s_phone = $row['s_phone'];
$s_address = $row['s_address'];
$discount = $row['discount'];
$company_phone = $row['company_phone'];
$currency = $row['currency'];
$customer_id = $row['customer_id'];
$tax = $row['tax'];
$order_date = $row['order_date'];
$notes = $row['notes'];
$total_amount = $row['total_amount'];

//CALCULATION
$per_discount = ($discount / 100) * $total_amount;
$per_tax = ($tax / 100) * $total_amount;
$with_disconut = $total_amount - $per_discount;
$final_amount = $per_tax + $with_disconut;


$sqls= "SELECT * FROM items WHERE order_id=$id";
$results = mysqli_query($conn,$sqls);
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $company ?></title>
	<meta charset="utf-8" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>     
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap');
            body {
            background: #F1F5F7;
                background-image: none;
            background-image: url('../../images/striped-background.png');
            font-family: 'Poppins', sans-serif;
            }
            table {  
                font-family: arial, sans-serif;  
                border-collapse: collapse;  
                width: 100%;  
                font-family: 'Poppins', sans-serif;
            } 

            .paid{
                background: url(../images/paid.png);
                background-repeat: no-repeat;
                background-position: bottom right;
                background-size: contain;
            }
            
            .btn {
                border-radius: 50px;
            }
            
            tr{
                border: 0px solid #373737;  
            }
            td, th {  
                border: 1px solid #373737;  
                padding: 5px;
                border-collapse: collapse; 
                font-size: 14px;
                border-style: solid;
            }  
      
            /* tr:nth-child(even) {  
                background-color: #dddddd;  
            }  */
            h2{
               color: #0094ff;
            } 
            p{
                font-size: 14px;
            }
            .createPDF{
                font-size: 13px;
            }

            .page-size{ 
                max-width: 780px; 
                margin: auto;
                background-color: #fff;
                overflow: hidden;
            }

            .receipt .row{
                padding: 0px 40px 0px 25px;
            }

            li {
                margin-bottom: 15px;
                font-size: 14px;
            }

            .bar{
                height: 15px;
                width: 120%;
                background-color: #CC0000;
                margin-left: -10%;
            }
            .date-time-trans {
                /*text-align: center;*/
                font-size: 12px;
                font-weight: 600;
                color: #26467d;
                padding-bottom: 5px;
                border-bottom: 2px solid #BEBEBE; 
                width: fit-content;
                display: block;
                margin: auto;
                margin-right: 0;
                min-width: 155px;
                margin-bottom: 18px;
            }
            .company-details p {
                font-size: 13px;
                font-weight: 500;
                margin-bottom: 5px;
                color: #373F4F;
            }
            .billing-info .title {
                font-size: 17px;
                font-weight: 700;
                margin-top: 30px;
                border-bottom: 2px solid #bebebe;
                color: #244378;
            }
            .billing-info .detail {
                padding: 10px 0px;
            }

            .billing-info .detail p{
                font-size: 13px;
                font-weight: 500;
                margin-bottom: 5px;
                color: #43474f;
            }
            .billing-info .detail p span{
                font-weight: 600;
                color: #201818;
            }
            td {
                padding: 0px 5px;
                border: 0px;
                border-bottom: 2px solid #BEBEBE;
                border-right: 2px solid #BEBEBE;
                font-size: 12px;
                font-weight: 500;
            }
            td, th{
                height: 25px;
            }
            thead tr {
                background-color: #cc0000;
                color: #fff;
                border: 2px solid #cc0000;
               
            }
            thead tr th{
                border: 0px;
                font-weight: 500;
            }
            tr:nth-child(even) {
            background-color: #F3F3F3;
            border-left:2px solid rgb(182, 182, 182) ;
            }
            tbody {
                border-left: 2px solid #BEBEBE;
            }
            tbody tr:first-child td{
                border-top: 2px solid #BEBEBE;
            }
            .total-amount-detail p{ 
                font-size: 11px;
                font-weight: 600;
                color: #323F4F; 
                width: 100%;
            }
            .amount {
                text-align: center;
                font-size: 12px;
                border-bottom: 2px solid #BEBEBE;
                width: fit-content;
                display: block;
                margin: auto;
                margin-right: 0;
                min-width: 115px;
                min-height: 20px;
                padding: 2px 4px;
            }
            .amount span{
                font-weight: 600;
            }
            .total-amount-detail .d-flex:nth-child(3) {
                border-bottom: 2px solid #000;
            }
            .total-amount-detail .d-flex:nth-child(4) .title,.total-amount-detail .d-flex:nth-child(4) .amount {
                font-size: 16px;
            }
            .notes{
                font-size: 13px;
                font-weight: 500;
            }
        </style>

</head>
<body class="">
    <div class="text-center py-4 m-auto row g-2" style="max-width: 780px;">
    <div class="col-3 ps-0"><a href="/receipt/receipt-list" class="btn btn-dark m-auto w-100 fw-bold">Back </a></div>
    <div class="col-9 pe-0"><button class="btn btn-primary m-auto w-100 fw-bold" class="html2PdfConverter" onclick="createPDF()">Download Html to PDF </button></div></div>
    

    <div class="page-size">
        <div id="element-to-print">

            <div class="receipt position-relative" style="min-height:1122px;"> 
                <div class="bar"></div> 

                <div class="row" style="margin-top: 70px;">
                    <div class="col-7">
                        <div><img src="../images/it-world.png" class="me-0 mb-3" ></div>
                       
                        <div class="company-details pt-2">
                            <p>IT World</p>
                            <p>2nd Floor, College House, 17 King Edwards Rd,</p>
                            <p> Ruislip HA4 7AE, United Kingdom</p>
                            <p><?php echo $company_phone ?></p>
                            <p>billing@themicronit.com</p>
                        </div>
                        
                    </div>
                    <div class="col-5">
                        <h3 style="color: #7F7F7F;" class="mb-3 text-end">PAYMENT RECEIPT</h3>
                        <div class="date-time-trans">DATE: <?php echo $order_date ?></div>
                        <div class="date-time-trans">TRANSACTION ID: <?php echo $transaction_id ?> </div>
                        <div class="date-time-trans">CUSTOMER ID: <?php echo $customer_id ?> </div>
                    </div>


                    <div class="col-6 pe-4">
                        <div class="billing-info">
                            <div class="title"> BILLING INFORMATION </div>

                            <div class="detail">
                                <p><span>Name : </span><?php echo $b_name ?></p>
                                <p><span>Email : </span><?php echo $b_email ?></p>
                                <p><span>Phone : </span><?php echo $b_phone ?></p>
                                <p><span>Billing Address : </span><?php echo $b_address ?></p>
                            </div>

                        </div>
                    </div>

                    <div class="col-6 ps-4">
                        <div class="billing-info">
                            <div class="title"> SHIPPING INFORMATION </div>

                            <div class="detail">
                                <p><span>Name : </span><?php echo $s_name ?></p>
                                <p><span>Email : </span><?php echo $s_email ?></p>
                                <p><span>Phone : </span><?php echo $s_phone ?></p>
                                <p><span>Shipping Address : </span><?php echo $s_address ?></p>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">

                        <table class="my-4">
                            <thead>
                                <tr class="text-center">
                                    <th>SERVICE/SUBSCRIPTION NAME</th>
                                    <th>QUANTITY</th>
                                    <th>DURATION</th>
                                    <th>TOTAL</th>
                                </tr> 
                            </thead>
                            <tbody class="text-center">
                            <?php
                            if($results){
                                while($rows = mysqli_fetch_assoc($results)){
                                    // $counter+= 1;
                                    $name = $rows['name'];
                                    $coverage = $rows['coverage'];
                                    $duration = $rows['duration'];
                                    $total = $rows['total'];
                                    echo '<tr>
                                        <td class="text-start">'.$name.'</td>
                                        <td>'.$coverage.'</td>
                                        <td>'.$duration.'</td>
                                        <td>'.$total.'</td>
                                    </tr>';
                                }
                                
                            }
                            ?>
                                
                            </tbody>

                        </table>

                    </div>

                    <div class="col-8 paid d-flex  align-items-center">
                        <div class="notes">
                        <?php
                        if (empty($notes)) {
                            echo "<p class='m-0 text-white'><b>Note:</b>$notes</p>";
                          }
                          else{
                            echo "<p class='m-0'><b>Note : </b>$notes</p>";
                          }
                        ?> 
                        </div>
                    </div>
                    <div class="col-4">

                        <div class="total-amount-detail"> 
                            <div class="d-flex align-items-center mt-2">
                                <p class="title mb-0 text-end">SUBTOTAL (<?php echo $currency ?>)</p>  
                                <div class="amount"><?php echo $total_amount ?>.00</div>
                            </div> 

                            <div class="d-flex align-items-center mt-2">
                                <p class="title mb-0 text-end">DISCOUNT</p>  
                                <div class="amount"><?php echo $discount ?>%</div>
                            </div> 

                            <div class="d-flex align-items-center mt-2">
                                <p class="title mb-0 text-end">TAX RATE</p>  
                                <div class="amount border-0"><?php echo $tax ?>%</div>
                            </div> 

                            <div class="d-flex align-items-center mt-2">
                                <p class="title mb-0 text-end">Paid (<?php echo $currency ?>)</p>  
                                <div class="amount"> <?php echo $final_amount ?>.00 </div>
                            </div> 
                        </div>

                    </div>

                   
                </div>
                <div class="bar position-absolute bottom-0" style="margin-top: 20px;"></div> 

            </div>

        </div>
    <script>

        
        function createPDF() {
           var element = document.getElementById('element-to-print');
           html2pdf(element, {
               margin:0,
               padding:0,
               filename: '<?php echo $b_name ?>.pdf',
               image: { type: 'jpeg', quality: .5},
               html2canvas: { scale: 5,  logging: true },
               jsPDF: { unit: 'in', format: 'A4', orientation: 'P' },
               class: createPDF 
           });
       };  
   </script>


</body>
</html>