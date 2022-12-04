<?php

class M_login extends CI_Model{
    public function cek_login($username, $password)
    {
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        return $this->db->get('user');
    }

    public function getLoginData($user, $pass)
    {
        $u = $user;
        $p = MD5($pass);

        $query_cekLogin = $this->db->get_where('user',array('username' => $u, 'password' => $p));

        if(count($query_cekLogin->result()) > 0){
            foreach($query_cekLogin->result() as $qck){
                foreach($query_cekLogin->result() as $ck){
                    $sess_data['logged_in'] = TRUE;
                    $sess_data['username']  = $ck->username;
                    $sess_data['password']  = $ck->password;
                    $sess_data['level']     = $ck->level;
                    $this->session->set_userdata($sess_data);
                }
                redirect('administator/dashboard');
            }
        }else{
            $this->session->set_flashdata('pesan','Usernaem dan Password anda salah!');
            redirect('administator/auth');
        }
    }
}
?>