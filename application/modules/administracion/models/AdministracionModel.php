<?php
class AdministracionModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //sistema
    public function listMenuSistema() {
        $session_data = $this->session->userdata('logged_in');
        $rolId = $session_data['ID_ROL'];
        $rolUrl = $this->db->query('SELECT DESCRIPCION FROM ROL WHERE ID_ROL=' . '"' . $rolId . '"');
        $result = $this->db->query('SELECT * FROM PERMISO WHERE ID_PERMISO IN (' . $rolUrl->row()->DESCRIPCION . ')');
        return $result->result();
    }

    //*****Usuarios*****
    public function showUsuario() {
        $result = $this->db->query('SELECT * FROM usuario');
        return $result->result();
    }

    public function saveUsuario() {

        $mailExiste = $this->db->query('SELECT * FROM usuario WHERE CORREO=' . '"' . $this->input->post('correo') . '"');
        $nickExiste = $this->db->query('SELECT * FROM usuario WHERE NOMBRE_USUARIO=' . '"' . $this->input->post('nombre_usuario') . '"');
        $identificacionExiste = $this->db->query('SELECT * FROM usuario WHERE IDENTIFICACION=' . '"' . $this->input->post('identificacion') . '"');
        if ($nickExiste->num_rows() > 0 && $mailExiste->num_rows() > 0 && $identificacionExiste->num_rows() > 0) {
            $result = 'Usuario con el Correo electrónico ' . $this->input->post('correo') . ' y el Usuario ' . $this->input->post('nombre_usuario') . ' y el Identificación ' . $this->input->post('identificacion') . ' ya existe.';
            return $result;
        } else if ($mailExiste->num_rows() > 0) {
            $result = 'Usuario con el Correo electrónico ' . $this->input->post('correo') . ' ya existe.';
            return $result;
        } else if ($nickExiste->num_rows() > 0) {
            $result = 'Usuario con el nombre de usuario ' . $this->input->post('nombre_usuario') . ' ya existe.';
            return $result;
        } else if ($identificacionExiste->num_rows() > 0) {
            $result = 'Usuario con la identificación' . $this->input->post('identificacion') . ' ya existe.';
            return $result;
        }
        $data = array(
            'NOMBRE' => $this->input->post('nombre'),
            'APELLIDO' => $this->input->post('apellido'),
            'TIPO_IDENTIFICACION' => $this->input->post('tipo_identificacion'),
            'IDENTIFICACION' => $this->input->post('identificacion'),
            'NOMBRE_USUARIO' => $this->input->post('nombre_usuario'),
            'CONTRASENA' => md5($this->input->post('contrasena')),
            'CORREO' => $this->input->post('correo'),
            'TELEFONO' => $this->input->post('telefono'),
            'DIRECCION' => $this->input->post('direccion'),
            'CIUDAD_RESIDENCIA' => $this->input->post('ciudad_residencia'),
            'FECHA_NACIMIENTO' => $this->input->post('fecha_nacimiento'),
            'GENERO' => $this->input->post('genero'),
            'ID_ROL' => $this->input->post('id_rol'),
            'ESTADO' => 'A',
        );
        $result = $this->db->insert('usuario', $data);
        return $result;
    }

    public function updateUsusario() {
        $mailExiste = $this->db->query('SELECT * FROM usuario WHERE CORREO=' . '"' . $this->input->post('correo') . '" AND ID_USUARIO <>' . '"' . $this->input->post('id') . '"');
        if ($mailExiste->num_rows() > 0) {
            return 'El correo electrónico ' . $this->input->post('mail') . ' pertenece a otro usuario.';
        } else {
            $this->db->set('NOMBRE', $this->input->post('nombre'));
            $this->db->set('APELLIDO', $this->input->post('apellido'));
            $this->db->set('TIPO_IDENTIFICACION', $this->input->post('tipo_identificacion'));
            $this->db->set('IDENTIFICACION', $this->input->post('identificacion'));
            $this->db->set('NOMBRE_USUARIO', $this->input->post('nombre_usuario'));
            $this->db->set('CORREO', $this->input->post('correo'));
            $this->db->set('TELEFONO', $this->input->post('telefono'));
            $this->db->set('DIRECCION', $this->input->post('direccion'));
            $this->db->set('CIUDAD_RESIDENCIA', $this->input->post('ciudad_residencia'));
            $this->db->set('FECHA_NACIMIENTO', $this->input->post('fecha_nacimiento'));
            $this->db->set('GENERO', $this->input->post('genero'));
            $this->db->set('ID_ROL', $this->input->post('id_rol'));
            $contrasena = $this->input->post('contrasena');
            $id = $this->input->post('id');
            if ($contrasena != "") {
                $this->db->set('CONTRASENA', md5($contrasena));
                $this->db->where('ID_USUARIO', $id);
                $result = $this->db->update('usuario');
                return $result;
            } else {
                $this->db->where('ID_USUARIO', $id);
                $result = $this->db->update('usuario');
                return $result;
            }
        }
    }

    public function deleteUsuario() {
        $id = $this->input->post('id');
        $usuariosRol = $this->db->query('SELECT * FROM SITES WHERE SITE_SUPERVISOR=' . '"' . $id . '" OR SITE_ADMINISTRADOR=' . '"' . $id . '"');
        if ($usuariosRol->num_rows() > 0) {
            $result = 'No se puede eliminar, hay sites ligados a este usuario.';
            return $result;
        } else {
            $id = $this->input->post('id');
            $this->db->where('USUA_ID', $id);
            $result = $this->db->delete('USUARIOS');
            return $result;
        }
    }

    //******Catalogo*****
    public function showCatalogo() {
        $result = $this->db->query('SELECT ID_CATALOGO, NOMBRE, TIPO as TIP, case TIPO when "G" then "Género" when "C" then "Ciudad" when "M" then "Medicina" when "S" then "Síntoma" when "I" then "Identificación tipo" end as TIPO FROM catalogo');
        return $result->result();
    }

    public function saveCatalogo() {
        $catalogoExiste = $this->db->query('SELECT * FROM catalogo WHERE NOMBRE =' . '"' . $this->input->post('nombre') . '"  AND TIPO =' . '"' . $this->input->post('tipo') . '"');
        if ($catalogoExiste->num_rows() > 0) {
            $result = 'Catálogo ya existe.';
            return $result;
        } else {
            $data = array(
                'NOMBRE' => $this->input->post('nombre'),
                'TIPO' => $this->input->post('tipo'),
            );
            $result = $this->db->insert('catalogo', $data);
            return $result;
        }
    }

    public function updateCatalogo() {
        $id = $this->input->post('id');
        $tipo = $this->input->post('tipo');
        $nombre = $this->input->post('nombre');
        $catalogoExiste = $this->db->query('SELECT * FROM catalogo WHERE NOMBRE =' . '"' . $this->input->post('nombre') . '"  AND TIPO =' . '"' . $this->input->post('tipo') . '"');
        if ($catalogoExiste->num_rows() > 1) {
            $result = 'Catálogo ya existe.';
            return $result;
        } else {
            $this->db->set('NOMBRE', $nombre);
            $this->db->set('TIPO', $tipo);
            $this->db->where('ID_CATALOGO', $id);
            $result = $this->db->update('catalogo');
            return $result;
        }
    }

    public function deleteCatalogo() {
        //$id = $this->input->post('id');
        /*if ($usuariosRol->num_rows() > 0) {
            $result = 'No se puede eliminar, hay sites ligados a este usuario.';
            return $result;
        } else {*/
            $id = $this->input->post('id');
            $this->db->where('ID_CATALOGO', $id);
            $result = $this->db->delete('catalogo');
            return $result;
        //}
    }
    //******Rol*****
    public function showRol() {
        $result = $this->db->query('SELECT ID_ROL, NOMBRE, DESCRIPCION FROM rol');
        return $result->result();
    }

    public function saveRol() {
        $rolExiste = $this->db->query('SELECT * FROM rol WHERE NOMBRE =' . '"' . $this->input->post('nombre') . '"  AND DESCRIPCION =' . '"' . $this->input->post('descripcion') . '"');
        if ($rolExiste->num_rows() > 0) {
            $result = 'Rol ya existe.';
            return $result;
        } else {
            $data = array(
                'NOMBRE' => $this->input->post('nombre'),
                'DESCRIPCION' => $this->input->post('descripcion'),
                'ESTADO' => 'A',
            );
            $result = $this->db->insert('rol', $data);
            return $result;
        }
    }

    public function updateRol() {
        $id = $this->input->post('id');
        $descripcion = $this->input->post('descripcion');
        $nombre = $this->input->post('nombre');
        $rolExiste = $this->db->query('SELECT * FROM rol WHERE NOMBRE =' . '"' . $this->input->post('nombre') . '"  AND DESCRIPCION =' . '"' . $this->input->post('descripcion') . '"');
        if ($rolExiste->num_rows() > 1) {
            $result = 'Rol ya existe.';
            return $result;
        } else {
            $this->db->set('NOMBRE', $nombre);
            $this->db->set('DESCRIPCION', $descripcion);
            $this->db->where('ID_CATALOGO', $id);
            $result = $this->db->update('rol');
            return $result;
        }
    }

    public function deleteRol() {
        $id = $this->input->post('id');
        $usuariosRol = $this->db->query('SELECT * FROM usuarios WHERE ID_ROL =' . '"' . $id."'");
        if ($usuariosRol->num_rows() > 0) {
            $result = 'No se puede eliminar, hay usuarios ligados a este rol.';
            return $result;
        } else {
            $id = $this->input->post('id');
            $this->db->where('ID_ROL', $id);
            $result = $this->db->delete('rol');
            return $result;
        }
    }

    public function comboRol() {
        $result = $this->db->query('SELECT ID_ROL, NOMBRE FROM rol');
        return $result->result();
    }
}
