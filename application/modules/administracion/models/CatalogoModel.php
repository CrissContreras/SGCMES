<?php
class CatalogoModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index_mdl() {
        $w_buscar = $html = $paginado = "";
        /*$w_buscar = $this->input->post('w_buscar');
        $desde = intval($this->input->post('desde'));
        if ($desde == "")
            $desde = 0;
        $paginado = $html = "";
        $cuantos = cuantosResultados();
        if (strlen($w_buscar) > 3) {
            $campos = "`are_nombre`";
            $where = "WHERE MATCH ($campos) AGAINST ('$w_buscar' IN BOOLEAN MODE)";
            $order_by = "ORDER BY `puntos` DESC";
            $sql = "SELECT *, MATCH($campos) AGAINST ('$w_buscar') AS 'puntos' from `catalogo` $where $order_by";
        } else*/
            $sql = "SELECT * FROM `catalogo` WHERE 1 ORDER BY `NOMBRE` ";
        /*$paginado = paginador_multiple($sql, $cuantos, $desde);
        $desde*=$cuantos;
        $sql_limit = $sql . " limit $desde,$cuantos";
        $query = $this->db->query($sql_limit);*/
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $html = "";
            foreach ($query->result() as $fila) {
                switch ($fila->TIPO)
                {
                   case 'G': $fila->TIPO_nombre = "Género"; break; 
                   case 'C': $fila->TIPO_nombre = "Ciudad"; break;
                   case 'M': $fila->TIPO_nombre = "Medicina"; break; 
                   case 'S': $fila->TIPO_nombre = "Síntoma"; break; 
                }
                $html.= $this->parser->parse('catalogoIndex_tpl', $fila, TRUE);
            }
        } else {
            $html.="<tr><td colspan='5'>No hay catalogos (<strong>$w_buscar</strong>)</td></tr>";
        }
        $arreglo["w_buscar"] = $w_buscar;
        $arreglo["html"] = $html;
        $arreglo["paginado"] = $paginado;
        return $arreglo;
    }

    public function almacenar_mdl() {
        $arreglo = array(
            "NOMBRE" => $this->input->post('nombre'),
            "TIPO" => $this->input->post('tipo'),
        );
        $this->db->insert('catalogo', $arreglo);
    }

    public function datos_mdl() {
        $id = $this->uri->segment(4);
        $this->db->where("ID_CATALOGO", $id);
        $query = $this->db->get('catalogo');
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return "Sin datos ($id)";
    }

    public function actualizar_mdl() {
        $id = $this->input->post('id');
        $arreglo = array(
            "NOMBRE" => $this->input->post('nombre'),
            "TIPO" => $this->input->post('tipo'),
        );
        $this->db->where('ID_CATALOGO', $id);
        $this->db->update('catalogo', $arreglo);
    }

    public function eliminar_mdl() {
        $id = $this->uri->segment(4);
        $this->db->where("ID_CATALOGO_MEDICINAS ", $id);
        $query = $this->db->get('rel_medicinas');
        $this->db->where("ID_CATALOGO_SINTOMA", $id);
        $query1 = $this->db->get('rel_sintoma');
        $this->db->where("ID_CATALOGO_CIUDAD_RES", $id);
        $this->db->where("ID_CATALOGO_GENERO", $id);
        $query2 = $this->db->get('usuario');
        if ($query->num_rows() > 0 || $query1->num_rows() > 0 || $query2->num_rows() > 0)
            return 'n';
        else {
            $this->db->where('ID_CATALOGO', $id);
            $this->db->delete("catalogo");
            return 's';
        }
    }

}
