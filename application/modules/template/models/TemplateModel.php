<?php
class TemplateModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function sistema()
    {
        $result = $this->db->query('SELECT * FROM SIST_GENERAL');
        return $result->result();
    }

    //PASS
    public function updatePass()
    {
        $session_data = $this->session->userdata('logged_in');
        $idUsuario = $session_data['USUA_ID'];

        $passActual = $this->input->post('passActual');
        $nuevoPass = $this->input->post('nuevoPass');
        $nuevoPass2 = $this->input->post('nuevoPass2');

        $valPassActual = $this->db->query('SELECT USUA_PASS FROM USUARIOS WHERE USUA_ID = ' . $idUsuario . '');
        $valPassActual2 = $valPassActual->row()->USUA_PASS;

        if ($valPassActual2 == md5($passActual)) {
            if ($nuevoPass == $nuevoPass2) {
                $this->db->set('USUA_PASS', md5($nuevoPass));
                $this->db->where('USUA_ID', $idUsuario);
                $result = $this->db->update('USUARIOS');

                return $result;
            }else {
                return 'Nueva contraseña no es igual a Repetir nueva contraseña.';
            }
        } else {
            return 'Contraseña actual incorrecta.';
        }
    }
 
    public function Perfil(){
        $session_data = $this->session->userdata('logged_in');
        $idUsuario = $session_data['USUA_ID'];
        
        $result = $this->db->query('SELECT * FROM USUARIO U JOIN ROL R ON U.ROL_ID = R.ROL_ID WHERE U.USUA_ID = ' . $idUsuario . '');
        return $result->result();
    }
}
