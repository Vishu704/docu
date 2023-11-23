<?php 

require('../../config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:../../login.php');
}

$id = $_GET['pdf_id'];
$sql= "SELECT * FROM order_invoice WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$company = $row['company'];
$transaction_id = $row['transaction_id'];
$b_name = $row['b_name'];
$b_email = $row['b_email'];
$b_address = $row['b_address'];
$date = $row['date'];
$due_date = $row['due_date'];
$notice = $row['notice'];
$payment_link = $row['payment_link'];
$currency = $row['currency'];
$total_amount = $row['total_amount'];


$sqls= "SELECT * FROM invoice_items WHERE order_id=$id";
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
            background-image: url('../images/striped-background.png');
            font-family: 'Poppins', sans-serif;
            }
            table {  
                font-family: arial, sans-serif;  
                border-collapse: collapse;  
                width: 100%;  
                font-family: 'Poppins', sans-serif;
            }  
             
            td, th {   
                padding: 15px 15px 0px 15px;
                border-collapse: collapse; 
                font-size: 14px;
                border-style: solid;
            }  

            td h6 {
                    font-size: 14px;
                    font-weight: 600;
                    margin-bottom: 4px;
                }
            tr th{
                background: #43474f;
                font-weight: 600;
                color: #fff;
                padding: 10px;
            }
           tr th:first-child {
                background: #43474f;
                border-radius: 5px 0px 0px 5px;
            }
            tr th:last-child {
                background: #43474f;
                border-radius: 0px 5px 5px 0px;
            }

            ul li {
                font-size: 12px;
                font-weight: 500;
                color: #777777;
                line-height: 12px;
                margin-bottom: 4px;
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
                min-height:1122px;
                margin: auto;
                background-color: #fff;
                overflow: hidden;
            }

            .invoice .row{
                padding: 0px 40px 0px 25px;
            }
 
            .company-details p {
                font-size: 13px;
                font-weight: 500;
                margin-bottom: 5px;
                color: #373F4F;
                max-width: 240px;
                line-height: 17px;
            }
            .company-details p a{
                text-decoration: underline;
                color:#0d72fd;;
            }
            .billing-info .title {
                font-size: 14px;
                font-weight: 500;
                margin-top: 30px;
                color: #8d9095;
            }
            .billing-info .detail p{
                font-size: 13px;
                font-weight: 500;
                margin-bottom: 0px;
                color: #43474f;
            }
            .billing-info .detail p span{
                font-weight: 600;
                color: #201818;
            } 
            .date-time-trans{
                display: flex;
                justify-content: space-between;
                font-size: 13px;
                font-weight: 500;
                margin-bottom: 5px;
                color: #707783;
            }
            .balance{
                padding: 2px 8px;
                background-color: #43474f;
                color: #fff;
                font-size: 16px;
                font-weight: 500;
                border-radius: 5px;
                margin-top: 20px;
            }
            p.title {
                font-size: 16px;
                font-weight: 600;
            }
            /* .notes {
                margin-top: 100px;
            } */
            .notes p,.notes a,.notes span{
                font-size: 13px;
                margin: 0px;
                font-weight: 500;
            }
            
            .notes span{
                color: #777777;
            }

            
        </style>

</head>
<body class="">
    <div class="text-center py-4 m-auto row g-2" style="max-width: 780px;">
    <div class="col-3 ps-0"><a href="/invoice/invoice-list" class="btn btn-dark m-auto w-100 fw-bold">Back </a></div>
    <div class="col-9 pe-0"><button class="btn btn-primary m-auto w-100 fw-bold" class="html2PdfConverter" onclick="createPDF()">Download Html to PDF </button></div></div>
    

    <div class="page-size">
        <div id="element-to-print">

            <div class="invoice position-relative"> 
                <div class="bar"></div> 

                <div class="row" style="margin-top: 70px;">
                    <div class="col-8">
                        <div><img src="../images/it-world.png" class="me-0 mb-3"></div>

                        <div class="company-details pt-2">
                            <p>IT World</p>
                            <p>Address : 2nd Floor, College House, 17 King Edwards Road, Ruislip, London</p> 
                            <p>Website : <a href="https://itworldpro.net/">www.itworldpro.net</a></p>
                            <p>Email : <a href="mailto:info@itworldpro.net">info@itworldpro.net</a></p>

                        </div>
                        
                    </div>
                    <div class="col-4">
                        <h1 style="color: #494949;" class="mb-0 text-end">INVOICE</h1>
                        <div style=" color: #707783;" class="transaction-id  mb-3 text-end"># <?php echo $transaction_id ?></div>
                        <div class="date-time-trans"><span>DATE : </span> <span><?php echo $date ?></span></div>
                        <div class="date-time-trans"><span>DUE DATE : </span> <span><?php echo $due_date ?></span></div>
                        <div class="date-time-trans balance"><span>BALANCE DUE : </span> <span><?php echo $currency ?> <?php echo $total_amount ?></span></div>
                    </div>


                    <div class="col-4">
                        <div class="billing-info">
                            <div class="title"> Bill To: </div>

                            <div class="detail"> 
                                <p class="fw-bold"><?php echo $b_name ?></p>
                                <p><?php echo $b_address ?></p>
                                <p><a href="mailto:<?php echo $b_email ?>"><?php echo $b_email ?></a></p>
                            </div>

                        </div>
                    </div>

                    <div class="col-12">

                        <table class="my-4">
                            <thead>
                                <tr class="text-center">
                                    <th>Items</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr> 
                            </thead>
                            <tbody class="text-center">
                            <?php
                                if($results){
                                    while($rows = mysqli_fetch_assoc($results)){
                                        // $counter+= 1;
                                        $name = $rows['name'];
                                        $quantity = $rows['quantity'];
                                        $rate = $rows['rate'];
                                        $amount = $rows['amount'];
                                        $service = $rows['services'];
                                        echo '<tr>
                                            <td class="text-start">
                                                <h6>'.$name.'</h6>
                                                <ul class="mb-0">
                                                    <li>'.$output = str_replace(',', '<br /><li>', $service).'</li>
                                                </ul>
                                            </td>
                                            <td>'.$quantity.'</td>
                                            <td>'.$rate.'</td>
                                            <td>'.$amount.'</td>
                                        </tr>';
                                    }
                                    
                                }
                            ?>
                            </tbody>

                        </table>

                    </div>

                    
                    <div class="col-4 offset-8"> 
                        <div class="total-amount-detail pe-4"> 
                            <div class="d-flex align-items-center mt-2 justify-content-between">
                                <p class="title mb-0 text-end">TOTAL</p>  
                                <div class="amount"><?php echo $currency ?> <?php echo $total_amount ?></div>
                            </div>  
                        </div> 
                    </div>

                    <div class="col-8 d-flex  align-items-center paid">
                        <div class="notes">
                            <p>Notes:</p>
                            <span><?php echo $notice ?></span>
                            <p class="mt-3">Payment Link:</p>
                            <a href="<?php echo $payment_link ?>"><?php echo $payment_link ?></a>
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
               filename: 'micronit.pdf',
               image: { type: 'jpeg', quality: .5},
               html2canvas: { scale: 5,  logging: true },
               jsPDF: { unit: 'in', format: 'A4', orientation: 'P' },
               class: createPDF 
           });
       };  
   </script>


</body>
</html>


<?php
    if($results){
        while($rows = mysqli_fetch_assoc($results)){
            // $counter+= 1;
            $name = $rows['name'];
            $coverage = $rows['quantity'];
            $duration = $rows['rate'];
            $total = $rows['amount'];
            $service = $rows['services'];
            echo '<tr>
                <td class="text-start">'.$name.'</td>
                <td>'.$coverage.'</td>
                <td>'.$duration.'</td>
                <td>'.$total.'</td>
                <td>'.$output = str_replace(',', '<br />', $service).'</td>
            </tr>';
        }
        
    }
?>