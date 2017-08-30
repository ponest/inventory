<?php
/**
 * Created by PhpStorm.
 * User: ONEST
 * Date: 13/9/2016
 * Time: 10:27 AM
 */
    class Form_model extends CI_Model
    {

        public function login($username,$password_hash){
           $query = $this->db->query("SELECT * FROM tbl_login WHERE username = '{$username}' AND password = '{$password_hash}'");
            $results =$query->row_array();
            return $results;
        }

        public function new_user(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password_hash=md5($password);
            $num=1;
            $data1 = array('username' => $username, 'password' => $password_hash, 'Status' => $num);
            $this->db->insert('tbl_login', $data1);
        }

        public function product_list()
        {
                $category = $this->input->post('product_categories');
                $product_name = $this->input->post('product_name');
                $buying_price = $this->input->post('buying_price');
                $selling_price = $this->input->post('selling_price');
                $amount = $this->input->post('amount');
                $num = 1;
                $data = array(
                    'Product_name' => $product_name,
                    'Buying_price' => $buying_price,
                    'Selling_price' => $selling_price,
                    'Status' => $num,
                    'Category'=> $category
                );
                $this->db->insert('tbl_price_list', $data);
                $query = $this->db->query("SELECT Id FROM tbl_price_list WHERE Product_name = '$product_name'");
                $id_result = $query->row_array();
                $id = $id_result['Id'];
                $data1 = array('Product_id' => $id, 'Amount' => $amount, 'Status' => $num);
                $this->db->insert('tbl_stock', $data1);


        }

        public function product_existing_list()
        {
            $product_name = $this->input->post('product_name');
            $product_name = strtolower($product_name);
            $amount = $this->input->post('amount');
            $buying_price = $this->input->post('buying_price');
            $selling_price = $this->input->post('selling_price');
            $query_tbl_price_list = $this->db->query("SELECT * FROM tbl_price_list WHERE Product_name = '$product_name'");
            $tbl_result =  $query_tbl_price_list->row_array();
            $product_id = $tbl_result['Id'];
            $query_tbl_stock = $this->db->query("SELECT Amount FROM tbl_stock WHERE Product_id= $product_id ");
            $tbl_stock_result= $query_tbl_stock->row_array();
            $tbl_stock_amount = $tbl_stock_result['Amount'];
            $new_amount = $tbl_stock_amount + $amount;
            $data1 = array(
                'Amount' => $new_amount
            );
            $this->db->set($data1);
            $this->db->where("Product_id", $product_id);
            $this->db->update('tbl_stock', $data1);
            $data2 = array('Buying_price' => $buying_price,
                'Selling_price' => $selling_price);
            $this->db->set($data2);
            $this->db->where("Id",$product_id);
            $this->db->update("tbl_price_list",$data2);
        }

        function drop_down()
        {

            $query = $this->db->get("tbl_price_list");
            return $query->result();

        }
        public function Addo_drop_down(){
            $category = "Addo";
            $this->db->where("Category",$category);
            $query = $this->db->get("tbl_price_list");
            return $query->result();

        }
          public function Cosmetics_drop_down(){
            $category = "Cosmetics";
            $this->db->where("Category",$category);
            $query = $this->db->get("tbl_price_list");
            return $query->result();

        }



        public function Addo_sales_model(){
                $product_name = $this->input->post('product_name');
                $product_name = strtolower($product_name);
                $quantity_sold = $this->input->post('quantity_sold');
                $query = $this->db->query("SELECT * FROM tbl_price_list WHERE Product_name= '$product_name'");
                $result = $query->row_array();
                $product_name = $result['Product_name'];
                $buying_price = $result['Buying_price'];
                $selling_price = $result['Selling_price'];
                $product_id = $result['Id'];
                $query1 = $this->db->query("SELECT * FROM tbl_stock WHERE Product_Id = $product_id");
                $result = $query1->row_array();
                $amount = $result['Amount'];
                if($amount>= $quantity_sold) {
                    $cost_based_on_buying_price = $buying_price * $quantity_sold;
                    $cost_based_on_selling_price = $selling_price * $quantity_sold;
                    $actual_profit = $cost_based_on_selling_price - $cost_based_on_buying_price;
                    $date = date('m/d/Y');
                    $date_array = explode('/', $date);
                    $formated_date = mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]);
                    $num = 1;
                    $category = "Addo";
                    $data = array(
                        'Product_id' => $product_id,
                        'Product_name' => $product_name,
                        'Date' => $formated_date,
                        'Amount_sold' => $quantity_sold,
                        'cost_per_buying_price' => $cost_based_on_buying_price,
                        'cost_per_selling_price' => $cost_based_on_selling_price,
                        'actual_profit' => $actual_profit,
                        'Status' => $num,
                        'Category' => $category
                    );

                    $this->db->insert("tbl_sales", $data);
                    $this->db->where("Product_id", $product_id);
                    $query_tbl_stock = $this->db->get("tbl_stock");
                    $query_tbl_stock_data = $query_tbl_stock->row_array();
                    $tbl_stock_amount = $query_tbl_stock_data["Amount"];
                    $new_amount = $tbl_stock_amount - $quantity_sold;
                    $new_data = array("Amount" => $new_amount);
                    $this->db->set($new_data);
                    $this->db->where("Product_id", $product_id);
                    $this->db->update("tbl_stock", $new_data);
                }else{

                    return false;
                }
            }


              public function Cosmetics_sales_model(){
                $product_name = $this->input->post('product_name');
                $product_name = strtolower($product_name);
                $quantity_sold = $this->input->post('quantity_sold');
                $query = $this->db->query("SELECT * FROM tbl_price_list WHERE Product_name = '$product_name'");
                $result = $query->row_array();
                $product_name = $result['Product_name'];
                $buying_price = $result['Buying_price'];
                $selling_price = $result['Selling_price'];
                $product_id = $result['Id'];
                $query1 = $this->db->query("SELECT * FROM tbl_stock WHERE Product_Id = '$product_id'");
                $result = $query1->row_array();
                $amount = $result['Amount'];
                if($amount>= $quantity_sold) {
                $cost_based_on_buying_price = $buying_price * $quantity_sold;
                $cost_based_on_selling_price = $selling_price * $quantity_sold;
                $actual_profit = $cost_based_on_selling_price - $cost_based_on_buying_price;
                $date = date('m/d/Y');
                $date_array = explode('/', $date);
                $formated_date = mktime(0, 0, 0, $date_array[0], $date_array[1], $date_array[2]);
                $num = 1;
                $category="Cosmetics";
                $data = array(
                    'Product_id' => $product_id,
                    'Product_name'=>$product_name,
                    'Date' => $formated_date,
                    'Amount_sold' => $quantity_sold,
                    'cost_per_buying_price' => $cost_based_on_buying_price,
                    'cost_per_selling_price' => $cost_based_on_selling_price,
                    'actual_profit' => $actual_profit,
                    'Status' => $num,
                    'Category'=>$category
                );

                $this->db->insert("tbl_sales", $data);
                $this->db->where("Product_id", $product_id);
                $query_tbl_stock = $this->db->get("tbl_stock");
                $query_tbl_stock_data =$query_tbl_stock->row_array();
                $tbl_stock_amount=  $query_tbl_stock_data["Amount"];
                $new_amount = $tbl_stock_amount - $quantity_sold;
                $new_data=array("Amount" => $new_amount);
                $this->db->set($new_data);
                $this->db->where("Product_id",$product_id);
                $this->db->update("tbl_stock",$new_data);
            }
                else{
                  return false;
                }
              }


        }







