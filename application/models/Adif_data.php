<?php

class adif_data extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function export_all() {
        //$this->db->limit(5);
        $this->db->order_by("COL_TIME_ON", "ASC"); 
        $query = $this->db->get($this->config->item('table_name'));
        
        return $query;
    }

    function export_printrequested() {
        $this->db->where('COL_QSL_SENT', 'R');
        $this->db->order_by("COL_TIME_ON", "ASC"); 
        $query = $this->db->get($this->config->item('table_name'));
        
        return $query;
    }

    function sat_all() {
        $this->db->where('COL_PROP_MODE', 'SAT');
        $this->db->order_by("COL_TIME_ON", "ASC"); 
        $query = $this->db->get($this->config->item('table_name'));
        
        return $query;
    }

    function satellte_lotw() {
        $this->db->where('COL_PROP_MODE', 'SAT');

        $where = "COL_LOTW_QSLRDATE != ''";
        $this->db->where($where);

        $this->db->order_by("COL_TIME_ON", "ASC"); 
        $query = $this->db->get($this->config->item('table_name'));
        
        return $query;
    }
    
    function export_custom($from, $to) {
        $this->db->where("COL_TIME_ON BETWEEN '".$from."' AND '".$to."'");
        $this->db->order_by("COL_TIME_ON", "ASC"); 
        $query = $this->db->get($this->config->item('table_name'));

        return $query;
    }
    
    function export_lotw() {
        $this->db->where("COL_LOTW_QSL_SENT != 'Y'");
        $this->db->order_by("COL_TIME_ON", "ASC"); 
        $query = $this->db->get($this->config->item('table_name'));
        
        return $query;
    }
    
    function mark_lotw_sent($id) {
       $data = array(
       		'COL_LOTW_QSL_SENT' => 'Y'
    	  );
	
		$this->db->set('COL_LOTW_QSLSDATE', 'CURDATE()', FALSE); 
    	$this->db->where('COL_PRIMARY_KEY', $id);
    	$this->db->update($this->config->item('table_name'), $data); 
    }
}

?>
