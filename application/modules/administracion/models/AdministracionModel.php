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

        $mailExiste = $this->db->query('SELECT * FROM USUARIOS WHERE USUA_MAIL=' . '"' . $this->input->post('mail') . '"');
        $nickExiste = $this->db->query('SELECT * FROM USUARIOS WHERE USUA_NICK=' . '"' . $this->input->post('nick') . '"');
        if ($nickExiste->num_rows() > 0 && $mailExiste->num_rows() > 0) {
            $result = 'Usuario con el Correo electrónico ' . $this->input->post('mail') . ' y el Nick ' . $this->input->post('nick') . ' ya existe.';
            return $result;
        } else if ($mailExiste->num_rows() > 0) {
            $result = 'Usuario con el Correo electrónico ' . $this->input->post('mail') . ' ya existe.';
            return $result;
        } else if ($nickExiste->num_rows() > 0) {
            $result = 'Usuario con el Nick ' . $this->input->post('nick') . ' ya existe.';
            return $result;
        }
        $data = array(
            'USUA_NOMBRE' => $this->input->post('nombre'),
            'USUA_MAIL' => $this->input->post('mail'),
            'USUA_NICK' => $this->input->post('nick'),
            'USUA_PASS' => md5($this->input->post('pass')),
            'USUA_FECHA_REG' => date('Y-m-d'),
            'USUA_FOTO' => $this->input->post('foto'),
            'USUA_ESTADO' => $this->input->post('estado'),
            'ROL_ID' => $this->input->post('rol'),
        );
        $result = $this->db->insert('USUARIOS', $data);
        return $result;
    }

    public function updateUsusario() {
        $this->form_validation->set_rules('mail', 'Mail', 'edit_unique[USUARIOS.USUA_MAIL.USUA_ID.' . $this->input->post('id') . ']');
        if ($this->form_validation->run() == false) {
            return 'El correo electrónico ' . $this->input->post('mail') . ' pertenece a otro usuario.';
        } else {
            $id = $this->input->post('id');
            $foto = $this->input->post('foto');
            $nombre = $this->input->post('nombre');
            $mail = $this->input->post('mail');
            $estado = $this->input->post('estado');
            $rol = $this->input->post('rol');
            $pass = $this->input->post('pass');

            $this->db->set('USUA_NOMBRE', $nombre);
            $this->db->set('USUA_MAIL', $mail);
            $this->db->set('USUA_ESTADO', $estado);
            $this->db->set('USUA_FOTO', $foto);
            $this->db->set('ROL_ID', $rol);
            if ($pass != "") {
                $this->db->set('USUA_PASS', md5($pass));
                $this->db->where('USUA_ID', $id);
                $result = $this->db->update('USUARIOS');
                return $result;
            } else {
                $this->db->where('USUA_ID', $id);
                $result = $this->db->update('USUARIOS');
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
}
