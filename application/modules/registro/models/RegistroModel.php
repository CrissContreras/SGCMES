<?php
class RegistroModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function registro_nuevo_paciente() {

        $identificacion = $this->db->query('SELECT * FROM USUARIO WHERE IDENTIFICACION =' . '"' . $this->input->post('identificacion') . '"');
        $nombre_usuario = $this->db->query('SELECT * FROM USUARIO WHERE NOMBRE_USUARIO=' . '"' . $this->input->post('nombre_usuario') . '"');

        if ($identificacion->num_rows() > 0 ) {
            $result = 'Usuario con la identificación ' . $this->input->post('identificacion') . ' ya existe.';
            return $result;
        } else if ($nombre_usuario->num_rows() > 0) {
            $result = 'Nombre de usuario ' . $this->input->post('nombre_usuario') . ' ya existe.';
            return $result;
        } 

        $data = array(
            'NOMBRE' => $this->input->post('nombre'),
            'APELLIDO' => $this->input->post('apellido'),
            'IDENTIFICACION' => $this->input->post('identificacion'),
            'TIPO_IDENTIFICACION' => $this->input->post('tipo_identificacion'),
            'NOMBRE_USUARIO' => $this->input->post('nombre_usuario'),
            'CONTRASENA' => md5($this->input->post('contrasena')),
            'CORREO' => $this->input->post('correo'),
            'TELEFONO' => $this->input->post('telefono'),
            'DIRECCION' => $this->input->post('direccion'),
            'CIUDAD_RESIDENCIA' => $this->input->post('ciudad_residencia'),
            'FECHA_NACIMIENTO' => $this->input->post('fecha_nacimiento'),
            'GENERO' => $this->input->post('genero'),
            'TIPO' => "P",
            'ID_ROL' => 6,
        );
        $result = $this->db->insert('usuario', $data);

        return $result;
    }
}
