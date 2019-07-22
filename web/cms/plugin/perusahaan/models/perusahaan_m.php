<?php defined('BASEPATH') OR exit('No direct script access allowed');

class perusahaan_m extends GW_Model {
	
	function get_list_perusahaan($_w = array()){
		
		$this->db->select('i.*');
		
		$this->db->from('mdl_company i');				
		
		$query = $this->db->get();
		
		debug($this->db->last_query());
		
		return $query->result();
	}
	
	function get_single_perusahaan($_w = array()){
	
		$_ = $this->get_list_perusahaan($_w);
		
		return $_[0];		
	}
	
	function get_menu_company_id($company_id){
		
		$this->db->select('NAV_LIST_ID id');
		
		$this->db->from('mdl_navigation_list');
		
		$this->db->where('NAV_LIST_URL', $company_id);
		
		$this->db->where('NAV_TYPE_ID', 4); // 4 = perusahaan type
		
		$query = $this->db->get();
		
		return $query->row()->id;
	}
	
	function get_menu($nav_list_id){
		
		$this->db->select('NAV_LIST_ID id, NAV_LIST_TITLE title, NAV_TYPE_ID type, NAV_LIST_URL url, NAV_LIST_PARENT_ID parent_id');
		
		$this->db->from('mdl_navigation_list');
		
		$this->db->where('NAV_LIST_ID', $nav_list_id);
		
		$query = $this->db->get();
		
		return $query->row();
	}

//Andy
	function tambahperusahaan()
	{
		$data = [
			
			"company" => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'kodepos' => $this->input->post('kodepos'),
			'keterangan' => $this->input->post('ket')
			];

			$this->db->insert('mdl_company', $data);
	}
	
	function hapusperusahaan($id)
        {            
            $this->db->delete('mdl_company', ['company_id' => $id]);
		}

	function getperusahaanById($id)
        {
            return $this->db->get_where('mdl_company', ['company_id' => $id])->row_array();
		}
		
	function editperusahaan()
        {
            $data = [
                "company" => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'telepon' => $this->input->post('telepon'),
				'kodepos' => $this->input->post('kodepos'),
				'keterangan' => $this->input->post('keterangan')
            ];

            $this->db->where('company_id', $this->input->post('id'));
            $this->db->update('mdl_company', $data);
		}
		
		function getProvinsi()
        {
			$query = $this->db->get('ori_master_provinsi');		
			return $query->result();           
		}	
	
}
