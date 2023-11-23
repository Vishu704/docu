<?php 

require('../config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:login.php');
}

$id = $_GET['pdfid'];
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
// $services = unserialize(",",$service);
$comments = $row['comments'];

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $company_name ?></title>
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
            
            .btn {
    border-radius: 50px;
}
            table {  
                font-family: arial, sans-serif;  
                border-collapse: collapse;  
                width: 100%;  
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
                padding: 45px 18px 0px 25px;
                margin: auto;
                background-color: #fff;
            }

            #element-to-print{
                border-right: 10px solid #ffffff;
            }
            .border{
                border: 5px solid #000000 !important;
                border-bottom: 0px !important;
                padding: 30px;
                padding-bottom: 0px;
            }
            .daphnislogo{
                margin-bottom: 50px;
            }
            .center-title{
                text-align: center; font-size: 22px;
            }
            .d-footer-1{
                margin-top: 40px;
            }
            .d-2 p{
                font-size: 14px;
                margin-bottom:10px;
            }

            .info-container{
                border: 1px solid #000;
                padding: 7px;
            }
            .price-table th, .price-table td{
                height: 38px;
            }

            .bottom-bordered{
                border-bottom: 5px solid #000 !important;
            }
            li {
                margin-bottom: 15px;
                font-size: 14px;
            }
        </style>

</head>
<body class="">
    <div class="text-center py-4 m-auto row g-2" style="max-width: 780px;">
    <div class="col-3 ps-0"><a href="/" class="btn btn-dark m-auto w-100 fw-bold">Back </a></div>
    <div class="col-9 pe-0"><button class="btn btn-primary m-auto w-100 fw-bold" class="html2PdfConverter" onclick="createPDF()">Download Html to PDF </button></div></div>
    

    <div class="page-size">
        <div id="element-to-print">

            <div class="border"  style="height:1046px;">
            <!-- Sample Table -->


                <img src="../images/aerosoync.png" alt="" class="daphnislogo" style="max-width: 230px; "> 
                <h3  class="center-title">Credit Card Authorization Form</h3>  <br>
                
                <div class="row">
                    <div class="col-12">
                        <table>  
                            <tbody class="text-center"> 
                                <tr>  
                                    <th class="w-50 border-end-0 border-bottom-0">Date:</th>  
                                    <td class="border-bottom-0"><?php echo $date ?></td>  
                                </tr>  
                                <tr>  
                                    <th class="border-end-0 border-bottom-0">Cardholder's Name (as shown on Account):</th>  
                                    <td class="border-bottom-0"><?php echo $clientname ?></td>  
                                </tr>  
                                <tr>  
                                    <th class="border-end-0 border-bottom-0">Card Billing Address:</th>  
                                    <td class="border-bottom-0"><?php echo $address ?></td> 
                                </tr>  
                                <tr>  
                                    <th class="border-end-0 border-bottom-0">Card Number:</th>  
                                    <td class="border-bottom-0"><?php echo $card ?></td>  
                                </tr>  
                                <tr>  
                                    <th class="border-end-0 border-bottom-0">Card Expiration Date:</th>  
                                    <td class="border-bottom-0"><?php echo $expiration ?></td> 
                                </tr>  
                                <tr>  
                                    <th class="border-end-0 border-bottom-0">Email:</th>  
                                    <td class="border-bottom-0"><?php echo $email ?></td> 
                                </tr> 
                                <tr>  
                                    <th class="border-end-0 border-bottom-0">Amount:</th>  
                                    <td class="border-bottom-0"><?php echo $currency ?> <?php echo $amount ?></td> 
                                </tr> 
                                <tr>  
                                    <th class="border-end-0">Order ID:</th>  
                                    <td><?php echo $order_id ?></td> 
                                </tr>  
                            </tbody>  
                        </table> <br>
                        <?php
                        if (empty($comments)) {
                            echo "<p class='m-0 text-white'><b>Note:</b>$comments</p>";
                          }
                          else{
                            echo "<p class='m-0'><b>Note:</b>$comments</p>";
                          }
                        ?>
                          
                        <br>
                        <h3 class="center-title fs-5 mt-4">AUTHORIZATION</h3>  <br> 
                        <p>I <?php echo $clientname ?> hereby authorize  <b>Aerosoync Enterprises  </b> to charge the above credit card for fees associated with services provided. I agree that the onetime charge will be applied to my credit card by Aerosoync Enterprises  I agree that if I have any problems or questions regarding my account or any services provided by Aerosoync Enterprises, I will contact Aerosoync Enterprises for assistance. I guarantee and warrant that I am the legal card holder for this credit card and that I am legally authorized to enter into this credit card billing agreement with Aerosoync Enterprises.</p>
                    </div>

                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <img src="../images/aerosoync-footer.png" alt="" class="w-100 d-footer-1" style="margin-top: 97px;">

            </div>


            <!-- +++++++++++++++ -->
            <!-- page 2 -->
            <!-- +++++++++++++++ -->

            <br>
            <div class="border d-2" style="height:1046px;">
                <br>
                <h3  class="center-title fw-bold">Terms & Conditions:</h3>  <br>
                <p>This Services Agreement is a legal agreement between “Customer” either individual or a single entity or a Company and “Merchant” that governs the use of Merchant for support with regards to product sold. By signing this agreement, you agree to the understanding shown below and agree to be bound by the terms of this End User Service Agreement:</p>
                <p> <span class="fw-bold">A. Capacity and Authority to contract:</span>  CUSTOMER represents that he/she is of legal age of majority in the state of residence and, if required can enter this contract.</p>
                <p> <span class="fw-bold">B. Description of Product & services:</span>: MERCHANT is primarily a third-party independent service provider of the various products and offers online services for a large set of hardware and software products.</p>
                <p> <span class="fw-bold">C. Term: </span> This agreement is effective unless terminated and is valid for the period of term established above.</p>
                <p> <span class="fw-bold">D. Payment: </span>Payment shall be made to Merchant. By signing this End User Service Agreement, CUSTOMER authorize that the payment was charged with his/her permission and MERCHANT has explained every aspect of the Product and services under this End User Service Agreement. CUSTOMER with free will and consent has made the payment from the Card/Cheque/Cash in favour of MERCHANT.</p>
                <p> <span class="fw-bold">E. Independent Developer and seller: </span> MERCHANT is a computer/software repair/setup company who provides phone support for computer and other peripheral devices. Merchant also provides web development services as and when required for the computers/servers.</p>
                <p> <span class="fw-bold">F. Limited Liability: </span> The parties understand and agree that MERCHANT and its employees, subcontractors, and its agents assume no liability or responsibility for the cost of repairing or replacing any equipment, software, or personal property, including intellectual property lost or damaged, either current or arising in the future, or any consequential damage of any nature incurred because of the services rendered to the CUSTOMER. The CUSTOMER agrees that in the event the CUSTOMER incurs any loss because of the services rendered it pursuant to this agreement, the MERCHANT, its employees, subcontractors, and agents is liable only to the extent of the MERCHANT charge to this CUSTOMER for this Agreement. </p>
                
            <br>
                <img src="../images/aerosoync-footer.png" alt="" class="w-100 pt-2" style="margin-top: 195px;">
            </div>


            <!-- +++++++++++++++ -->
            <!-- page 3 -->
            <!-- +++++++++++++++ -->


            <br>
            <div class="border d-2" style=" min-height: 1040px;">
                <p> <span class="fw-bold">G. Right to refuse, suspend or terminate service: </span>MERCHANT reserves the right to refuse, suspend or terminate service to any user for any reasons related to improper/illegal use of computers in the service plan. In the event of such refusal or termination, a refund for time remaining will be made on a pro-data basis and will credited to CUSTOMER account within 72 hours of termination.</p>
                <p> <span class="fw-bold">H. Transfer: </span>This agreement is non transferrable without the prior approval of the MERCHANT. The new end user receiving the transferred agreement must agree to all the End User Service Agreement terms.</p>
                <p> <span class="fw-bold">I. Refunds and Cancellation: </span>That both the parties agree to the following refund/cancellation schedule after the signature of agreement. MERCHANT agrees to waive charges incurred if we are unable to resolve the issue. If the issue has been resolved and the CUSTOMER wishes to cancel, MERCHANT may charge a minimum service delivery fee and refund the outstanding amount with the schedule shown below. However, cost incurred by MERCHANT on behalf of CUSTOMER in getting license key for any software shall not be reimbursed by the MERCHANT. CUSTOMER is requested to call support number to initiate any refund/cancellation within 14 days of purchase for refund.</p>
                <p> <span class="fw-bold">J. Entire Agreement: </span>This End User Service Agreement is the entire agreement between the CUSTOMER and MERCHANT, and it supersedes all prior or oral or written communications, proposals, and representations with respect to support covered by this End User Service Agreement.</p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <img src="../images/aerosoync-footer.png" alt="" class="w-100 mt-4 pt-4">

            </div>
            <br>

            <!-- +++++++++++++++ -->
            <!-- page 4 -->
            <!-- +++++++++++++++ -->

            <div class="border bottom-bordered p-0" style="height:1045px;">
                <!-- Sample Table -->
                    <div style="padding: 30px  30px 10px 30px;">
                        <img src="../images/aerosoync.png" alt="" class="daphnislogo mb-4" style="max-width:140px;"> 
                        <h3  class="center-title"> Service Delivery Confirmation </h3> <br>

                        <h5>Date: <?php echo $date ?></h5>
                        <h5>Order ID: <?php echo $order_id ?></h5> 
                    </div>
                    <div class="w-100 p-2 bg-dark"></div>
                    <br>

                    <div style="padding: 30px  30px 10px 30px;">
                            <div class="row g-5">
                                <div class="col-6">
                                    <div class="info-container  h-100">
                                    <h6 class="text-center"><u>Merchant Details</u></h6>
                                    <h6 style="font-size: 17px; font-weight: bold;" class="mb-1">AEROSOYNC ENTERPRISES </h6>
                                    <p class="mb-1" style="font-size: 13px; font-weight: 600;">402 sapphire Tower 01, Sec.-116, Mohali, PB., India </p>
                                    <p class="mb-1" style="font-size: 13px;"><b>Website: </b>www.aerosyncyard.com</p>
                                    <p class="mb-1" style="font-size: 13px;"><b>Email: </b>info@aerosyncyard.com</p>

                                </div></div>
                                <div class="col-6">
                                    <div class="info-container" style="min-height: 182px;">
                                        <h6 class="text-center mt-1"><u>Customer Details</u></h6>
                                        <p class="mb-1"><b>Name: </b><?php echo $clientname ?></p>
                                        <p class="mb-1"><b>Address: </b> <?php echo $address ?></p>
                                        <p class="mb-1"><b>Phone: </b><?php echo $contact ?> </p>
                                        <p class="mb-1"><b>Email:  </b><?php echo $email ?> </p>
                                    </div>
                                </div>
                            </div>
                            <p class="fw-bold mt-3">Payment for: </p>
                            

                        <table class="table table-bordered text-center border-dark price-table">
                            <tbody>
                                <tr  class="border-bottom-0">
                                    <th class="border-end-0 border-bottom-0">Qty</th>
                                    <th class="w-50 border-end-0 border-bottom-0">Description</th>
                                    <th class="border-bottom-0">Price per Plan</th>
                                </tr>
                                <tr class="border-bottom-0">
                                    <th class="border-end-0 border-bottom-0">1</th>
                                    <th class="border-end-0 border-bottom-0"><?php echo $plans ?> Plan</th>
                                    <td class="border-bottom-0"><?php echo $currency ?> <?php echo $amount ?></td>
                                </tr>
                                <tr class="border-bottom-0">
                                    <th class="border-end-0 border-bottom-0"></th>
                                    <th class="border-end-0 border-bottom-0"></th>
                                    <td class="border-bottom-0"></td>
                                </tr>
                                <tr class="border-bottom-1">
                                    <th colspan="2" class="text-end border-end-0 border-bottom-0">Total</th>
                                    <td class="border-bottom-0"><?php echo $currency ?> <?php echo $amount ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        if (empty($comments)) {
                            echo "<p class='m-0 text-white'><b>Note:</b>$comments</p>";
                          }
                          else{
                            echo "<p class='m-0'><b>Note:</b>$comments</p>";
                          }
                        ?>
                                
                        <br>
                        <p class="text-center">NOTE: If you have any questions about this delivery, please contact us at the earliest.</p>
                        <p class="mt-4">I <?php echo $clientname ?>, hereby confirm that the above-mentioned services have been delivered and the payment has been processed. I also verify, that I have received the services, I agree & acknowledge the terms and conditions of this order as listed below.</p>
                        <p class="mb-0">Signature:</p>
                        <br>
                        <br><br>
                    </div>
                    
            </div>  
            <br> 

            <!-- +++++++++++++++ -->
            <!-- page 5 -->
            <!-- +++++++++++++++ -->
            
            <div class="border bottom-bordered" style="min-height: 1040px;">
                <h3  class="center-title"> Services Agreement </h3> <br>
                <p>Dear <?php echo $clientname ?>,</p>
                <p>We would like to take this opportunity to thank you for purchasing <b> <?php echo $plans ?> Plan, Order ID <?php echo $order_id ?></b> from us. We assure you that you have purchased the perfect service for your requirements. In your presence, we believe our executives will feel the same way. The purchased plan includes:</p>
                
                <ul>
                <?php
                    foreach($services as $product){
                        echo "<li>$product </li>";
                    }
                ?>
                </ul>
                <br>
                <p class="mb-2">We are a customer-centric organization. If you want to give any feedback or suggestions regarding your purchase, you are always welcome. Your feedback will help us improve ourselves.</p>
                <p class="mb-2">Also, please find below these agreement terms and conditions for your reference.</p>
                <p>Once again, we would like to thank you for giving us a chance to resolve your problem.</p>

            </div>
            <br>


            <!-- +++++++++++++++ -->
            <!-- page 6 -->
            <!-- +++++++++++++++ -->
            

            <div class="border bottom-bordered"  style="min-height: 1040px;">
                <h3  class="center-title mt-4 mb-3"> Agreement, Terms & Conditions: </h3> <br>

                <ol>
                    <li>When you avail our software repair or testing/consultancy services, if the exact same issue re-occurs with-in 14 days of initial issue/problem fixing, we will re-service/fix the issue without any charge to your satisfaction. We offer these expert IT consultancy/Support services to wide range of customers, till date we have large number of happy and satisfied customer base, our support is specialized to deliver quality results with maximum customer satisfaction.</li>
                    <li>A minimum of 35% of the amount would be deducted from Support Service Plan along with product cost at the time of cancellation if the issue is resolved once within 14 days. A full refund would be provided only if we are not able to resolve even a single issue within a month. We expect our customers to email us before rising any disputes on the transactions to understand the reason for your dissatisfaction on the services availed, and we will be more than glad to provide you with fully satisfied results.</li>
                    <li><b>Terms of Use: </b><br> AEROSOYNC ENTERPRISES   ("Aerosoync Enterprises ," "we," "us," and "our") reserves the right to change, modify, add, or remove any of the terms and conditions contained in above policies or guidelines governing the Site or Services, at any time and in its sole discretion. Any changes will be effective upon posting of the revisions on the Site. All notice of changes to this Policy will be posted on the Site for thirty (30) days. You are responsible for reviewing the notice and any applicable changes. Changes to referenced policies and guidelines may be posted without notice to you. </li>
                    <li>You’re continued use of this site and the services, any changes or updates posted by Aerosoync Enterprises will constitute your acceptance of such changes or modifications. If you do not agree to any changes to this participation agreement, do not continue to use the services or this site. If you have any questions or concerns, please contact us at “info@aerosyncyard.com".</li>
                    <li>The plan mentioned in the "Services Delivery Confirmation" may acquire more than one service that can be bound to the package at once, or we customize plans as per the customer’s requirement. It’s subject to compatibility. So, one plan can consist of multiple services. Moreover, Quantity (Qty) refers to the count of Plans subscribed.</li>
                    
                </ol>

                <p class="mt-4">As a standard company policy, we will follow up with you (client) for 3 business days. If we do not get any feedback or any complaints, we will go ahead and close the case as <b>RESOLVED</b> and the payment will be processed. You (client) will not <b>DISPUTE</b>  the transaction in such cases.</p>
            </div>
            <br>


            <!-- +++++++++++++++ -->
            <!-- page 7 -->
            <!-- +++++++++++++++ -->


            <div class="border bottom-bordered"  style="min-height: 1040px;">
                <br>
                <br>
                <p><b>How to contact</b> AEROSOYNC ENTERPRISES :</p>
                <p>You may contact us to let us know of your changes as to how we may contact you electronically, to request paper copies of certain information from us, and to withdraw your prior consent to receive notices and disclosures electronically as follows:</p>
                <p>To contact us by email, send messages to: </p>
                
                <b class="mb-2"><b>AEROSOYNC ENTERPRISES  </b> </b>
                <p class="mb-0 mt-3"><b>Website: </b> www.aerosyncyard.com </p>
                <p class="mb-0"><b>Email: </b>: info@aerosyncyard.com</p>
                <p class="mb-0"><b>Address: </b>402 sapphire Tower 01, Sec.-116, Mohali, PB., India </p>

                
                <p><b>To advise </b> AEROSOYNC ENTERPRISES  <b> of your new email address</b></p> 
                
                <p>To let us know of a change in your email address where we should send notices and disclosures electronically to you, you must send an email message to us at info@aerosyncyard.com  and in the body of such request, you must state: your previous email address, your new email address. We do not require any other information from you to change your email address.</p>
                <p><b>To withdraw your consent with</b> AEROSOYNC ENTERPRISES</p>
                <p>To inform us that you no longer wish to receive future notices and disclosures in electronic format you may:</p>
                <ul><li>Send us an email at info@aerosyncyard.com  and in the body of such request you must state your email, full name, mailing address, and telephone number. We do not need any other information from you to withdraw consent.</li></ul>
            </div>

            <br>


            <!-- +++++++++++++++ -->
            <!-- page 8 -->
            <!-- +++++++++++++++ -->


            <div class="border bottom-bordered" style="border-color: #fff !important;">
                <div><img src="../images/aerosoync.png" alt="" class="daphnislogo mb-4"  style="max-width: 230px; "> </div> 
                <h3  class="center-title mt-4 mb-3"> CUSTOMER FEEDBACK FORM </h3> <br>   

                <p>We at AEROSOYNC ENTERPRISES, want to thank you for giving us the opportunity to serve you. Please help us by taking a couple of minutes to tell us about your experience. We appreciate your business and want to make sure we meet your expectations. </p>
                <p>Please fill out this short customer feedback form so we can ensure top quality service to all our customers.</p>

                <table class="table table-bordered table-striped text-center">
                    <tbody>
                        <tr class="border-bottom-0" style="background-color: rgb(234, 234, 234);">
                            <th class="border-bottom-0 border-end-0">DATE</th>
                            <th class="border-bottom-0 border-end-0">NAME</th>
                            <th class="border-bottom-0 border-end-0">EMAIL</th>
                            <th class="border-bottom-0">ORDER ID</th>
                        </tr>
                        <tr>
                            <td class="border-bottom-0 border-end-0"><?php echo $date ?></td>
                            <td class="border-bottom-0 border-end-0"><?php echo $clientname ?></td>    
                            <td class="border-bottom-0 border-end-0"><?php echo $email ?></td>
                            <td><?php echo $order_id ?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table class="table table-bordered text-center">
                    <tbody>
                        <tr class=" border-top-0" style="background-color:#EAEEF3;">
                            <th class="border-end-0 border-top-0 border-start-0 bg-white" style="width: 30%; border-bottom: 1px solid #000;"></th>
                            <th class="border-bottom-0 border-end-0" style="border-top: 1px solid #000; width:100px">EXCELLENT</th>
                            <th class="border-bottom-0 border-end-0" style="border-top: 1px solid #000; width:100px">VERY GOOD	</th>
                            <th class="border-bottom-0 border-end-0" style="border-top: 1px solid #000; width:100px">GOOD</th>
                            <th class="border-bottom-0" style="border-top: 1px solid #000; width:100px">FAIR</th>
                        </tr>
                        <tr style="background-color: #F2F2F2; border-top: 0px;">
                            <td class=" border-end-0 text-start"  style="background-color:#EAEEF3; font-size: 13px; border-bottom: 1px solid #000;">How would you rate your overall customer experience?</td>
                            <td class="border-bottom-0 border-end-0"></td>    
                            <td class="border-bottom-0 border-end-0"></td>
                            <td class="border-bottom-0 border-end-0"></td>
                            <td></td>
                        </tr>

                        <tr style="background-color: #F2F2F2; border-top: 0px;">
                            <td class="border-end-0 text-start"  style="background-color:#EAEEF3; font-size: 13px; border-bottom: 1px solid #000;">How satisfied were you with the product?</td>
                            <td class="border-bottom-0 border-end-0"></td>    
                            <td class="border-bottom-0 border-end-0"></td>
                            <td class="border-bottom-0 border-end-0"></td>
                            <td></td>
                        </tr>
                        <tr style="background-color: #F2F2F2; border-top: 0px;">
                            <td class="border-end-0 text-start"  style="background-color:#EAEEF3; font-size: 13px; border-bottom: 1px solid #000;">How satisfied were you with customer support?</td>
                            <td class="border-bottom-0 border-end-0"></td>    
                            <td class="border-bottom-0 border-end-0"></td>
                            <td class="border-bottom-0 border-end-0"></td>
                            <td></td>
                        </tr>
                        <tr style="background-color: #F2F2F2; border-top: 0px;">
                            <td class="border-end-0 text-start"  style="background-color:#EAEEF3; font-size: 13px; border-bottom: 1px solid #000;">How satisfied were you with the timeliness of delivery?</td>
                            <td class="border-end-0"></td>    
                            <td class="border-end-0"></td>
                            <td class="border-end-0"></td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>

                <p class="text-center mb-0">Would you recommend our product or service to others?	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	YES	 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;	 &nbsp; &nbsp;NO </p>
           
                <img src="../images/aerosoync-footer.png" alt="" class="w-100" style="margin-top: 250px;">
                
            </div>
        </div>
    </div>


    <script>
        function createPDF() {
           var element = document.getElementById('element-to-print');
           html2pdf(element, {
               margin:.3,
               padding:0,
               filename: '<?php echo $clientname ?>.pdf',
               image: { type: 'jpeg', quality: .1 },
               html2canvas: { scale: 3,  logging: true },
               jsPDF: { unit: 'in', format: 'A4', orientation: 'P' },
               class: createPDF
               
           });
       };  
   </script>


</body>
</html>