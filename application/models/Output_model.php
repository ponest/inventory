<?php
/**
 * Created by PhpStorm.
 * User: ONEST
 * Date: 9/18/2016
 * Time: 12:10 PM
 */
class Output_model extends CI_Model{
    public function output_data(){
        $this->db->order_by('id', 'DESC');
//        $this->db->limit(5);
        $query=$this->db->get("tbl_sales");
        if ($query->num_rows()>0){
            return $query->result();
        }else{
            echo "";
        }
    }

      public function Addo_output_data(){
        $category="Addo";
        $this->db->order_by('id', 'DESC');
//        $this->db->limit(5);
        $this->db->where("Category",$category);
        $query=$this->db->get("tbl_sales");
        if ($query->num_rows()>0){
            return $query->result();
        }else{
            echo "";
        }
    }


      public function Cosmetics_output_data(){
        $category="Cosmetics";
        $this->db->order_by('id', 'DESC');
//        $this->db->limit(5);
        $this->db->where("Category",$category);
        $query=$this->db->get("tbl_sales");
        if ($query->num_rows()>0){
            return $query->result();
        }else{
            echo "";
        }
    }


    public function category_sales_output($option){
        $this->db->order_by('id', 'DESC');
//        $this->db->limit(5);
        $this->db->where("Category",$option);
        $query=$this->db->get("tbl_sales");
        if ($query->num_rows()>0){
            return $query->result();
        }else{
            echo "";
        }
    }

    public function total(){
        $this->db->select_sum('actual_profit');
        $query = $this->db->get('tbl_sales');
        return $query->result();
    }
    public function category_total($option){
        $this->db->where("Category",$option);
        $this->db->select_sum('actual_profit');
        $query = $this->db->get('tbl_sales');
        return $query->result();

    }
    public function total_specified_date(){
        $date = $this->input->post("specified_date");
        $date_array = explode("-",$date);
        $formatted_date = mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);
        $this->db->where("Date",$formatted_date);
        $this->db->select_sum('actual_profit');
        $query = $this->db->get('tbl_sales');
        return $query->result();
    }

    public function total_interval_date(){
        $date1 = $this->input->post("date1");
        $date2 = $this->input->post("date2");
        $date_array1 = explode("-",$date1);
        $formatted_date1 = mktime(0,0,0,$date_array1[1],$date_array1[2],$date_array1[0]);
        $date_array2 = explode("-",$date2);
        $formatted_date2 = mktime(0,0,0,$date_array2[1],$date_array2[2],$date_array2[0]);
        $this->db->where("Date>=",$formatted_date1);
        $this->db->where("Date<=",$formatted_date2);
        $this->db->select_sum('actual_profit');
        $query = $this->db->get('tbl_sales');
        return $query->result();
    }
    public function stock_model(){

        $query_result=$this->db->query("SELECT P.Id as product_id, P.Product_name as Product_name, S.Amount as Amount 
         FROM tbl_price_list P, tbl_stock S WHERE P.Id=S.Product_id AND S.Status=1 AND P.Status=1");
        if ($query_result->num_rows()>0){
            return $query_result->result();

        }else{
            echo "";
        }

    }

    public function product_model(){

        $query = $this->db->query("SELECT S.Amount as Amount,S.Product_id,P.Id , P.Product_name as Product_name,P.Buying_price
        as Buying_price, P.Selling_price as Selling_price  FROM tbl_stock S,tbl_price_list P  WHERE P.Id = S.Product_id AND P.Status=1 AND S.Status=1");
        if($query->num_rows()>0)
        {
            return $query->result();
        }else{
            echo "";
        }

    }

    public function stock_cheker(){
       $query = $this->db->query("SELECT S.Amount as Amount,S.Product_id as Product_id,P.Id as Id,P.Product_name as Product_name FROM tbl_stock S,tbl_price_list P
          WHERE P.Id=S.Product_id");

        return $query->result();
    }

    public function delete(){

        if(isset($_GET['id'])){

            $id = $_GET['id'];
            $this->db->query("DELETE FROM tbl_price_list WHERE Id = {$id}");
            $this->db->query("DELETE FROM tbl_stock WHERE Product_id = {$id}");
        }
    }
    public function delete_sales(){

        if(isset($_GET['id'])){

            $id = $_GET['id'];
            $this->db->query("DELETE FROM tbl_sales WHERE Id = {$id}");

        }
    }

    public function edit(){
        if(isset($_GET['id'])){

            $id = $_GET['id'];
            $query = $this->db->query("SELECT * FROM tbl_price_list WHERE Id = {$id}");
            return $query->result();

        }

    }

    public function edit_form(){
        $product_name = $this->input->post('product_name');
        $buying_price = $this->input->post('buying_price');
        $selling_price = $this->input->post('selling_price');
        $data = array(
            'Buying_price' => $buying_price,
            'Selling_price' => $selling_price
        );
        $this->db->set($data);
        $this->db->where("Product_name", $product_name);
        $this->db->update('tbl_price_list', $data);
    }

    public function edit_sales_form(){
        if(isset($_GET['id'])){

            $id = $_GET['id'];
            $query = $this->db->query("SELECT * FROM tbl_sales WHERE Id = {$id}");
            return $query->result();

        }
    }

    public function edit_sales(){
        $product_name = $this->input->post('product_name');
        $amount = $this->input->post('amount');


        $query = $this->db->query("SELECT * FROM tbl_price_list WHERE Product_name = '$product_name'");
        $result = $query->row_array();
        $buying_price = $result['Buying_price'];
        $selling_price = $result['Selling_price'];
        $sales_id=$result['Id'];
        $cost_based_on_buying_price = $buying_price * $amount;
        $cost_based_on_selling_price = $selling_price * $amount;
        $actual_profit = $cost_based_on_selling_price - $cost_based_on_buying_price;
        $data = array(
            'Amount_sold' => $amount,
            'actual_profit'=> $actual_profit
        );
        $this->db->set($data);
        $this->db->where("Product_id",$sales_id);
        $this->db->update('tbl_sales', $data);

    }

    public function interval_date(){
        $date1 = $this->input->post("date1");
        $date2 = $this->input->post("date2");
        $date_array1 = explode("-",$date1);
        $formatted_date1 = mktime(0,0,0,$date_array1[1],$date_array1[2],$date_array1[0]);
        $date_array2 = explode("-",$date2);
        $formatted_date2 = mktime(0,0,0,$date_array2[1],$date_array2[2],$date_array2[0]);
        $query = $this->db->query("SELECT * from tbl_sales  where Date BETWEEN $formatted_date1 and $formatted_date2");
        if ($query->num_rows()>0){
            return $query->result();

        }else{
            echo "";
        }

    }
    public function specified_date(){
        $date = $this->input->post("specified_date");
        $date_array = explode("-",$date);
        $formatted_date=mktime(0,0,0,$date_array[1],$date_array[2],$date_array[0]);
        $query = $this->db->query("SELECT * FROM tbl_sales WHERE Date = '$formatted_date'");
        if ($query->num_rows()>0){
            return $query->result();

        }else{
            echo "";
        }

    }

    public function change_password($username,$prev_password)
    {
        $this->db->where("username", $username);
        $this->db->where("password",md5($prev_password));
        $query = $this->db->get("tbl_login");
        return $query->row_array();
    }

    public function update_password($username,$prev_password,$new_password){
        $data=array("password"=> md5($new_password));
        $array = array('username' => $username, 'password' => md5($prev_password));
        $this->db->set($data);
        $this->db->where($array);
        $this->db->update("tbl_login",$data);

    }


}
