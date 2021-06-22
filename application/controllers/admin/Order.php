<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        // $this->load->model('front/order_model');
        $params = array('server_key' => 'SB-Mid-server-lllM3XwrxvDj1C78-55QT6Aq', 'production' => false);
        $this->load->model('payment_model');
		$this->load->library('veritrans');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('unit_model');
        $this->load->model('foto_model');
		$this->veritrans->config($params);
    }

    function get_ajax() {
        $list = $this->order_model->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = $item->id;
            $row[] = $item->code;
            $row[] = $item->order_date;
            $row[] = indo_currency($item->total_price);
            $row[] = $item->customer_firstname.' '.$item->customer_lastname;
            $row[] = $this->status_color($item->status);
            $row[] = $this->paymentstatus_color($item->payment_status);
            // $row[] = $item->payment_time;
            // $row[] = $this->status_color($item->status);
            // add html for action
            $status_cancel = 'cancelled';
            $status_confirm = 'confirmed';
            $full_name = $item->customer_firstname.' '.$item->customer_lastname;
            $row[] = '<div class="btn-group" role="group">
            <button id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" type="button" class="btn btn-sm btn-primary dropdown-toggle" id="btnGroupVerticalDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                <a class="dropdown-item btn-foto" href="'.site_url('admin/order/detail/'.$item->id).'" data-id="'.$item->id.'" data-user_id="'.$item->user_id.'">
                    <i class="fa fa-fw fa-eye mr-5"></i>Detail
                </a>
                <a class="dropdown-item change-status_payment" href="#edit_status_payment" id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" >
                    <i class="fa fa-fw fa-refresh mr-5"></i>Check
                </a>
                <a class="dropdown-item btn-confirm" href="#edit_status_confirm" id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" data-user_id="'.$this->session->userdata('id').'" 
                data-qty="'.$item->qty.'" data-barcode="'.$item->barcode.'" data-name="'.$item->name.'" data-product_id="'.$item->product_id.'" data-status="'.$status_confirm.'" data-toggle="modal" data-target="#modal-popin3">
                <i class="fa fa-fw fa-check mr-5"></i>Confirm
                </a>
                <a class="dropdown-item change-status_cancel" href="#edit_status_cancel" id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" data-user_id="'.$this->session->userdata('id').'" data-status="'.$status_cancel.'" data-toggle="modal" 
                data-code="'.$item->code.'" data-date="'.$item->order_date.'" data-payment="'.$item->payment_status.'"
                data-full_name="'.$full_name.'" data-email="'.$item->customer_email.'" data-phone="'.$item->customer_phone.'" data-target="#modal-popin">
                    <i class="fa fa-fw fa-remove mr-5"></i>Cancel
                </a>
              
            </div>
        </div>
                    <button id="del'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" class="swal-confirm-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->order_model->count_all(),
                    "recordsFiltered" => $this->order_model->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }
    function get_ajax2() {
        $list = $this->order_model->get_datatables2();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = $item->id;
            $row[] = $item->code;
            $row[] = $item->order_date;
            $row[] = indo_currency($item->total_price);
            $row[] = $item->customer_firstname.' '.$item->customer_lastname;
            $row[] = $this->status_color($item->status);
            $row[] = $this->paymentstatus_color($item->payment_status);
            // $row[] = $item->payment_time;
            // $row[] = $this->status_color($item->status);
            // add html for action
          $status_deliver = 'delivered';
          $full_name = $item->customer_firstname.' '.$item->customer_lastname;
            $row[] = '<div class="btn-group" role="group">
            <button id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" type="button" class="btn btn-sm btn-primary dropdown-toggle" id="btnGroupVerticalDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                <a class="dropdown-item btn-foto" href="'.site_url('admin/order/detail/'.$item->id).'" data-id="'.$item->id.'">
                    <i class="fa fa-fw fa-eye mr-5"></i>Detail
                </a>
                <a class="dropdown-item change-status_deliver" href="#edit_status_deliver" id="'.encode_id($item->id).'"
                 data-id="'.encode_id($item->id).'" data-user_id="'.$this->session->userdata('id').'" data-status="'.$status_deliver.'" 
                 data-code="'.$item->code.'"  data-full_name="'.$full_name.'" data-province="'.$item->customer_province.'"
                 data-city="'.$item->customer_city.'"  data-postcode="'.$item->customer_postcode.'"
                 data-courier="'.$item->shipping_courier.'" data-service="'.$item->shipping_service.'" data-toggle="modal" data-target="#modal-popin2">
                <i class="fa fa-fw fa-send mr-5"></i>Deliver
                </a>
              
            </div>
        </div>
                    <button id="del'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" class="swal-confirm-delete2 btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->order_model->count_all2(),
                    "recordsFiltered" => $this->order_model->count_filtered2(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax3() {
        $list = $this->order_model->get_datatables3();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = $item->id;
            $row[] = $item->code;
            $row[] = $item->order_date;
            $row[] = indo_currency($item->total_price);
            $row[] = $item->customer_firstname.' '.$item->customer_lastname;
            $row[] = $this->status_color($item->status);
            $row[] = $this->paymentstatus_color($item->payment_status);
            // $row[] = $item->payment_time;
            // $row[] = $this->status_color($item->status);
            // add html for action
          $status_deliver = 'delivered';
            $row[] = '<div class="btn-group" role="group">
            <button id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" type="button" class="btn btn-sm btn-primary dropdown-toggle" id="btnGroupVerticalDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                <a class="dropdown-item btn-foto" href="'.site_url('admin/order/detail/'.$item->id).'" data-id="'.$item->id.'">
                    <i class="fa fa-fw fa-eye mr-5"></i>Detail
                </a>

              
            </div>
        </div>
                    <button id="del'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" class="swal-confirm-delete3 btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->order_model->count_all3(),
                    "recordsFiltered" => $this->order_model->count_filtered3(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax4() {
        $list = $this->order_model->get_datatables4();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = $no.".";
            $row[] = $item->id;
            $row[] = $item->code;
            $row[] = $item->order_date;
            $row[] = indo_currency($item->total_price);
            $row[] = $item->customer_firstname.' '.$item->customer_lastname;
            $row[] = $this->status_color($item->status);
            $row[] = $this->paymentstatus_color($item->payment_status);
            // $row[] = $item->payment_time;
            // $row[] = $this->status_color($item->status);
            // add html for action
          $status_deliver = 'delivered';
            $row[] = '<div class="btn-group" role="group">
            <button id="'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" type="button" class="btn btn-sm btn-primary dropdown-toggle" id="btnGroupVerticalDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2">
                <a class="dropdown-item btn-foto" href="'.site_url('admin/product/detail/'.$item->id).'" data-id="'.$item->id.'">
                    <i class="fa fa-fw fa-eye mr-5"></i>Detail
                </a>

              
            </div>
        </div>
                    <button id="del'.encode_id($item->id).'" data-id="'.encode_id($item->id).'" class="swal-confirm-delete4 btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->order_model->count_all4(),
                    "recordsFiltered" => $this->order_model->count_filtered4(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }
    function status_color($status){
        if($status == 'completed'){
            return '<span class="badge badge-success">Completed</span>';
        }
        else if($status == 'created'){
            return '<span class="badge badge-warning">Created</span>';
        }
        else if($status == 'cancelled'){
            return '<span class="badge badge-danger">Cancelled</span>';
        }
        else if($status == 'confirmed'){
            return '<span class="badge badge-primary">Confirmed</span>';
        }
        else if($status == 'delivered'){
            return '<span class="badge badge-primary">Delivered</span>';
        }

    }

    function paymentstatus_color($status){
        if($status == 'settlement'){
            return '<span class="badge badge-success">Success</span>';
        }
        else if($status == 'pending'){
            return '<span class="badge badge-warning">Pending</span>';
        }
        else if($status == 'expire'){
            return '<span class="badge badge-danger">Expired</span>';
        }
    }

    public function index()
    {
        $this->_display('admin/orders/order', [
            'menu_active' => 'orders',    
            'title' => 'Orders',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
        ]);
    }

    function get_unit_json() { //data data produk by JSON object
        header('Content-Type: application/json');
        echo $this->unit_model->get_unit_all();
    }

    public function add()
    {
        $item = new stdClass();
		$item->id = null;
        $item->unit_nama = null;

        $this->_display('admin/unit/form/k_form', [
            'menu_active' => 'unit',
            'title' => 'Tambah unit',
            'nama' => $this->session->userdata('full_name'),
            'role' => $this->session->userdata('role'),
            'page' => 'add',
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $query = $this->unit_model->get($id);
        if($query->num_rows() > 0){
            $item = $query->row();
            $this->_display('unit/form/k_form', [
                'menu_active' => 'unit',
                'title' => 'Tambah unit',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                'page' => 'edit',
                'item' => $item,
                ]);
        }
        else{
            echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='".site_url('unit')."';</script>";
        }
    }

    public function check_unit(){
        $post = $this->input->post(null, TRUE);
		$data = $this->unit_model->check_duplicate_unit_id($post["unit_id"]);
		// $error = $this->db->error();
		// if($error['code'] != 0){
        if($data){
			echo "true";
		} else {
			echo "false";
		}
        // echo $data;
		// echo "<script>window.location='".site_url('unit')."';</script>";
        // $this->output->set_output($id);
	}

    public function del(){
        $post = $this->input->post(null, TRUE);
        // $check = $this->order_model->check_duplicate_unit_id($post["id"]);
        // if(!$check){
            $data = $this->order_model->del($post["id"]);
            $error = $this->db->error();
            if($error['code'] != 0){
                echo "error";
            } else {
                echo 'true';
            }
            // echo $data;
            
        // } else{
        //     echo 'false';
        // }

		// echo "<script>window.location='".site_url('unit')."';</script>";
        // $this->output->set_output($id);
	}

    public function process(){
        $post = $this->input->post(null, TRUE);
        print_r($post);
		if($post['page'] == 'add'){
			$data = $this->unit_model->add($post);
		} else if($post['page'] == 'edit'){
			$data = $this->unit_model->edit($post);
		} 
		if($this->db->affected_rows()>0){
			$this->session->set_flashdata('success','Data berhasil disimpan');
	
		}
        // echo json_encode($data);
		// redirect('unit');
    }

    public function unit_validation(){
        $judul = $this->input->post('unit_judul', TRUE);
        if($this->unit_model->check_duplicate_unit($judul)){
            // return false;
            echo 'false';
        } else{
            // return true;
            echo 'true';
        }

    }

    public function cekstatus(){
        $id = decode_id($this->input->post('id'));
        print_r($id);
        if($id){
            $this->status($id);
        }else{
            print_r($id);
        }
    }
    private function status($id){
        $result = $this->veritrans->status($id);
        $dataupdate = [
            'status' => $result->transaction_status
        ];
        $where = [
            'order_id' => $id
        ];
        $update = $this->payment_model->update($dataupdate, $where);
      
        $dataupdate_order = [
            'payment_status' => $result->transaction_status
        ];
        $where = [
            'id' => $id
        ];
        $upd_order = $this->order_model->update_pay_order($dataupdate_order, $where);
    }

    public function confirm(){
        $post = $this->input->post(null, TRUE);
        $data = $this->order_model->confirm($post);
       

		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Status tidak berhasil diubah');</script>";
		} else {
			echo "<script>alert('Status berhasil diubah');</script>";
		}
        echo $data;
    }
    public function update_stock(){
        $id = decode_id($this->input->post('id'));
        $data = $this->order_model->update_stock($id);
		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Status tidak berhasil diubah');</script>";
		} else {
			echo "<script>alert('Status berhasil diubah');</script>";
		}
        echo $data;
    }
    public function cancel(){
        $post = $this->input->post(null, TRUE);
        print_r($post);
        $data = $this->order_model->cancel($post);
		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Status tidak berhasil diubah');</script>";
		} else {
			echo "<script>alert('Status berhasil diubah');</script>";
		}
        echo $data;
    }
    public function deliver(){
        $post = $this->input->post(null, TRUE);
        print_r($post);
        $data = $this->order_model->deliver($post);
        $data_track = $this->order_model->track_number($post);
        $curl = curl_init();
 $post_data_arr = [
            'number' => '085895311426',
            'message' => 'tes api',
          ]; 
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://localhost:8000/send-message",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "number=085895311426&message=tes api",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
         
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        print_r($response);
        // $post_data_arr = [
        //     'number' => '085895311426',
        //     'message' => 'tes api',
        //   ]; 
          
        //   $url = 'http://localhost:8000/send-message';
        //   $curl = curl_init($url);
        //   curl_setopt($curl, CURLOPT_POST, true);
        //   curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data_arr);
        //   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //   $response = curl_exec($curl);
        //   curl_close($curl);
        //   print_r($response);
		$error = $this->db->error();
		if($error['code'] != 0){
			echo "<script>alert('Status tidak berhasil diubah');</script>";
		} else {
			echo "<script>alert('Status berhasil diubah');</script>";
		}
        echo $data;
    }
    public function get_product(){
        // $product_id = $this->input->get('product_id');
        $id = decode_id($this->input->get('id'));
        $barang = $this->db
        ->select('orders.*, order_items.qty, order_items.name, order_items.barcode, order_items.product_id')
        ->join('order_items', 'order_items.order_id = orders.id', 'left')
        ->get_where('orders', [
            // 'product_id' => $product_id,
            'orders.deleted_at' => null,
            'order_items.order_id' => $id,
        
        ])->result();

    $result = [];
    foreach ($barang as $brg) {
        $result[] = [
            'id' => encode_id($brg->id),
            'product_id' => $brg->product_id,
            'name' => $brg->name,
            'barcode' => $brg->barcode,
            'qty' => $brg->qty,
           
        ];
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));

    
    }

    public function detail($id = null)
    {
      
        $this->db->select('orders.*, order_items.product_id, order_items.qty, order_items.name, order_items.base_total,
        order_items.base_price, inventories.qty as stock, user.*');
        $this->db->join('order_items','order_items.order_id = orders.id','left');
        $this->db->join('inventories','order_items.product_id = inventories.product_id','left');
        $this->db->join('user','orders.user_id = user.id','left');
        $this->db->where([
            'orders.deleted_at' => null,
            'orders.id' => $id,
        ]);
        $this->db->from('orders');
        $data = $this->db->get()->row();
        
        if (!$data || $id == null) {
            echo 'data tidak ditemukan';
            die;
        }
        $id_user = $data->user_id;
        $this->db->select('orders.*,user.first_name,user.last_name');
        $this->db->from('orders');
        $this->db->join('user','orders.user_id = user.id','left');
        $this->db->where('user_id',$id_user);
        $this->db->order_by('id','desc');
        $order =  $this->db->get()->result();
        // $id_user = $data->user_id;
        print_r($id_user);
        $total_order = $this->db->query("SELECT * FROM orders where deleted_at is null and user_id = '$id_user'")->num_rows();

        $this->db->select('order_items.*, orders.id');
        $this->db->from('order_items');
        $this->db->join('orders','orders.id = order_items.order_id','left');
        $this->db->where('orders.user_id',$id_user);
        $this->db->group_by('order_items.product_id');
        // $this->db->order_by('id','desc');
        $total_product =  $this->db->get()->num_rows();

        $this->db->select('order_items.*, orders.id');
        $this->db->from('order_items');
        $this->db->join('orders','orders.id = order_items.order_id','left');
        $this->db->where('orders.id',$id);
        $this->db->group_by('order_items.product_id');
        // $this->db->order_by('id','desc');
        $total_tabelproduct =  $this->db->get()->num_rows();

        $this->db->select('order_items.*, order_items.id as id_orderitem, inventories.qty as stock, orders.status, orders.shipping_cost, orders.total_price');
        $this->db->from('order_items');
        $this->db->join('inventories', 'inventories.product_id = order_items.product_id', 'left');
        $this->db->join('orders', 'orders.id = order_items.order_id', 'left');
        $this->db->where('orders.id', $id);
        // $this->db->where('orders.id', $id);
        $product =  $this->db->get()->result();

        $query = $this->product_model->get($id);
        $category = $this->category_model->get_view()->result();
        $unit = $this->unit_model->get_view()->result();
        $foto = $this->db->get_where('product_photo', ['produk_id' => $id])->result();

        $total = 0;
        foreach($product as $prd){
            $total = $total + $prd->base_total;
        }
        
        // if($data->num_rows() > 0){
            $item = $query->row();
            $this->_display('admin/orders/detail/detail', [
                'menu_active' => 'orders',
                'title' => 'Detail Order',
                'nama' => $this->session->userdata('full_name'),
                'role' => $this->session->userdata('role'),
                // 'page' => 'edit',
                'item' => $item,
                'total_order' => $total_order,
                'unit' => $unit,
                'order' => $order,
                'foto'=>$foto,
                'data'=>$data,
                'tot_product'=>$total_product,
                'product'=>$product,
                'total' => $total,
                'total_tabelprd'=>$total_tabelproduct,
                ]);
        
    }
    
}