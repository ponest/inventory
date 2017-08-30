<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['interval_date']="home/interval_date";
$route['specified_date']="home/specified_date";
$route['add_products']="home/add_products";
$route['delete']="home/delete_controller";
$route['delete_sales']="home/delete_sales";
$route['edit_sales']="home/sales_form_controller";
$route['edit_sales_form']="home/edit_sales";
$route['edit']="home/edit_controller";
$route['edit_form']="home/edit_form";
$route['homepage']='home/homepage';
$route['product']='home/product';
$route['product1']='home/existing_product';
$route['login']='home/login';
$route['logout']='home/logout';
$route['change_password']='home/change_password_loader';
$route['reset_password']='home/change_password';
$route['add_new_user']='home/add_user_loader';
$route['add_user']='home/new_user';
//$route['stock']='home/stock_loader';
$route['product_list']='home/product_list_loader';
$route['get_selected_form/(:any)']='home/get_selected_form/$1';
$route['save_product/(:any)']='home/save_product/$1';
$route['get_selected_reg/(:any)']='home/get_selected_reg/$1';
$route['save_reg/(:any)']='home/save_reg/$1';
$route['get_selected_sales/(:any)']='home/get_selected_sales/$1';
$route['save_sales/(:any)']='home/save_sales/$1';
//$route['existing_product_form']='home/loading_form_for_existing_product';
//$route['new_product_form']='home/loading_form_for_new_product';
$route['Addo_sales_action']='home/Addo_sales_action';
$route['Cosmetics_sales_action']='home/Cosmetics_sales_action';
$route['category_sales_output']='home/category_sales_output';
$route['sales_form']='home/sales_function';
$route['home_index'] = 'home';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
