<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

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
        $params = array('server_key' => 'SB-Mid-server-sJ6sUsMDGblgf6YmhU1pSx0-', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		
    }

    public function index()
    {
		
		$host = 'localhost';
		$user = 'root';
		$password = '';
		$database = 'db_adudu';
		$port = '3306';
		$conn = new mysqli($host, $user, $password, $database);
		if ($conn->connect_errno) {
			die("gagal connect : " . $conn->connect_error);
		}

		$stmt = $conn->prepare("SELECT * FROM payment");
		$stmt->execute();
		$payment = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		foreach($payment as $key => $value){
			$this->status($value['order_id']);
		}

    	$this->load->view('transaction');
    }

    public function process()
    {
    	$order_id = $this->input->post('order_id');
    	$action = $this->input->post('action');
    	switch ($action) {
		    case 'status':
		        $this->status($order_id);
		        break;
		    case 'approve':
		        $this->approve($order_id);
		        break;
		    case 'expire':
		        $this->expire($order_id);
		        break;
		   	case 'cancel':
		        $this->cancel($order_id);
		        break;
		}

    }

	public function status($order_id)
	{
		$host = 'localhost';
		$user = 'root';
		$password = '';
		$database = 'db_adudu';
		$port = '3306';
		$conn = new mysqli($host, $user, $password, $database);
		if ($conn->connect_errno) {
			die("gagal connect : " . $conn->connect_error);
		}

		$response = $this->veritrans->status($order_id);
		$transaction_status = $response->transaction_status;
		$status_code = $response->status_code;
		$status_message = $response->status_message;

		$update = $conn->query("update payment set transaction_status = '$transaction_status', status_code = '$status_code', status_message = '$status_message' where order_id='$order_id'");

		if ($transaction_status == "settlement"){
			$stmt = $conn->prepare("SELECT id FROM payment WHERE order_id='$order_id'");
			$stmt->execute();
			$p = $stmt->get_result()->fetch_assoc();
	
			$id_payment = $p['id'];
	
			$stmt = $conn->prepare("SELECT * FROM order_details WHERE payment_id='$id_payment'");
			$stmt->execute();
			$od = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

			foreach($od as $key => $value){
				if ($value['status'] == 0){
					$stat = 1;
					$id_od = $value['id_order_details'];
					$result = $conn->query("update order_details set status = '$stat' where id_order_details='$id_od'");

					//update pengurangan stock sepatu
					$order_id_temp = $value['id_order_details'];
					$stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id='$order_id_temp'");
					$stmt->execute();
					$order_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
					foreach($order_items as $k => $v){
						$sepatu_id= $v['sepatu_id'];
						$stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu='$sepatu_id'");
						$stmt->execute();
						$sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
						
						foreach($sepatu as $kt => $vt){
							$stock_sepatu = $vt['stock_sepatu']-$v['qty'];
							$id_sepatu = $vt['id_sepatu'];
							$update_stock = $conn->query("update sepatu set stock_sepatu = '$stock_sepatu' where id_sepatu='$id_sepatu'");
						}
					}
				}
			}
		}
	}

	public function cancel($order_id)
	{
		echo 'test cancel trx </br>';
		echo $this->veritrans->cancel($order_id);
	}

	public function approve($order_id)
	{
		echo 'test get approve </br>';
		print_r ($this->veritrans->approve($order_id) );
	}

	public function expire($order_id)
	{
		echo 'test get expire </br>';
		print_r ($this->veritrans->expire($order_id) );
	}
}
