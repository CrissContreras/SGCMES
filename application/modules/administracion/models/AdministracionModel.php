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
        $query = $this->db->query('SELECT u.*, r.NOMBRE ROL_NOMBRE FROM usuario u JOIN rol r on u.ID_ROL=r.ID_ROL;');
        $lisDatos = $query->result();
        foreach ($lisDatos as $row) {
            $lisEspecialidades = array();
            $query1 = $this->db->query("SELECT ID_ESPECIALIDAD FROM rel_medico_especialidad where ID_USUARIO = $row->ID_USUARIO");
            foreach ($query1->result() as $row1) {
                $lisEspecialidades[] = $row1->ID_ESPECIALIDAD;
            }
            if (count($lisEspecialidades) > 0) {
                $especilidades = implode(",", $lisEspecialidades);
                $row->ID_ESPECIALIDAD = $especilidades;
            } else {
                $row->ID_ESPECIALIDAD = "";
            }
            $listHorarioMedico = array();
            $query2 = $this->db->query("SELECT ID_HORARIO FROM rel_horario_medico where ID_USUARIO_MEDICO = $row->ID_USUARIO");
            foreach ($query2->result() as $row2) {
                $listHorarioMedico[] = $row2->ID_HORARIO;
            }
            if (count($listHorarioMedico) > 0) {
                $horarios = implode(",", $listHorarioMedico);
                $row->ID_HORARIO_MEDICO = $horarios;
            } else {
                $row->ID_HORARIO_MEDICO = "";
            }
        }
        return $lisDatos;
    }

    public function saveUsuario() {
        //log_message('error', '>>>Error');
        
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
        $id = $this->db->insert_id();
        $this->db->where('ID_USUARIO', $id);
        $result = $this->db->delete('rel_medico_especialidad');
        $listEspecialidad = $this->input->post('id_especialidad');
        if ($listEspecialidad != null) {
            foreach ($listEspecialidad as $esp) {
                $datae = array(
                    'ID_USUARIO' => $id,
                    'ID_ESPECIALIDAD' => $esp,
                    'ESTADO' => 'A',
                );
                $result = $this->db->insert('rel_medico_especialidad', $datae);
            }
        }
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
            } else {
                $this->db->where('ID_USUARIO', $id);
                $result = $this->db->update('usuario');
            }
            $this->db->where('ID_USUARIO', $id);
            $result = $this->db->delete('rel_medico_especialidad');
            $listEspecialidad = $this->input->post('id_especialidad');
            if ($listEspecialidad != null) {
                foreach ($listEspecialidad as $esp) {
                    $datae = array(
                        'ID_USUARIO' => $id,
                        'ID_ESPECIALIDAD' => $esp,
                        'ESTADO' => 'A',
                    );
                    $result = $this->db->insert('rel_medico_especialidad', $datae);
                }
            }
            return $result;
        }
    }

    public function deleteUsuario() {
        $id = $this->input->post('id');
        $this->db->set('ESTADO', 'I');
        $this->db->where('ID_USUARIO', $id);
        $result = $this->db->update('usuario');
        return $result;
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
        $this->db->set('ESTADO', 'I');
        $this->db->where('ID_CATALOGO', $id);
        $result = $this->db->update('catalogo');
        return $result;
        //}
    }
    //******Rol*****
    public function showRol() {
        $result = $this->db->query("SELECT ID_ROL, NOMBRE, DESCRIPCION FROM rol' WHERE ESTADO = 'A'");
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
        $usuariosRol = $this->db->query('SELECT * FROM usuarios WHERE ID_ROL =' . '"' . $id . "'");
        if ($usuariosRol->num_rows() > 0) {
            $result = 'No se puede eliminar, hay usuarios ligados a este rol.';
            return $result;
        } else {
            $this->db->set('ESTADO', 'I');
            $this->db->where('ID_ROL', $id);
            $result = $this->db->update('rol');
            return $result;
        }
    }

    public function comboRol() {
        $result = $this->db->query("SELECT ID_ROL, NOMBRE FROM rol WHERE ESTADO = 'A'");
        return $result->result();
    }

    //******ESPECIALIDAD*****
    public function showEspecialidad() {
        $result = $this->db->query("SELECT ID_ESPECIALIDAD , NOMBRE, DESCRIPCION FROM especialidad WHERE ESTADO = 'A'");
        return $result->result();
    }

    public function saveEspecialidad() {
        $especialidadExiste = $this->db->query('SELECT * FROM especialidad WHERE NOMBRE =' . '"' . $this->input->post('nombre') . '"  AND DESCRIPCION =' . '"' . $this->input->post('descripcion') . '"');
        if ($especialidadExiste->num_rows() > 0) {
            $result = 'La especialidad ya existe.';
            return $result;
        } else {
            $data = array(
                'NOMBRE' => $this->input->post('nombre'),
                'DESCRIPCION' => $this->input->post('descripcion'),
                'ESTADO' => 'A',
            );
            $result = $this->db->insert('especialidad', $data);
            return $result;
        }
    }

    public function updateEspecialidad() {
        $id = $this->input->post('id');
        $descripcion = $this->input->post('descripcion');
        $nombre = $this->input->post('nombre');
        $especialidadExiste = $this->db->query('SELECT * FROM especialidad WHERE NOMBRE =' . '"' . $this->input->post('nombre') . '"  AND DESCRIPCION =' . '"' . $this->input->post('descripcion') . '"');
        if ($especialidadExiste->num_rows() > 1) {
            $result = 'Especialidad ya existe.';
            return $result;
        } else {
            $this->db->set('NOMBRE', $nombre);
            $this->db->set('DESCRIPCION', $descripcion);
            $this->db->where('ID_ESPECIALIDAD', $id);
            $result = $this->db->update('especialidad');
            return $result;
        }
    }

    public function deleteEspecialidad() {
        $id = $this->input->post('id');
        $usuariosEspecialidad = $this->db->query('SELECT * FROM rel_medico_especialidad WHERE ID_ESPECIALIDAD =' . '"' . $id . "'");
        if ($usuariosEspecialidad) {
            if ($usuariosEspecialidad->num_rows() > 0) {
                $result = 'No se puede eliminar, hay medicos ligados a esta Especialidad.';
                return $result;
            }
        } else {
            $this->db->set('ESTADO', 'I');
            $this->db->where('ID_ESPECIALIDAD', $id);
            $result = $this->db->update('especialidad');
            return $result;
        }
    }

    public function comboEspecialidad() {
        $result = $this->db->query('SELECT ID_ESPECIALIDAD, NOMBRE FROM especialidad WHERE ESTADO = "A"' );
        return $result->result();
    }

    //******Horario*****
    public function showHorario() {
        $result = $this->db->query("SELECT ID_HORARIO , FECHAHORA, DESCRIPCION FROM horario WHERE ESTADO = 'A'");
        return $result->result();
    }

    public function saveHorario() {
        $horarioExiste = $this->db->query('SELECT * FROM horario WHERE FECHAHORA =' . '"' . $this->input->post('fechahora') . '"  AND DESCRIPCION =' . '"' . $this->input->post('descripcion') . '"');
        if ($horarioExiste->num_rows() > 0) {
            $result = 'El horario ya existe.';
            return $result;
        } else {
            $data = array(
                'FECHAHORA' => $this->input->post('fechahora'),
                'DESCRIPCION' => $this->input->post('descripcion'),
                'ESTADO' => 'A',
            );
            $result = $this->db->insert('horario', $data);
            return $result;
        }
    }

    public function updateHorario() {
        $id = $this->input->post('id');
        $fechahora = $this->input->post('fechahora');
        $descripcion = $this->input->post('descripcion');
        $horarioExiste = $this->db->query('SELECT * FROM horario WHERE FECHAHORA =' . '"' . $this->input->post('fehachora') . '"  AND DESCRIPCION =' . '"' . $this->input->post('descripcion') . '"');
        if ($horarioExiste->num_rows() > 1) {
            $result = 'Especialidad ya existe.';
            return $result;
        } else {
            $this->db->set('FECHAHORA', $fechahora);
            $this->db->set('DESCRIPCION', $descripcion);
            $this->db->where('ID_HORARIO', $id);
            $result = $this->db->update('horario');
            return $result;
        }
    }

    public function deleteHorario() {
        $id = $this->input->post('id');
        $horarioMedico = $this->db->query('SELECT * FROM rel_horario_medico WHERE ID_HORARIO =' . '"' . $id . "'");
        if ($horarioMedico) {
            if ($horarioMedico->num_rows() > 0) {
                $result = 'No se puede eliminar, hay medicos ligados a este horario.';
                return $result;
            }
        }
        $horarioCitaMedica = $this->db->query('SELECT * FROM cita_medica WHERE ID_HORARIO =' . '"' . $id . "'");
        if ($horarioCitaMedica) {
            if ($horarioCitaMedica->num_rows() > 0) {
                $result = 'No se puede eliminar, hay citas medicas ligadas a este horario.';
                return $result;
            }
        }

        $this->db->where('ID_HORARIO', $id);
        $result = $this->db->delete('horario');
        return $result;
    }

    public function comboHorario() {
        $result = $this->db->query('SELECT ID_HORARIO, FECHAHORA FROM horario');
        return $result->result();
    }

    public function saveHorarioUsuario() {
        //si el horario ya existe en una cita medica para el medico ya no se puede borrar
        $id_usuario = $this->input->post('id_usuario');
        $listHorario = $this->input->post('id_horario');
        $this->db->where('ID_USUARIO_MEDICO', $id_usuario);
        $this->db->delete('rel_horario_medico');
        if ($listHorario != null) {
            foreach ($listHorario as $hor) {
                $datae = array(
                    'ID_USUARIO_MEDICO' => $id_usuario,
                    'ID_HORARIO' => $hor
                    
                );
                $result = $this->db->insert('rel_horario_medico', $datae);
            }
        }
        
        return $result;
    }
//cita medica
public function comboPaciente() {
    $result = $this->db->query("SELECT ID_USUARIO, CONCAT (NOMBRE,' ',APELLIDO, ' ', IDENTIFICACION) AS NOMBRE FROM usuario WHERE ESTADO = 'A' AND ID_ROL = 3");
    return $result->result();
}
public function comboMedico() {
    $id_especialidad = $this->input->post('id_especialidad');
    $sql = "SELECT us.ID_USUARIO, CONCAT (us.NOMBRE,' ',us.APELLIDO) AS NOMBRE FROM usuario us JOIN rel_medico_especialidad rel on us.ID_USUARIO = rel.ID_USUARIO WHERE us.ESTADO = 'A' AND us.ID_ROL = 2 AND rel.ID_ESPECIALIDAD = $id_especialidad";
    $result = $this->db->query($sql);
    return $result->result();
}
public function comboHorarioCita() {
    $id_medico = $this->input->post('id_medico');
    $sql = "SELECT hor.ID_HORARIO,hor.FECHAHORA FROM horario hor JOIN rel_horario_medico rel on hor.ID_HORARIO = rel.ID_HORARIO WHERE hor.ESTADO = 'A' AND rel.ID_USUARIO_MEDICO = $id_medico AND hor.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM cita_medica WHERE ESTADO = 'A')";
    $result = $this->db->query($sql);
    return $result->result();
}

}
