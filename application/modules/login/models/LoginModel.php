<?php
class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function login($NICK, $PASS)
    {
        $this->db->select('*');
        $this->db->from('USUARIO');
        $this->db->where('NOMBRE_USUARIO', $NICK);
        $this->db->where('CONTRASENA', md5($PASS));
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result(); 
        } else {
            return false; 
        }
    }
}
