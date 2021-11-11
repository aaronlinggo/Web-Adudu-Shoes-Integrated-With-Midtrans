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
		
		$item_details = array ();
		foreach($cart_item as $key => $value){
			$item1_details = array(
				'id' => $value['id'],
				'price' => (int)$value['price'],
				'quantity' => (int)$value['quantity'],
				'name' => $value['name']
			);

			$item_details[] = $item1_details;
			//array_push($item_details, $item1_details);
		}
		// // Optional
		// $item1_details = array(
		//   'id' => 'a1',
		//   'price' => 18000,
		//   'quantity' => 3,
		//   'name' => "Apple"
		// );

		// // Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 20000,
		//   'quantity' => 2,
		//   'name' => "Orange"
		// );

		// // Optional
		//$item_details = array ($item1_details, $item2_details);

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
		print_r($result);
		
    	$this->data['finish'] = json_decode($this->input->post('result_data')); 
		$this->load->view('konfirmasi', $this->data);

    }
}
