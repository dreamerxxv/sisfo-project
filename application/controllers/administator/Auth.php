<?php

class Auth extends CI_Controller{
    public function index(){
        $this->load->view('templates_administator/header');
        $this->load->view('administator/login');
        $this->load->view('templates_administator/footer');
    }

    public function proses_login(){
        if($this->form_validation->run() == FALSE){
            $this->form_validation->set_rules('username','username','required');
            $this->form_validation->set_rules('password','password','required');

            $this->load->view('templates_administator/header');
            $this->load->view('administator/login');
            $this->load->view('templates_administator/footer');
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $username;
            $pass = MD5($password);

            $cek = $this->m_login->cek_login($user,$pass);

            if($cek->num_rows() > 0){
                foreach($cek->result() as $ck){
                    $sess_data['username'] = $ck->username;
                    $sess_data['email'] = $ck->email;
                    $sess_data['level'] = $ck->level;

                    $this->session->set_userdata($sess_data);
                }
                if($sess_data['level'] == 'admin'){
                    redirect('administator/dashboard');
                }else{
                    $this->session->set_flashdata('pesan','Maaf username atau password anda salah');
                    redirect('administator/auth');
                }
            }else{
                $this->session->set_flashdata('pesan','Maaf username atau password anda salah');
                    redirect('administator/auth');
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('administator/auth');
    }
}
?>