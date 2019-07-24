<?php defined('BASEPATH') OR exit('No direct script access allowed');

class kantor_m extends GW_Model {
	
	function get_list_kantor($_w = array()){				
		$this->db->select('mdl_office.*, mdl_company.company, ori_master_kabupaten.prov, ori_master_kabupaten.kab');
		$this->db->from('mdl_office');
		$this->db->join('mdl_company', 'mdl_office.company_id = mdl_company.company_id');
		$this->db->join('ori_master_kabupaten', 'mdl_office.no_kab = ori_master_kabupaten.kab_kode and mdl_office.no_prop = ori_master_kabupaten.prov_kode');
		$this->db->limit(10);
		$query = $this->db->get();		
		debug($this->db->last_query());		
		return $query->result();
	}
	
	function get_single_kantor($_w = array()){
	
		$_ = $this->get_list_kantor($_w);
		
		return $_[0];		
	}
	
	function get_menu_company_id($company_id){
		
		$this->db->select('NAV_LIST_ID id');
		
		$this->db->from('mdl_navigation_list');
		
		$this->db->where('NAV_LIST_URL', $company_id);
		
		$this->db->where('NAV_TYPE_ID', 4); // 4 = kantor type
		
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
	function tambahkantor()
	{
		$data = [
			
			"company_name" => $this->input->post('nama_perusahaan'),
			'office' => $this->input->post('nama_kantor'),
			'alamat_office' => $this->input->post('alamat_kantor'),
			'no_prop' => $this->input->post('provinsi'),
			'no_kab' => $this->input->post('kabupaten'),
			'lon' => $this->input->post('longitude'),
			'lat' => $this->input->post('latitude'),
			'gmt' => $this->input->post('gmt'),
			];

			$this->db->insert('mdl_office', $data);
			
			
	}
	
	function hapuskantor($id)
        {            
            $this->db->delete('mdl_office', ['office_id' => $id]);
		}

	function getkantorById($id)
        {
            return $this->db->get_where('mdl_office', ['office_id' => $id])->row_array();
		}

	function getkantorByIdper($id)
        {
			$this->db->select('mdl_office.*, mdl_company.company, ori_master_kabupaten.prov, ori_master_kabupaten.kab');
			$this->db->from('mdl_office');
			$this->db->join('mdl_company', 'mdl_office.company_id = mdl_company.company_id');
			$this->db->join('ori_master_kabupaten', 'mdl_office.no_kab = ori_master_kabupaten.kab_kode and mdl_office.no_prop = ori_master_kabupaten.prov_kode');
			$this->db->where("mdl_office.company_id = '$id'");			
			$query = $this->db->get();		
			debug($this->db->last_query());		
			return $query->result();
		}
		
	function editkantor()
        {
            $data = [
            "company_id" => $this->input->post('company_id'),
			'office' => $this->input->post('kantor'),
			'alamat' => $this->input->post('alamat'),
			'no_prop' => $this->input->post('provinsi'),
			'no_kab' => $this->input->post('kabupaten'),
			'lon' => $this->input->post('lon'),
			'lat' => $this->input->post('lat'),
			'gmt' => $this->input->post('gmt'),
            ];

            $this->db->where('office_id', $this->input->post('id'));
            $this->db->update('mdl_office', $data);
		}
		
		function getPerusahaan()
        {				
			$this->db->select('company_id, company');
			$this->db->from('mdl_company');
			$query = $this->db->get();
			debug($this->db->last_query());			
			return $query->result_array();           
		}
		
	function getProvinsi()
        {				
			$this->db->select('prov_kode, prov');
			$this->db->from('ori_master_provinsi');
			$query = $this->db->get();
			debug($this->db->last_query());			
			return $query->result_array();           
		}
		
	function getKabupaten()
        {				
			$this->db->select('kab_kode, kab');
			$this->db->from('ori_master_kabupaten');
			$query = $this->db->get();
			debug($this->db->last_query());			
			return $query->result_array();           
		}
	function getKab()
        {
            /* kita joinkan tabel kota dengan provinsi
            $this->db->order_by('kab', 'asc');
            $this->db->join('ori_master_provinsi', 'ori_master_kabupaten.prov_kode = ori_master_provinsi.prov_kode');
            return $this->db->get('ori_master_kabupaten')->result_array();*/
			$this->db->select('*');
			$this->db->from('ori_master_kabupaten');
			$this->db->join('ori_master_provinsi', 'ori_master_provinsi.PROV_KODE = ori_master_kabupaten.PROV_KODE');
			$query = $this->db->get();
			debug($this->db->last_query());			
			return $query->result_array();  
        }		
			
	function getkabkot($id)
	{
		$hasil = $this->db->query("select * from ori_master_kabupaten join ori_master_provinsi on ori_master_kabupaten.PROV_KODE=ori_master_provinsi.PROV_KODE and ori_master_kabupaten.KAB_KODE=ori_master_provinsi.KAB_KODE where office_id='$id'");
	}
	
}