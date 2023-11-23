<?php
class Invoice{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "new_docu";
    private $invoiceOrderTable = 'order_receipt';
	private $invoiceOrderItemTable = 'items';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
		
	public function saveInvoice($POST) {		
		$sqlInsert = "
			INSERT INTO ".$this->invoiceOrderTable."(user_name, user_id, company, transaction_id, b_name, b_email, b_phone, b_address, s_name, s_email, s_phone, s_address, discount, tax, order_date, notes, total_amount, company_phone, currency, customer_id) 
			VALUES ('".$POST['user_name']."','".$POST['user_id']."','".$POST['company']."', '".$POST['transaction_id']."', '".$POST['b_name']."', '".$POST['b_email']."', '".$POST['b_phone']."', '".$POST['b_address']."', '".$POST['s_name']."', '".$POST['s_email']."', '".$POST['s_phone']."', '".$POST['s_address']."', '".$POST['discount']."', '".$POST['tax']."', '".$POST['order_date']."', '".$POST['notes']."', '".$POST['total_amount']."', '".$POST['company_phone']."', '".$POST['currency']."', '".$POST['customer_id']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['name']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->invoiceOrderItemTable."(order_id, name, coverage, duration, total) 
			VALUES ('".$lastInsertId."', '".$POST['name'][$i]."', '".$POST['coverage'][$i]."', '".$POST['duration'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}	
	public function updateInvoice($POST) {
		if($POST['invoiceId']) {	
			$sqlInsert = "
				UPDATE ".$this->invoiceOrderTable." 
				SET user_name = '".$POST['user_name']."', company= '".$POST['company']."', transaction_id = '".$POST['transaction_id']."', b_name = '".$POST['b_name']."', b_email = '".$POST['b_email']."', b_phone = '".$POST['b_phone']."', b_address = '".$POST['b_address']."', s_name = '".$POST['s_name']."', s_email = '".$POST['s_email']."' , s_phone = '".$POST['s_phone']."', s_address = '".$POST['s_address']."', discount = '".$POST['discount']."', tax = '".$POST['tax']."', order_date = '".$POST['order_date']."', notes = '".$POST['notes']."', total_amount = '".$POST['total_amount']."', company_phone = '".$POST['company_phone']."', currency = '".$POST['currency']."', customer_id = '".$POST['customer_id']."' WHERE id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);
		}		
		// $this->deleteInvoiceItems($POST['invoiceId']);
		for ($i = 0; $i < count($POST['name']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO ".$this->invoiceOrderItemTable."(order_id, name, coverage, duration, total) 
				VALUES ('".$POST['invoiceId']."', '".$POST['name'][$i]."', '".$POST['coverage'][$i]."', '".$POST['duration'][$i]."', '".$POST['total'][$i]."')";
			mysqli_query($this->dbConnect, $sqlInsertItem);		
		}       	
	}	
	
	public function getInvoice($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderTable." 
			WHERE user_name = '".$_SESSION['username']."' AND id = '$invoiceId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getInvoiceItems($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '$invoiceId'";
		return  $this->getData($sqlQuery);	
	}
	
}
?>