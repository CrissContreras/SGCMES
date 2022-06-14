<?php
class AdministracionModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function listMenuSistema()
    {
        $session_data = $this->session->userdata('logged_in');
        $rolId = $session_data['ID_ROL'];

        $rolUrl = $this->db->query('SELECT PERMISOS FROM ROL WHERE ID_ROL=' . '"' . $rolId . '"');

        $result = $this->db->query('SELECT * FROM PERMISO WHERE ID_PERMISO IN (' . $rolUrl->row()->PERMISOS. ')');

        return $result->result();
    }
}
