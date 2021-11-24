<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

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
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, 'true');

		$order_id = $result['order_id'];

		if ($result['status_code'] == 200){
			$data = [
				'status_code' => $result['status_code'],
				'transaction_status' => "settlement"
			];
			$this->db->update('payment', $data, array('order_id'=>$order_id));
			?>
			<div id="notifPopup" class="position-sticky" style="display: none;">
				<div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
						<strong style="margin-right: auto;">Payment Notification</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">Your transaction is complete.</div>
				</div>
			</div>
			<script>
				let notifTimer;
				let calcHeaderHeight = $("#header").height() + 30;

				$(document).ready(function() {
					$(".btn-close").click(function(e) {
						e.preventDefault();
						clearTimeout(notifTimer);

						$("#liveToast").removeClass("show");
						$("#liveToast").addClass("hide");

						setTimeout(() => {
							$("#notifPopup").removeAttr("style");
							$("#notifPopup").css({ "display": "none" });
						}, 250);
					});
				});
				$("#notifPopup").removeAttr("style");
				$("#notifPopup").css({
					"display": "block",
					"top": calcHeaderHeight,
					"right": "0",
					"z-index": "99999"
				});

				clearTimeout(notifTimer);

				setTimeout(() => {
					$("#liveToast").removeClass("hide");
					$("#liveToast").addClass("show");
				}, 250);

				notifTimer = setTimeout(() => {
					$("#liveToast").removeClass("show");
					$("#liveToast").addClass("hide");

					setTimeout(() => {
						$("#notifPopup").removeAttr("style");
						$("#notifPopup").css({ "display": "none" });
					}, 250);
				}, 5000);
			</script>
			<?php
		}
		else if ($result['status_code'] == 202){
			$data = [
				'status_code' => $result['status_code'],
				'transaction_status' => "expire"
			];
			$this->db->update('payment', $data, array('order_id'=>$order_id));
			?>
			<div id="notifPopup" class="position-sticky" style="display: none;">
				<div id="liveToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header">
						<strong style="margin-right: auto;">Payment Notification</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">Your transaction is not complete.</div>
				</div>
			</div>
			<script>
				let notifTimer;
				let calcHeaderHeight = $("#header").height() + 30;

				$(document).ready(function() {
					$(".btn-close").click(function(e) {
						e.preventDefault();
						clearTimeout(notifTimer);

						$("#liveToast").removeClass("show");
						$("#liveToast").addClass("hide");

						setTimeout(() => {
							$("#notifPopup").removeAttr("style");
							$("#notifPopup").css({ "display": "none" });
						}, 250);
					});
				});
				$("#notifPopup").removeAttr("style");
				$("#notifPopup").css({
					"display": "block",
					"top": calcHeaderHeight,
					"right": "0",
					"z-index": "99999"
				});

				clearTimeout(notifTimer);

				setTimeout(() => {
					$("#liveToast").removeClass("hide");
					$("#liveToast").addClass("show");
				}, 250);

				notifTimer = setTimeout(() => {
					$("#liveToast").removeClass("show");
					$("#liveToast").addClass("hide");

					setTimeout(() => {
						$("#notifPopup").removeAttr("style");
						$("#notifPopup").css({ "display": "none" });
					}, 250);
				}, 5000);
			</script>
			<?php
		}

		// if($result){
		// $notif = $this->veritrans->status($result->order_id);
		// }

		// error_log(print_r($result,TRUE));

		//notification handler sample

		/*
		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		}*/

	}
}
