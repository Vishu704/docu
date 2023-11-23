<?php
class Invoice{
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "new_docu";
    private $invoiceOrderTable = 'order_invoice';
	private $invoiceOrderItemTable = 'invoice_items';
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
			INSERT INTO ".$this->invoiceOrderTable."(user_name, user_id, company, transaction_id, b_name, b_email, b_address, date, due_date, notice, payment_link, currency, total_amount) 
			VALUES ('".$POST['user_name']."','".$POST['user_id']."','".$POST['company']."', '".$POST['transaction_id']."', '".$POST['b_name']."', '".$POST['b_email']."', '".$POST['b_address']."', '".$POST['date']."', '".$POST['due_date']."', '".$POST['notice']."', '".$POST['payment_link']."', '".$POST['currency']."', '".$POST['total_amount']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['name']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->invoiceOrderItemTable."(order_id, name, services, quantity, rate, amount) 
			VALUES ('".$lastInsertId."', '".$POST['name'][$i]."', '".$POST['services'][$i]."', '".$POST['quantity'][$i]."', '".$POST['rate'][$i]."', '".$POST['amount'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       	
	}	
	public function updateInvoice($POST) {
		if($POST['invoiceId']) {	
			$sqlInsert = "
				UPDATE ".$this->invoiceOrderTable." 
				SET user_name = '".$POST['user_name']."','".$POST['user_id']."', company= '".$POST['company']."', transaction_id = '".$POST['transaction_id']."', b_name = '".$POST['b_name']."', b_email = '".$POST['b_email']."', b_address = '".$POST['b_address']."', date = '".$POST['date']."', due_date = '".$POST['due_date']."' , notice = '".$POST['notice']."', payment_link = '".$POST['payment_link']."', currency = '".$POST['currency']."', total_amount = '".$POST['total_amount']."' WHERE id = '".$POST['invoiceId']."'";		
			mysqli_query($this->dbConnect, $sqlInsert);
		}		
		// $this->deleteInvoiceItems($POST['invoiceId']);
		for ($i = 0; $i < count($POST['name']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO ".$this->invoiceOrderItemTable."(order_id, name, services, quantity, rate, amount) 
				VALUES ('".$POST['invoiceId']."', '".$POST['name'][$i]."', '".$POST['services'][$i]."', '".$POST['quantity'][$i]."', '".$POST['rate'][$i]."', '".$POST['amount'][$i]."')";
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