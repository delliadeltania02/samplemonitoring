<?php
class Dashboard extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['content'] = 'dashboard/index'; // view yang akan dimuat di dalam layout
        $this->load->view('layout/tailadmin', $data);
    }
}
