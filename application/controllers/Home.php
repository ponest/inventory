<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('form_model');
        $this->load->model('output_model');
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
      //$this->output->cache(5);
    }

    public function index()
    {
        $data["status"]="";
        $this->load->view('login_view',$data);
    }

    public function homepage_loader(){
        $set_session = $this->session->userdata("logged_in");
        if(isset($set_session)){
            $data["check"] = $this->output_model->stock_cheker();
            $data["record"]=$this->output_model->output_data();
            $data['total']=$this->output_model->total();
            $this->load->view("header",$data);
            $this->load->view("sales_output_view",$data);
            $this->load->view("footer",$data);
        }else{
            redirect(base_url("home_index"));
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'UserName', 'required',  array('required'=> 'Please Enter The Username.'));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'Please Enter the Password'));
        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password_hash=md5($password);
            $login_credentials = $this->form_model->login($username, $password_hash);
            $login_data = array(
                'username' => $username
            );
            if (count($login_credentials) > 0) {
                $this->session->set_userdata('logged_in', $login_data['username']);
                $this->load->model("output_model");
                $data['total']=$this->output_model->total();
                $set_session = $this->session->userdata("logged_in");
                if(isset($set_session)) {
                    $data["check"] = $this->output_model->stock_cheker();
                    $data["record"] = $this->output_model->output_data();
                    $this->load->view('header', $data);
                    $this->load->view('sales_output_view', $data);
                    $this->load->view('footer', $data);
                }
            } else {
                $data['status'] = "Wrong Username or Password!!!";
                $this->load->view('login_view',$data);
            }
        } else {
            $data['status'] = "";
            $this->load->view('login_view',$data);
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url("home_index"));
    }

    public function change_password()
    {
        $this->form_validation->set_rules('username','UserName','required');
        $this->form_validation->set_rules('previous_password','Previous_password','required');
        $this->form_validation->set_rules('password','New Password','required');
        $this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');
            if ($this->form_validation->run()==true){
                $prev_password=$this->input->post("previous_password");
                $username=$this->input->post("username");
                $new_password=$this->input->post("password");
                $credentials = $this->output_model->change_password($username,$prev_password);
                if(count($credentials)>0)
                {
                    $this->output_model->update_password($username,$prev_password,$new_password);
                    $data["status"]="";
                    $this->load->view("add_user",$data);
                }else{
                $data["status"]="wrong username or Password!!";
                $this->load->view("add_user",$data);
            }
        }else{
            $data["status"]="";
            $this->load->view("add_user",$data);
        }
    }
    public function add_user_loader(){
        $data["status"]="";
        $this->load->view("header");
        $this->load->view("add_user",$data);
        $this->load->view("footer");

    }

   public function new_user(){
        $this->form_validation->set_rules('username', 'UserName', 'required|is_unique[tbl_login.username]',
            array('required'=> 'Please Enter The Username.','is_unique'=>'UserName Already Exist'));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'Please Enter the Password'));
        $this->form_validation->set_rules('confirm_password', 'Re Enter Password', 'required|matches[password]', array('required' => 'Please Enter the Password'));
        if ($this->form_validation->run() == TRUE) {
            $this->form_model->new_user();
            $set_session = $this->session->userdata("logged_in");
            $data["check"] = $this->output_model->stock_cheker();
            $data["record"] = $this->output_model->output_data();
                $data['total'] = $this->output_model->total();
                $this->load->view("header", $data);
                $this->load->view("sales_output_view", $data);
                $this->load->view("footer", $data);

        }else{
            $data["status"]="";
            $this->load->view("header");
            $this->load->view("add_user",$data);
            $this->load->view("footer");

        }

    }

    public function product()
    {
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('buying_price', 'Buying Price', 'required|greater_than[0]');
        $this->form_validation->set_rules('selling_price', 'Selling Price', 'required|greater_than[0]');
        $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]');
        if ($this->form_validation->run()== true) {
            $this->form_model->product_list();
            $data["records"]= $this->output_model->product_model();
            $this->load->view("header");
            $this->load->view("product_list",$data);
            $this->load->view("footer");

        }else{

            $data['selected'] = $this->input->post("selected_product");
            $this->load->view("header");
            $this->load->view("add_products",$data);
            $this->load->view("footer");


        }
    }

   public function existing_product()
    {
        $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]');
        $this->form_validation->set_rules('buying_price', 'Buying Price', 'required|greater_than[0]');
        $this->form_validation->set_rules('selling_price', 'Selling Price', 'required|greater_than[0]');
        if ($this->form_validation->run() == true) {
            $this->form_model->product_existing_list();
            $data['records'] = $this->form_model->drop_down();
            $data["records"]= $this->output_model->product_model();
            $this->load->view("header");
            $this->load->view("product_list", $data);
            $this->load->view("footer");

        }else{
            $data['records'] = $this->form_model->drop_down();
            $data['selected'] = $this->input->post("selected_product");
            $this->load->view("header");
            $this->load->view("add_products", $data);
            $this->load->view("footer");

        }
    }

    public function save_product($type){
        if($type == "new"){
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            $this->form_validation->set_rules('buying_price', 'Buying Price', 'required|greater_than[0]');
            $this->form_validation->set_rules('selling_price', 'Selling Price', 'required|greater_than[0]');
            $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]');
            if ($this->form_validation->run()== true) {
                $this->form_model->product_list();
                $data["records"]= $this->output_model->product_model();
                $this->load->view("header");
                $this->load->view("product_list",$data);
                $this->load->view("footer");

            }else{
                $data['selected'] = $this->input->post("selected_product");
                $this->load->view("header");
                $this->load->view("new_product",$data);
                $this->load->view("footer");

            }
        }else if($type == "existing"){
            $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]');
            $this->form_validation->set_rules('buying_price', 'Buying Price', 'required|greater_than[0]');
            $this->form_validation->set_rules('selling_price', 'Selling Price', 'required|greater_than[0]');
            if ($this->form_validation->run() == true) {
                $this->form_model->product_existing_list();
                $data['records'] = $this->form_model->drop_down();
                $data["records"]= $this->output_model->product_model();
                $this->load->view("header");
                $this->load->view("product_list", $data);
                $this->load->view("footer");

            }else{
                $data['records'] = $this->form_model->drop_down();
                $data['selected'] = "existing product";
                $this->load->view("header");
                $this->load->view("existing_product", $data);
                $this->load->view("footer");

            }
        }
    }


    public function save_reg($type){
        if ($type == "reg"){

            $this->form_validation->set_rules('username', 'UserName', 'required|is_unique[tbl_login.username]',
                array('required'=> 'Please Enter The Username.','is_unique'=>'UserName Already Exist'));
            $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'Please Enter the Password'));
            $this->form_validation->set_rules('confirm_password', 'Re Enter Password', 'required|matches[password]', array('required' => 'Please Enter the Password'));
            if ($this->form_validation->run() == TRUE) {
                $this->form_model->new_user();
                $set_session = $this->session->userdata("logged_in");
                $data["check"] = $this->output_model->stock_cheker();
                $data["record"] = $this->output_model->output_data();
                $data['total'] = $this->output_model->total();
                $data["status"]="Successful Registered!!";
                $this->load->view("header");
                $this->load->view("register", $data);
                $this->load->view("footer");


            }else{
                $data["status"]="";
                $this->load->view("header");
                $this->load->view("register",$data);
                $this->load->view("footer");

            }

        }elseif ($type == "reset"){
            $this->form_validation->set_rules('username','UserName','required');
            $this->form_validation->set_rules('previous_password','Previous_password','required');
            $this->form_validation->set_rules('password','New Password','required');
            $this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');
            if ($this->form_validation->run()==true){
                $prev_password=$this->input->post("previous_password");
                $username=$this->input->post("username");
                $new_password=$this->input->post("password");
                $credentials = $this->output_model->change_password($username,$prev_password);
                if(count($credentials)>0)
                {
                    $this->output_model->update_password($username,$prev_password,$new_password);
                    $data["status"]="Successful reseted!!!";
                    $this->load->view("reset",$data);

                }else{
                    $data["status"]="wrong username or Password!!";
                    $this->load->view("reset",$data);

                }
            }else{
                $data["status"]="";
                $this->load->view("reset",$data);

            }
        }
    }

    public function save_sales($type){
        if ($type == "a_addo"){
            $this->form_validation->set_rules('quantity_sold','Quantity Sold','required',array('required'=> 'Please Enter The Amount'));
            if ($this->form_validation->run()==true){
                $this->form_model->Addo_sales_model();
                $data["check"] = $this->output_model->stock_cheker();
                $data["record"]=$this->output_model->Addo_output_data();
                $option = "Addo";
                $data['total']=$this->output_model->category_total($option);
                $data['Addo']=$this->form_model->Addo_drop_down();
                $this->load->view("header");
                $this->load->view("addo",$data);
                $this->load->view("footer");

            }else{
                $data['Addo']=$this->form_model->Addo_drop_down();
                $this->load->view("header");
                $this->load->view('addo',$data);
                $this->load->view("footer");

            }
        }elseif ($type == "a_cosmetics"){

            $option = "Cosmetics";
            $this->form_validation->set_rules('quantity_sold','Quantity Sold','required',array('required'=> 'Please Enter The Amount'));
            if ($this->form_validation->run()==true){
                $this->form_model->Cosmetics_sales_model();
                $data["check"] = $this->output_model->stock_cheker();
                $data["record"]=$this->output_model->Cosmetics_output_data();
                $data['total']=$this->output_model->category_total($option);
                $data['Cosmetics']=$this->form_model->Cosmetics_drop_down();
                $this->load->view("header");
                $this->load->view("cosmetics",$data);
                $this->load->view("footer");

            }else{
                $data['Cosmetics']=$this->form_model->Cosmetics_drop_down();
                $this->load->view("header");
                $this->load->view('cosmetics',$data);
                $this->load->view("footer");

            }

        }

    }

   public function sales_function()
    {
            $data["Addo"] = $this->form_model->Addo_drop_down();
            $data["Cosmetics"] =  $this->form_model->Cosmetics_drop_down();
        $this->load->view("header");
        $this->load->view("sales_form",$data);
        $this->load->view("footer");

    }

    public function Addo_sales_action()
    {
        $option = "Addo";
        $this->form_validation->set_rules('quantity_sold','Quantity Sold','required',array('required'=> 'Please Enter The Amount'));
        if ($this->form_validation->run()==true){
            $this->form_model->Addo_sales_model();
            $data["check"] = $this->output_model->stock_cheker();
            $data["record"]=$this->output_model->Addo_output_data();
            $data['total']=$this->output_model->category_total($option);
            $this->load->view("header");
            $this->load->view("sales_output_view",$data);
            $this->load->view("footer");
        }else{
            $data['records']=$this->form_model->Addo_drop_down();
            $this->load->view("header");
            $this->load->view('sales_form',$data);
            $this->load->view("footer");


        }
    }

         public function Cosmetics_sales_action(){
             $option = "Cosmetics";
        $this->form_validation->set_rules('quantity_sold','Quantity Sold','required',array('required'=> 'Please Enter The Amount'));
        if ($this->form_validation->run()==true){
            $this->form_model->Cosmetics_sales_model();
            $data["check"] = $this->output_model->stock_cheker();
            $data["record"]=$this->output_model->Cosmetics_output_data();
            $data['total']=$this->output_model->category_total($option);
            $this->load->view("header",$data);
            $this->load->view("sales_output_view",$data);
            $this->load->view("footer",$data);
        }else{
            $data['records']=$this->form_model->Cosmetics_drop_down();
            $this->load->view("header");
            $this->load->view('sales_form',$data);
            $this->load->view("footer");

        }
        }

        public function category_sales_output(){
            $option = $this->input->post("select_sales");
            if($option =="Cosmetics")
            {
                $data["check"] = $this->output_model->stock_cheker();
                $data["record"]=$this->output_model->Cosmetics_output_data($option);
                $data['total']=$this->output_model->category_total($option);
                $this->load->view("header");
                $this->load->view("sales_output_view",$data);
                $this->load->view("footer");
            }elseif($option =="Addo") {
                $data["check"] = $this->output_model->stock_cheker();
                $data['record'] = $this->output_model->Addo_output_data($option);
                $data['total'] = $this->output_model->category_total($option);
                $this->load->view("header");
                $this->load->view("sales_output_view",$data);
                $this->load->view("footer");            }elseif ($option=="All Categories"){
                $data["check"] = $this->output_model->stock_cheker();
                $data['record'] = $this->output_model->output_data($option);
                $data['total'] = $this->output_model->total();
                $this->load->view("header");
                $this->load->view("sales_output_view",$data);
                $this->load->view("footer");            }
        }
    public function product_list_loader(){
        $data["records"]= $this->output_model->product_model();
        $this->load->view("header");
        $this->load->view("product_list",$data);
        $this->load->view("footer");

    }

    public function product_list(){
        $data["records"]= $this->output_model->product_model();
        $this->load->view("header");
        $this->load->view("product_list",$data);
        $this->load->view("footer");

    }

    public function delete_controller(){
        $this->output_model->delete();
        $data["records"]= $this->output_model->product_model();
        $this->load->view("header");
        $this->load->view("product_list",$data);
        $this->load->view("footer");


    }

    public function edit_controller(){
        $data["records"]= $this->output_model->edit();
        $this->load->view("header");
        $this->load->view("edit_product",$data);
        $this->load->view("footer");

    }

    public function edit_form(){
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('buying_price', 'Buying Price', 'required|greater_than[0]');
        $this->form_validation->set_rules('selling_price', 'Selling Price', 'required|greater_than[0]');
        if ($this->form_validation->run() == true) {
            $this->output_model->edit_form();
            $data["records"]= $this->output_model->product_model();
            $this->load->view("header");
            $this->load->view("product_list",$data);
            $this->load->view("footer");


        }else{
            $this->load->view("header");
            $this->load->view("edit_product");
            $this->load->view("footer");

        }
    }

    public function sales_form_controller(){
        $data["records"]= $this->output_model->edit_sales_form();
        $this->load->view("header");
        $this->load->view("edit_sales",$data);
        $this->load->view("footer");

    }
    public function edit_sales(){
        $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]');
        if ($this->form_validation->run() == true) {
            $this->output_model->edit_sales();
            $data["check"] = $this->output_model->stock_cheker();
            $data["record"]=$this->output_model->output_data();
            $data['total']=$this->output_model->total();
            $this->load->view("header");
            $this->load->view("sales_output_view",$data);
            $this->load->view("footer");
        }else{
            $this->load->view("header");
            $this->load->view("edit_sales");
            $this->load->view("footer");

        }
        }

    public function delete_sales(){
        $this->output_model->delete_sales();
        $data["check"] = $this->output_model->stock_cheker();
        $data["record"] = $this->output_model->output_data();
        $data['total'] = $this->output_model->total();
        $this->load->view("header");
        $this->load->view("sales_output_view",$data);
        $this->load->view("footer");    }

    public function add_products(){
        $data['selected'] = "new product";
        $data["records"]= $this->output_model->product_model();
        $this->load->view("header");
        $this->load->view("add_products",$data);
        $this->load->view("footer");


    }

    public function get_selected_form($form_name){
        $form_name = utf8_decode(urldecode($form_name));
        if($form_name == "new product"){
            $this->load->view("new_product");

        }else{
            $data["records"]= $this->output_model->product_model();
            $this->load->view("existing_product",$data);

        }
    }

    public function get_selected_reg($reg_name){
        $reg_name = utf8_decode(urldecode($reg_name));
        if ($reg_name == "register"){
            $this->load->view("register");
        }else{
            $data["status"]="";
            $this->load->view("reset",$data);
        }

    }

    public function get_selected_sales($sales_name){
        $sales_name = utf8_decode(urldecode($sales_name));
        if ($sales_name == "addo"){
            $data["Addo"] = $this->form_model->Addo_drop_down();
            $this->load->view("addo",$data);
        }else{
            $data["Cosmetics"] =  $this->form_model->Cosmetics_drop_down();
            $this->load->view("cosmetics",$data);
        }

    }
    public function specified_date(){
        $this->form_validation->set_rules("specified_date", "specified date","required");
        if($this->form_validation->run()==true){
            $data["check"] = $this->output_model->stock_cheker();
            $data['record']= $this->output_model->specified_date();
            $data['total']=$this->output_model->total_specified_date();
            $this->load->view("header");
            $this->load->view("sales_output_view",$data);
            $this->load->view("footer");        }else{
            $data["check"] = $this->output_model->stock_cheker();
            $data["record"]=$this->output_model->output_data();
            $data['total']=$this->output_model->total();
            $this->load->view("header");
            $this->load->view("sales_output_view",$data);
            $this->load->view("footer");        }

    }

    public function interval_date(){
        $this->form_validation->set_rules("date1", "initial date","required");
        $this->form_validation->set_rules("date2", "last date","required");
        if($this->form_validation->run()==true){
            $data["check"] = $this->output_model->stock_cheker();
            $data['record'] = $this->output_model->interval_date();
        $data['total']=$this->output_model->total_interval_date();
            $this->load->view("header");
            $this->load->view("sales_output_view",$data);
            $this->load->view("footer");
    }else{
            $data["check"] = $this->output_model->stock_cheker();
            $data["record"]=$this->output_model->output_data();
            $data['total']=$this->output_model->total();
            $this->load->view("header");
            $this->load->view("sales_output_view",$data);
            $this->load->view("footer");    }
    }

    public function stock_cheker(){
        $data["check"] = $this->output_model->stock_cheker();
        $data["record"]=$this->output_model->output_data();
        $data['total']=$this->output_model->total();
        $this->load->view("header");
        $this->load->view("sales_output_view",$data);
        $this->load->view("footer");
    }
    public function homepage(){
        $data["check"] = $this->output_model->stock_cheker();
        $data["record"]=$this->output_model->output_data();
        $data['total']=$this->output_model->total();
        $this->load->view("header");
        $this->load->view("sales_output_view",$data);
        $this->load->view("footer");
    }
}



