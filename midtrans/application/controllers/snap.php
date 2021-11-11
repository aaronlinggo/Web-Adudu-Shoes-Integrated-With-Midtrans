<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
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
		// session_start();

		// $host = 'localhost';
		// $user = 'root';
		// $password = '';
		// $database = 'db_adudu';
		// $port = '3306';
		// $conn = new mysqli($host, $user, $password, $database);
		// if ($conn->connect_errno) {
		// 	die("gagal connect : " . $conn->connect_error);
		// }

		// $id_user = $_SESSION['active'];

		// $stmt = $conn->prepare("SELECT * FROM cart_item WHERE user_id=$id_user and active = 1");
		// $stmt->execute();
		// $cart_item = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

		// $amount = 0;
		// $item_details = array ();

		// foreach($cart_item as $key => $value){
		// 	$amount += ($value['price']*$value['qty']);

		// 	$sepatu_id = $value['sepatu_id'];

		// 	$stmt = $conn->prepare("SELECT * FROM sepatu WHERE id_sepatu=$sepatu_id");
		// 	$stmt->execute();
		// 	$sepatu = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

		// 	$item1_details = array(
		// 		'id' => $key,
		// 		'price' => $value['price'],
		// 		'quantity' => $value['qty'],
		// 		'name' => $sepatu[0]['nama_sepatu']
		// 	);

		// 	array_push($item_details, $item1_details);
		// }


		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => 94000, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => 18000,
		  'quantity' => 3,
		  'name' => "Apple"
		);

		// Optional
		$item2_details = array(
		  'id' => 'a2',
		  'price' => 20000,
		  'quantity' => 2,
		  'name' => "Orange"
		);

		// Optional
		$item_details = array ($item1_details, $item2_details);

		// Optional
		$billing_address = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'address'       => "Mangga 20",
		  'city'          => "Jakarta",
		  'postal_code'   => "16602",
		  'phone'         => "081122334455",
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Obet",
		  'last_name'     => "Supriadi",
		  'address'       => "Manggis 90",
		  'city'          => "Jakarta",
		  'postal_code'   => "16601",
		  'phone'         => "08113366345",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'email'         => "andri@litani.com",
		  'phone'         => "081122334455",
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
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
    	echo 'RESULT <br><pre>';
    	var_dump($result);
    	echo '</pre>' ;

    }
}
