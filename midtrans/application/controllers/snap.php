<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: PUT, GET, POST");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $params = array('server_key' => 'SB-Mid-server-sJ6sUsMDGblgf6YmhU1pSx0-', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');		
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
    }

    public function token()
    {
		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => (int)$this->input->post('amount'), // no decimal allowed for creditcard
		);

		$cart_item = json_decode($this->input->post('cart_item'), TRUE);
		// echo "<pre>";
		// var_dump($cart_item);
		// var_dump($this->input->post('amount'));
		// echo "</pre>";
		$item_details = array ();
		foreach($cart_item as $key => $value){
			$item1_details = array(
				'id' => $value['id'],
				'price' => (int)$value['price'],
				'quantity' => (int)$value['quantity'],
				'name' => $value['name']
			);

			$item_details[] = $item1_details;
		}

		$user = json_decode($this->input->post('user'), TRUE);

		// Optional
		$customer_details = array(
		  'first_name'    => $user['first_name'],
		  'last_name'     => $user['last_name'],
		  'email'         => $user['email']
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
		$result = json_decode($this->input->post('result_data')); 
		$userid = $this->input->post('userid'); 
		echo "<pre>";
		print_r($result);
		echo "</pre>";	
		if (isset($result->va_numbers[0]->bank)){
			$bank = $result->va_numbers[0]->bank;
		}
		else{
			$bank = '-';
		}
		
		if (isset($result->va_numbers[0]->va_number)){
			$va_number = $result->va_numbers[0]->va_number;
		}
		else{
			$va_number = '-';
		}
		
		// if (isset($result->bca_va_number)){
		// 	$bca_va_number = $result->bca_va_number;
		// }
		// else{
		// 	$bca_va_number = '-';
		// }
		
		if (isset($result->bill_key)){
			$bill_key = $result->bill_key;
		}
		else{
			$bill_key = '-';
		}
		
		if (isset($result->biller_code)){
			$biller_code = $result->biller_code;
		}
		else{
			$biller_code = '-';
		}
		
		// if (isset($result->permata_va_number)){
		// 	$permata_va_number = $result->permata_va_number;
		// }
		// else{
		// 	$permata_va_number = '-';
		// }

		// $data = [
		// 	'status_code' => $result->status_code,
		// 	'status_message' => $result->status_message,
		// 	'transaction_id' => $result->transaction_id,
		// 	'order_id' => $result->order_id,
		// 	'gross_amount' => $result->gross_amount,
		// 	'payment_type' => $result->payment_type,
		// 	'transaction_time' => $result->transaction_time,
		// 	'transaction_status' => $result->transaction_status,
		// 	'fraud_status' => $result->fraud_status,
		// 	'pdf_url' => $result->pdf_url,
		// 	'finish_redirect_url' => $result->finish_redirect_url,
		// 	'permata_va_number' => $permata_va_number,
		// 	'bank' => $bank,
		// 	'va_number' => $va_number,
		// 	'bill_key' => $bill_key,
		// 	'biller_code' => $biller_code,
		// 	'bca_va_number' => $bca_va_number,
		// ];
		$host = 'localhost';
		$user = 'root';
		$password = '';
		$database = 'db_adudu';
		$port = '3306';
		$conn = new mysqli($host, $user, $password, $database);
		if ($conn->connect_errno) {
			die("gagal connect : " . $conn->connect_error);
		}
		$stmt = $conn->prepare("INSERT INTO payment(status_code, status_message, transaction_id, order_id, gross_amount, payment_type, transaction_time, transaction_status, bank, va_number, fraud_status, pdf_url, finish_redirect_url, bill_key, biller_code) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssssssssssss", $result->status_code, $result->status_message, $result->transaction_id, $result->order_id, $result->gross_amount, $result->payment_type, $result->transaction_time, $result->transaction_status, $bank, $va_number, $result->fraud_status, $result->pdf_url, $result->finish_redirect_url, $bill_key, $biller_code);
		$return = $stmt->execute();
		
		
		$lastid = mysqli_insert_id($conn);
		$stat = 0;
		$stmt = $conn->prepare("INSERT INTO order_details(user_id, payment_id, total, status) VALUES(?,?,?,?)");
		$stmt->bind_param("iiii", $userid, $lastid, $result->gross_amount, $stat);
		$return = $stmt->execute();

		$lastid = mysqli_insert_id($conn);

		$stmt = $conn->prepare("SELECT * FROM cart_item WHERE user_id=$userid and active = 1");
		$stmt->execute();
		$cart_item = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

		$stmt = $conn->prepare("SELECT * FROM users WHERE id_user=$userid");
		$stmt->execute();
		$active = $stmt->get_result()->fetch_assoc();

		$_SESSION['active'] = $active;

		foreach($cart_item as $key => $value){
			$stmt = $conn->prepare("INSERT INTO order_items(order_id, sepatu_id, qty) VALUES(?,?,?)");
			$stmt->bind_param("iii", $lastid, $value['sepatu_id'], $value['qty']);
			$return = $stmt->execute();
			$active = 0;
			$id_cart = $value['id_cart'];
			$update = $conn->query("update cart_item set active = '$active' where id_cart='$id_cart'");
		}

		if($return){
			echo "Request pembayaran berhasil dilakukan segera selesaikan pembayaran";
		}
		else{
			echo "request pembayaran gagal dilakukan";
		}
		$user = json_decode($this->input->post('user'), TRUE);
		

    	$this->data['finish'] = json_decode($this->input->post('result_data')); 
		// $this->load->view('transaction');
		header("Location: ../transaction");

    }
}
