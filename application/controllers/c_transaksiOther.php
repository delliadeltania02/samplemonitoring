<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class c_transaksiOther extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->helper(array('url','form'));
        
    }

}