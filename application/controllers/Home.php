<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $params = array('server_key' => 'SB-Mid-server-WEieYgFyVUYxjw8BFuR9EnFA', 'production' => false);
// 		$params = array('server_key' => 'Mid-server-WGR1cOZVDhMOZKDj2to7gJjQ', 'production' => true);
		// $this->load->library('midtrans');
		// $this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('m_home');
		$this->load->model('m_tagihan');
	}
	public function index()
	{
		$data = [
			'isi' 	=> 'home/v_home'
		];
		$this->load->view('temp/v_master', $data);
	}
	public function cari()
	{
		
		$this->load->model('m_tagihan');
		$detail = $this->m_home->get();
	}
	public function detail($id_santri)
	{
		$this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/home/detail/'.$id_santri;
        $config['total_rows'] = $this->m_home->getAllNum($id_santri);
        $config['per_page'] = 10;

     
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment('4');
		
		$this->load->model('m_tagihan');
		$detail = $this->m_home->detail($id_santri, $config['per_page'], $data['start']);
		$bayar = $this->m_tagihan->bayar($id_santri);
		$data = [
			'isi' => 'home/v_detail',
			'data' =>	$detail,
			'pembayar' => $bayar,
		];
		$this->load->view('temp/v_master', $data);
	}
	public function detail_bulanan($id_santri)
	{
		$this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/home/detail_bulanan/'.$id_santri;
        $config['total_rows'] = $this->m_home->getAllNum_bulanan($id_santri);
        $config['per_page'] = 10;

      
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment('4');

		$this->load->model('m_tagihan');
		$detail = $this->m_home->detail_bulanan($id_santri, $config['per_page'], $data['start']);
		$bayar = $this->m_tagihan->bayar_bulanan($id_santri);
		$data = [
			'isi' => 'home/v_detail_bulanan',
			'data' =>	$detail,
			'pembayar' => $bayar,
		];
		$this->load->view('temp/v_master', $data);
	}
	public function detail_tahunan($id_santri)
	{
		$this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/home/detail_tahunan/'.$id_santri;
        $config['total_rows'] = $this->m_home->getAllNum_tahunan($id_santri);
        $config['per_page'] = 10;

     
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment('4');

		$this->load->model('m_tagihan');
		$detail = $this->m_home->detail_tahunan($id_santri, $config['per_page'], $data['start']);
		$bayar = $this->m_tagihan->bayar_tahunan($id_santri);
		$data = [
			'isi' => 'home/v_detail_tahunan',
			'data' =>	$detail,
			'pembayar' => $bayar,
		];
		$this->load->view('temp/v_master', $data);
	}
	// public function token()
	// {
	// 	$nama = $this->input->post('nama');
	// 	$jumlah = $this->input->post('jumlah');
	// 	$id_santri = $this->input->post('id_santri');

	// 	// Required
	// 	$transaction_details = array(
	// 		'order_id' => $id_santri . '#' . rand(),
	// 		'gross_amount' => $jumlah, // no decimal allowed for creditcard
	// 	);
	// 	// Optional
	// 	$customer_details = array(
	// 		'first_name'    => $nama,
	// 		// 'id'    		=> $this->input->post('id'),
	// 	);

	// 	// Data yang akan dikirim untuk request redirect_url.
	// 	$credit_card['secure'] = true;
	// 	//ser save_card true to enable oneclick or 2click
	// 	//$credit_card['save_card'] = true;

	// 	$time = time();
	// 	$custom_expiry = array(
	// 		'start_time' => date("Y-m-d H:i:s O", $time),
	// 		'unit' => 'day',
	// 		'duration'  => 1
	// 	);

	// 	$transaction_data = array(
	// 		'transaction_details' => $transaction_details,
	// 		'customer_details'   => $customer_details,
	// 		'credit_card'        => $credit_card,
	// 		'expiry'             => $custom_expiry
	// 	);

	// 	error_log(json_encode($transaction_data));
	// 	$snapToken = $this->midtrans->getSnapToken($transaction_data);
	// 	error_log($snapToken);
	// 	echo $snapToken;
	// }

	// public function finish()
	// {
	// 	$result = json_decode($this->input->get('result_data'));
	// 	$pdf = '';
	// 	if (isset($result->pdf_url)) {
	// 		$pdf = $result->pdf_url;
	// 	}
	// 	$this->db->update('tb_bayar', ['pdf_url' => $pdf], ['order_id' => $result->order_id]);
	// 	// end
	// 	$this->db->join('tb_santri', 'tb_santri.id_santri = tb_bayar.id_santri', 'left');
	// 	$query = $this->db->get_where('tb_bayar', ['order_id' => $result->order_id])->row();
	// 	$data = [
	// 		'isi' 	 => 'home/v_finish',
	// 		'detail' => $query,
	// 	];
	// 	$this->load->view('temp/v_master', $data);
	// }
	public function call_back()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);
		if ($result->status_code == 201) { 
			$ket = $result->payment_type;
			if ($result->payment_type == 'bank_transfer') {
				if (isset($result->va_numbers[0]->va_number)) {
					$ket =  $result->va_numbers[0]->va_number . ' (' . $result->va_numbers[0]->bank . ')';
				} else {
					$ket = $result->permata_va_number . ' (permata)';
				}
			} elseif ($result->payment_type == 'cstore') {
				$ket = $result->payment_code;
			}
			$pdf = '';
			if (isset($result->pdf_url)) {
				$pdf = $result->pdf_url;
			}
			$data = [
				'order_id' => $result->order_id,
				'id_santri' => explode('#', $result->order_id)[0],
				'gross_amount' => $result->gross_amount,
				'transaction_time' => $result->transaction_time,
				'status_code' => $result->status_code,
				'payment_type' => $result->payment_type,
				'payment_ket' => $ket,
				'pdf_url' => $pdf,
			];
			$this->db->insert('tb_bayar', $data);
		} else if ($result->status_code == 200) {
			$this->db->where('order_id', $result->order_id);
			$this->db->update('tb_bayar', ['status_code' => 200]);
		} elseif ($result->status_code == 202) {
			$this->db->where('order_id', $result->order_id);
			$this->db->update('tb_bayar', ['status_code' => 202]);
		}
	}
	public function spp_perbulan()
	{
		$this->load->model('m_spp');
		$this->load->model('m_tagihan');
		$data = [
			'ket' => date('F Y'),
			'jumlah' => 100000,
		];
		$this->m_spp->input_bulanan($data);
		$santri = $this->db->where('status', '0')->get('tb_santri')->result();
		$id_spp_bulanan = $this->db->select('max(id_spp_bulanan) as max')->get('tb_spp_bulanan')->row()->max;
		foreach ($santri as $id) {
			$data2 = [
				'id_santri' => $id->id_santri,
				'id_spp_bulanan' => $id_spp_bulanan,
				// 'nama_santri' => $this->db->where(['id_santri' => $id->id_santri])->get('tb_santri')->row()->nama,
				'tagihan_bulanan' => $data['jumlah'],
			];
			$this->m_tagihan->input_bulanan($data2);
		}
	}
}
