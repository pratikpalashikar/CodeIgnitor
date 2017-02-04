<?php

/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/3/2016
 * Time: 12:19 AM
 */
class CommonCtrl extends CI_Controller
{

    public function index(){
        $this->load->view('page1_Login');
    }

    public function page2(){
        $this->load->view('page2_search');
    }

    public function page3(){
        $this->load->view('page3_buy');
    }

    public function buyCompleted(){
        $this->load->view('page3_buy_done');
    }

    public function navigateLogout(){
        $this->load->view('logout');
    }


    public function registerNavigate(){
        $this->load->view('page4_register');
    }


    public function logout(){
        $this->load->model('CommonModel');
        $val = $this->CommonModel->logout();
        echo $val;
    }

    public function fetchAddedItems(){
        $this->load->model('CommonModel');
        $val = $this->CommonModel->fetchAddedItems();
        echo $val;

    }

    public function validateLogin(){

        $this->load->model('CommonModel');
        $val = $this->CommonModel->login();
        if($val){
            echo true;
        }
        else{
            echo false;
        }

    }

    public function fetch_cart_items()
    {

        $this->load->model('CommonModel');
        $val = $this->CommonModel->get_cart_items();
        echo $val;

    }

    public function processAddToCart(){

        $this->load->model('CommonModel');
        $val = $this->CommonModel->processAddToCart();
        echo $val;

    }

    public function getBooksByAuthor(){
        $this->load->model('CommonModel');
        $val = $this->CommonModel->getBooksByAuthor();
        echo $val;
    }

    public function getBooksByTitle(){
        $this->load->model('CommonModel');
        $val = $this->CommonModel->getBooksByTitle();
        echo $val;
    }

    public function buyBooks(){
        $this->load->model('CommonModel');
        $val = $this->CommonModel->buyBooks();
        echo $val;
    }


    public function register(){
        $this->load->model('CommonModel');
        $val = $this->CommonModel->register();
        echo $val;
    }




}