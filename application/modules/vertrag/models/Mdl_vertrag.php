
<?php

class Mdl_Vertrag extends Response_Model{

    public function getAll() {
        return $this->db->get('ip_vertrag')->result();
    }

    public function insert($data) {
        $this->db->insert('ip_vertrag', $data);
        return $this->db->insert_id();
    }

    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('ip_vertrag')->row();
    }
    public function getDataByClientId($id) {
        $this->db->where('client_id', $id);
        return $this->db->get('ip_vertrag')->row();
    }

    public function update($id,$data) {
        $this->db->where('id', $id);
        $this->db->update('ip_vertrag', $data);
        return true;
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('ip_vertrag');
        return true;
    }

    public function changeStatus($id) {
        $table=$this->getDataById($id);
             if($table[0]->status==0)
             {
                $this->update($id,array('status' => '1'));
                return "Activated";
             }else{
                $this->update($id,array('status' => '0'));
                return "Deactivated";
             }
    }
}