<?php
class m_pegawai extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('tb_karyawan');
    }
    public function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update_data($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function detail_data($id=NULL){
        $query=$this->db->get_where('tb_karyawan', array('id=' => $id))->row();
        return $query;
    }

    public function get_keyword($keyword){
        $this->db->select('*');
        $this->db->from('tb_karyawan');
        $this->db->like('nama', $keyword);
        $this->db->or_like('nip', $keyword);
        $this->db->or_like('tgl_lahir', $keyword);
        // $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('alamat', $keyword);
        // $this->db->or_like('email', $keyword);
        $this->db->or_like('no_telp', $keyword);
        return $this->db->get()->result();

    }

    public function get_data() {
        return $this->db->get('tb_karyawan')->result_array();
    }

    function jum_mahasiswa_perjurusan() {
        $this->db->group_by('jurusan');
        $this->db->select('jurusan');
        $this->db->select("count(*) as total");
        return $this->db->from('tb_karyawan')->get()->result();
        
    }

    public function row($table) {
        return $this->db->get($table);
    }

    
}