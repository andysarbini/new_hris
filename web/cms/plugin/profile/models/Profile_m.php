<?php
class profile_m extends GW_Model {

    function delete($id)
    {            
        $this->db->delete('mdl_user_files', ['file_id' => $id]);
    }

}
