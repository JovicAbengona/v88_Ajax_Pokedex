<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Main extends CI_Controller {
        
        /*  DOCU: This function is triggered by default which displays the sign in/wall page.
            Owner: Karen
        */
        public function index(){
            $this->load->view("index");
        }
    }
?>