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
        //$this->db->from('USUARIOS');
        $this->db->where('NOMBRE_USUARIO', $NICK);
        //$this->db->where('USUA_NICK', $NICK);
        $this->db->where('CONTRASENA', md5($PASS));
        //$this->db->where('USUA_PASS', md5($PASS));
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result(); 
        } else {
            return false; 
        }
    }
    function sessionActiva()
    {
        $this->db->select('SESION_ID, IP_PC, PERS_DNI, IN_OUT');
        $this->db->from('SESIONES');
        $this->db->where('SESION_ID', session_id());
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function sessionNueva($SESION_ID, $IP_PC, $PERS_DNI, $IN_OUT)
    {
        $data = array(
            'SESION_ID' => $SESION_ID,
            'IP_PC'     => $IP_PC,
            'PERS_DNI'  => $PERS_DNI,
            'IN_OUT'    => $IN_OUT,
        );
        $result = $this->db->insert('SESIONES', $data);
        return $result;
    }

    function updatePersona($userId, $sessId)
    {
        $arrayDatos = array(
            'PERS_SESS' => $sessId,
        );
        $this->db->where('PERS_ID', $userId);
        $this->db->update('PERSONA', $arrayDatos);
    }
    function updatePass($userMail, $nuevoPass, $sessId)
    {
        $arrayDatos = array(
            'PERS_PASS' => $nuevoPass,
            'PERS_SESS' => $sessId,
        );
        $this->db->where('PERS_MAIL', $userMail);
        $this->db->update('PERSONA', $arrayDatos);
    }
}
