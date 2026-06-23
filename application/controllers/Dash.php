<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

    function __construct(){
        parent::__construct();
        session_start();
        $this->load->model('sales_model');
        $this->load->model('compras_model');
    }

    public function index(){
        $this->data["page_title"] = "Dashboard";
        
        // Obtener datos de ventas
        $this->data['ventas_diarias'] = $this->get_ventas_diarias();
        $this->data['ventas_semanales'] = $this->get_ventas_semanales();
        $this->data['ventas_mensuales'] = $this->get_ventas_mensuales();
        
        // Obtener datos de compras
        $this->data['compras_semanales'] = $this->get_compras_semanales();
        $this->data['compras_mensuales'] = $this->get_compras_mensuales();
        
        // Obtener datos de gastos
        $this->data['gastos_semanales'] = $this->get_gastos_semanales();
        $this->data['gastos_mensuales'] = $this->get_gastos_mensuales();
        
        $this->template->load('view_layout_modern', 'dash/index', $this->data);
    }

    // ===================== VENTAS =====================

    private function get_ventas_diarias(){
        $store_id = $_SESSION["store_id"];
        $cSql = "SELECT DATE_FORMAT(date, '%Y-%m-%d') as fecha, 
                        COUNT(*) as cantidad, 
                        ROUND(SUM(grand_total), 2) as total 
                 FROM tec_sales 
                 WHERE anulado = '0' 
                   AND store_id = ? 
                   AND date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                 GROUP BY DATE_FORMAT(date, '%Y-%m-%d') 
                 ORDER BY fecha ASC";
        $query = $this->db->query($cSql, array($store_id));
        return $query->result_array();
    }

    private function get_ventas_semanales(){
        $store_id = $_SESSION["store_id"];
        $cSql = "SELECT CONCAT('Semana ', WEEK(date, 1)) as semana,
                        YEARWEEK(date, 1) as yw,
                        COUNT(*) as cantidad, 
                        ROUND(SUM(grand_total), 2) as total 
                 FROM tec_sales 
                 WHERE anulado = '0' 
                   AND store_id = ? 
                   AND date >= DATE_SUB(CURDATE(), INTERVAL 8 WEEK)
                 GROUP BY YEARWEEK(date, 1) 
                 ORDER BY yw ASC";
        $query = $this->db->query($cSql, array($store_id));
        return $query->result_array();
    }

    private function get_ventas_mensuales(){
        $store_id = $_SESSION["store_id"];
        $cSql = "SELECT DATE_FORMAT(date, '%Y-%m') as mes,
                        COUNT(*) as cantidad, 
                        ROUND(SUM(grand_total), 2) as total 
                 FROM tec_sales 
                 WHERE anulado = '0' 
                   AND store_id = ? 
                   AND date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                 GROUP BY DATE_FORMAT(date, '%Y-%m') 
                 ORDER BY mes ASC";
        $query = $this->db->query($cSql, array($store_id));
        return $query->result_array();
    }

    // ===================== COMPRAS =====================

    private function get_compras_semanales(){
        $store_id = $_SESSION["store_id"];
        $cSql = "SELECT CONCAT('Semana ', WEEK(fecha, 1)) as semana,
                        YEARWEEK(fecha, 1) as yw,
                        COUNT(*) as cantidad, 
                        ROUND(SUM(total), 2) as total 
                 FROM tec_compras 
                 WHERE tipogasto = 'caja'
                   AND store_id = ? 
                   AND fecha >= DATE_SUB(CURDATE(), INTERVAL 8 WEEK)
                 GROUP BY YEARWEEK(fecha, 1) 
                 ORDER BY yw ASC";
        $query = $this->db->query($cSql, array($store_id));
        return $query->result_array();
    }

    private function get_compras_mensuales(){
        $store_id = $_SESSION["store_id"];
        $cSql = "SELECT DATE_FORMAT(fecha, '%Y-%m') as mes,
                        COUNT(*) as cantidad, 
                        ROUND(SUM(total), 2) as total 
                 FROM tec_compras 
                 WHERE tipogasto = 'caja'
                   AND store_id = ? 
                   AND fecha >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                 GROUP BY DATE_FORMAT(fecha, '%Y-%m') 
                 ORDER BY mes ASC";
        $query = $this->db->query($cSql, array($store_id));
        return $query->result_array();
    }

    // ===================== GASTOS =====================

    private function get_gastos_semanales(){
        $store_id = $_SESSION["store_id"];
        $cSql = "SELECT CONCAT('Semana ', WEEK(fecha, 1)) as semana,
                        YEARWEEK(fecha, 1) as yw,
                        COUNT(*) as cantidad, 
                        ROUND(SUM(total), 2) as total 
                 FROM tec_compras 
                 WHERE tipogasto = 'GASTOS'
                   AND store_id = ? 
                   AND fecha >= DATE_SUB(CURDATE(), INTERVAL 8 WEEK)
                 GROUP BY YEARWEEK(fecha, 1) 
                 ORDER BY yw ASC";
        $query = $this->db->query($cSql, array($store_id));
        return $query->result_array();
    }

    private function get_gastos_mensuales(){
        $store_id = $_SESSION["store_id"];
        $cSql = "SELECT DATE_FORMAT(fecha, '%Y-%m') as mes,
                        COUNT(*) as cantidad, 
                        ROUND(SUM(total), 2) as total 
                 FROM tec_compras 
                 WHERE tipogasto = 'GASTOS'
                   AND store_id = ? 
                   AND fecha >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                 GROUP BY DATE_FORMAT(fecha, '%Y-%m') 
                 ORDER BY mes ASC";
        $query = $this->db->query($cSql, array($store_id));
        return $query->result_array();
    }

    // ===================== API AJAX =====================

    public function api_ventas_diarias(){
        $data = $this->get_ventas_diarias();
        echo json_encode(array("data" => $data));
    }

    public function api_ventas_semanales(){
        $data = $this->get_ventas_semanales();
        echo json_encode(array("data" => $data));
    }

    public function api_ventas_mensuales(){
        $data = $this->get_ventas_mensuales();
        echo json_encode(array("data" => $data));
    }

    public function api_compras_semanales(){
        $data = $this->get_compras_semanales();
        echo json_encode(array("data" => $data));
    }

    public function api_compras_mensuales(){
        $data = $this->get_compras_mensuales();
        echo json_encode(array("data" => $data));
    }

    public function api_gastos_semanales(){
        $data = $this->get_gastos_semanales();
        echo json_encode(array("data" => $data));
    }

    public function api_gastos_mensuales(){
        $data = $this->get_gastos_mensuales();
        echo json_encode(array("data" => $data));
    }
}
