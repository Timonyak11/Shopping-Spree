<?php
class Store extends CI_Controller {
	public function index()
	{
		$this->load->model('Item');
		$this->load->model('Cart');
		$data['items'] = $this->Item->get_all_items();
		$data['orders'] = count($this->Cart->get_all_orders());
        $this->load->view('store', $data);
	}   
	public function add_to_cart(){
		$inputed_quantity = $this->input->post('quantity');
		$this->load->model('Cart');

		if($inputed_quantity <= 0){
			$this->session->set_flashdata('error', 'Invalid Quantity');
			redirect('store');
		}

		$result = $this->Cart->validate($this->input->post());

		if($result == "update") {
			$old_data = $this->Cart->get_olddata_by_id($this->input->post('item_id'));
			$new_quantity = $old_data['quantity'] + $inputed_quantity;
			$old_data['quantity'] = $new_quantity;
            $this->Cart->update_order($old_data);
			$this->session->set_flashdata('success', 'Item Added to Cart');
            redirect('store');
		} else {
			$this->Cart->add_order($this->input->post());
			$this->session->set_flashdata('success', 'Item Added to Cart');
            redirect('store');
		}			
	}
	public function cartpage()
	{
		$this->load->model('Cart');
		$data['orders'] = $this->Cart->get_all_orders();
		$data['total_price'] = 0;
		$variables = $this->Cart->get_total_price();
		foreach($variables as $variable){
			$result = $variable['quantity'] * $variable['value'];
			$data['total_price'] += $result;
		}
		$this->load->view('cartpage', $data);
	}
	public function check_out(){
		$this->load->model('CheckOut');
		$result = $this->CheckOut->validate($this->input->post());

		if($result == 'valid'){
			$this->CheckOut->check_out($this->input->post());
			$this->session->set_flashdata('success', "You Have Checked Out Your Orders");
			redirect('store/cartpage');
		} else{
			$this->session->set_flashdata('errors', $this->view_data["errors"] = validation_errors());
			redirect('store/cartpage');
		}
	}
	public function delete($order_id){
		$this->load->model('Cart');
		$this->Cart->delete_order($order_id);
		$this->session->set_flashdata('delete_success', 'Order Removed');
		redirect('store/cartpage');
	}
}
