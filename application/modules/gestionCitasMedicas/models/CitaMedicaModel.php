<?php
class CitaMedicaModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //sistema
    public function listMenuSistema()
    {
        $session_data = $this->session->userdata('logged_in');
        $rolId = $session_data['ID_ROL'];
        $rolUrl = $this->db->query('SELECT DESCRIPCION FROM ROL WHERE ID_ROL=' . '"' . $rolId . '"');
        $result = $this->db->query('SELECT * FROM PERMISO WHERE ID_PERMISO IN (' . $rolUrl->row()->DESCRIPCION . ')');
        return $result->result();
    }

    //cita medica
    public function showCitaMedica()
    {
        $sintoma='';
        $diagnostico='';
        $receta='';
        $session_data = $this->session->userdata('logged_in');
        $rolUsuarioLog = $session_data["ID_ROL"];
        $usuarioLog = $session_data["ID_USUARIO"];
        if($rolUsuarioLog == 3){
            $query = $this->db->query("SELECT * FROM cita_medica WHERE ID_USUARIO_PACIENTE = $usuarioLog ORDER BY ESTADO ASC");
        }elseif($rolUsuarioLog == 2){
            $query = $this->db->query("SELECT * FROM cita_medica WHERE ID_USUARIO_MEDICO = $usuarioLog ORDER BY ESTADO ASC");
        }else{
            $query = $this->db->query("SELECT * FROM cita_medica ORDER BY ESTADO DESC");
        }
        
        $lisDatos = $query->result();
        foreach ($lisDatos as $row) {
            $query1 = $this->db->query("SELECT CONCAT (NOMBRE,' ',APELLIDO) AS PACIENTE FROM usuario where ID_USUARIO = $row->ID_USUARIO_PACIENTE");
            foreach ($query1->result() as $row1) {
                $paciente = $row1->PACIENTE;
            }
            $row->PACIENTE = $paciente;
            $query2 = $this->db->query("SELECT CONCAT (NOMBRE,' ',APELLIDO) AS MEDICO FROM usuario where ID_USUARIO = $row->ID_USUARIO_MEDICO");
            foreach ($query2->result() as $row2) {
                $medico = $row2->MEDICO;
            }
            $row->MEDICO = $medico;
            $query3 = $this->db->query("SELECT NOMBRE FROM especialidad where ID_ESPECIALIDAD = $row->ID_ESPECIALIDAD");
            foreach ($query3->result() as $row3) {
                $especialidad = $row3->NOMBRE;
            }
            $row->ESPECIALIDAD = $especialidad;
            $query4 = $this->db->query("SELECT FECHAHORA FROM horario where ID_HORARIO = $row->ID_HORARIO");
            foreach ($query4->result() as $row4) {
                $horario = $row4->FECHAHORA;
            }
            $row->HORARIO = $horario;

            $query5 = $this->db->query("SELECT SINTOMA,DIAGNOSTICO,RECETA FROM cita_medica where ID_USUARIO_PACIENTE = $row->ID_USUARIO_PACIENTE");
            if($query5){
                foreach ($query5->result() as $row5) {
                    $sintoma = $sintoma . $row5->SINTOMA;
                    $diagnostico = $diagnostico . $row5->DIAGNOSTICO;
                    $receta = $receta . $row5->RECETA;
                }
                $row->HISTORIAL = "SINTOMAS: $sintoma / DIAGNOSTICO:$diagnostico / RECETA:$receta";    
            }else{
                $row->HISTORIAL = '';    
            }
            
            switch($row->ESTADO){
                case 'A': $row->ESTADONOMBRE = "Activo";break;
                case 'I': $row->ESTADONOMBRE = "Inactivo";break;
                case 'T': $row->ESTADONOMBRE = "Atendido";break;
                case 'N': $row->ESTADONOMBRE = "No Atendido";break;

            }
            
        }
        return $lisDatos;
    }

    public function comboPaciente()
    {
        $session_data = $this->session->userdata('logged_in');
        $rolUsuarioLog = $session_data["ID_ROL"];
        $usuarioLog = $session_data["ID_USUARIO"];
        if($rolUsuarioLog == 3)
            $result = $this->db->query("SELECT ID_USUARIO, CONCAT (NOMBRE,' ',APELLIDO, ' ', IDENTIFICACION) AS NOMBRE FROM usuario WHERE ESTADO = 'A' AND ID_ROL = 3 AND ID_USUARIO = $usuarioLog");
        else
            $result = $this->db->query("SELECT ID_USUARIO, CONCAT (NOMBRE,' ',APELLIDO, ' ', IDENTIFICACION) AS NOMBRE FROM usuario WHERE ESTADO = 'A' AND ID_ROL = 3");
        return $result->result();
    }
    public function comboMedico()
    {
        $id_especialidad = $this->input->post('id_especialidad');
        $sql = "SELECT us.ID_USUARIO, CONCAT (us.NOMBRE,' ',us.APELLIDO) AS NOMBRE FROM usuario us JOIN rel_medico_especialidad rel on us.ID_USUARIO = rel.ID_USUARIO WHERE us.ESTADO = 'A' AND us.ID_ROL = 2 AND rel.ID_ESPECIALIDAD = $id_especialidad";
        $result = $this->db->query($sql);
        return $result->result();
    }
    public function comboHorarioCita()
    {
        $id_medico = $this->input->post('id_medico');
        $sql = "SELECT hor.ID_HORARIO,hor.FECHAHORA FROM horario hor JOIN rel_horario_medico rel on hor.ID_HORARIO = rel.ID_HORARIO WHERE hor.ESTADO = 'A' AND rel.ID_USUARIO_MEDICO = $id_medico AND hor.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM cita_medica WHERE ESTADO = 'A' OR ESTADO = 'T' OR ESTADO = 'N' )";
        $result = $this->db->query($sql);
        return $result->result();
    }
    public function saveCitaMedica()
    {
        $id_paciente = $this->input->post('paciente');
        $id_medico = $this->input->post('medico');
        $id_especialidad = $this->input->post('especialidad');
        $id_horario = $this->input->post('horario');
        $sql = "SELECT * FROM cita_medica WHERE ID_USUARIO_PACIENTE = $id_paciente AND  ID_USUARIO_MEDICO = $id_medico AND  ID_ESPECIALIDAD = $id_especialidad AND  ID_HORARIO = $id_horario";
        $citaMedicaExiste = $this->db->query($sql);
        if ($citaMedicaExiste) {
            if ($citaMedicaExiste->num_rows() > 0) {
                $result = 'La especialidad ya existe.';
                return $result;
            } else {
                $hoy = date("Y-m-d H:i:s");
                $data = array(
                    'ID_USUARIO_PACIENTE' => $id_paciente,
                    'ID_USUARIO_MEDICO' => $id_medico,
                    'ID_ESPECIALIDAD' => $id_especialidad,
                    'ID_HORARIO' => $id_horario,
                    'ESTADO' => 'A',
                    'ID_USUARIO_CREO' =>  $id_paciente
                    //'FECHA_CREACION' => $hoy
                );
                $result = $this->db->insert('cita_medica', $data);
                return $result;
            }
        }
    }
    public function deleteCitaMedica()
    {
        $id = $this->input->post('id');
        $this->db->set('ESTADO', 'I');
        $this->db->where('ID_CITA_MEDICA', $id);
        $result = $this->db->update('cita_medica');
        return $result;
    }

    public function comboEspecialidad()
    {
        $result = $this->db->query('SELECT ID_ESPECIALIDAD, NOMBRE FROM especialidad WHERE ESTADO = "A"');
        return $result->result();
    }

    public function updateDatosCitaMedica()
    {
        $id = $this->input->post('id');
        $sintoma = $this->input->post('sintoma');
        $diagnostico = $this->input->post('diagnostico');
        $receta = $this->input->post('receta');
        $this->db->set('SINTOMA', $sintoma);
        $this->db->set('DIAGNOSTICO ', $diagnostico);
        $this->db->set('RECETA ', $receta);
        $this->db->set('ESTADO', 'T');
        $this->db->where('ID_CITA_MEDICA', $id);
        $result = $this->db->update('cita_medica');
        return $result;
    }

}
