<?php

/**
 * Description of Home
 *
 * @author a00906732
 */
class Home extends Application {

    function __construct() {
        parent::__construct();
    }
    
    function index(){
        $this->data['title'] = "Stock Ticker Agent";
        
        // Get stock data
        $this->stocks();
        // Get player data
        $this->players();

        $this->data['pagebody'] = 'home_page';

        $session_data = $this->session->userdata('logged_in');
        
        //Check user login, display menubar
        if($this->session->userdata('logged_in')){
            if($session_data['role'] == 'admin'){
                $session_data = $this->session->userdata('logged_in');
                $this->data['user'] = $session_data['name'];
                $this->data['menubody'] = 'menucontent_admin';
                $this->data['avatar'] = '/uploads/' . $session_data['name'] . '.gif';
            }else{
                $session_data = $this->session->userdata('logged_in');
                $this->data['user'] = $session_data['name'];
                $this->data['menubody'] = 'menucontent';
                $this->data['avatar'] = '/uploads/' . $session_data['name'] . '.gif'; 
            }
        }
        else{
            $this->data['menubody'] = 'menucontent_login';
        }
        $this->render();
    }
    
    // Get data from stock model
    function stocks(){
        $results = $this->stock->getAllStocksFromServer();
        $this->data['stocks'] = $results;
        $this->data['recentMove'] = $this->stock->getRecentMovements();
        $this->data['recentTran'] = $this->stock->getRecentTransactions();
    }
    
    //Get player data from player model
    function players(){
        $results2 = $this->player->all();
        $this->data['players'] = $results2;
    }

//    //Login user in
//    function login(){
//        $username = $this->input->post('username');
//
//        // Save session
//        $sess_array = array(
//            'id'    => 1,
//            'name' => $username,
//            'isloggedin'=> 1
//        );
//        $this->session->set_userdata('logged_in', $sess_array);
//        
//        redirect('home', 'refresh');
//    }

    //Log user out
    function logout(){
        // Unset session and destroy
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }
    
}
