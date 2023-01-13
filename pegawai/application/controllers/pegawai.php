<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
	public function index()
	{
		$data['pegawai'] = $this->m_pegawai->tampil_data()->result();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pegawai', $data);
		$this->load->view('template/footer');
	}
	public function tambah()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pegawai');
		$this->load->view('template/footer');
	}
	public function tambah_aksi()
	{	
		$nama		= $this->input->post('nama');
		$nip		= $this->input->post('nip');
		$tgl_lahir 	= $this->input->post('tgl_lahir');
		$alamat 	= $this->input->post('alamat');
		$no_telp 	    = $this->input->post('no_telp');
		$foto		= $_FILES['foto'];
		if ($foto = '') {
		} else {
			$config['upload_path'] = './assets/foto';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('foto')) {
				echo "Upload Gagal";
				die();
			} else {
				$foto = $this->upload->data('file_name');
			}
		}
		$data = array(
			'nama' => $nama,
			'nip' => $nip,
			'tgl_lahir' => $tgl_lahir,
			'alamat' => $alamat,
			'no_telp' => $no_telp,
			'foto'  => $foto,
		);
		$this->m_pegawai->input_data($data, 'tb_karyawan');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		DATA BERHASIL DI TAMBAHKAN !.</div>');
		redirect('pegawai/index');
	}
	public function hapus($id)
	{
		$where = array('id' => $id);
		$this->m_pegawai->hapus_data($where, 'tb_karyawan');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		DATA BERHASIL DI HAPUS !.</div>');
		redirect('pegawai/index');
	}
	public function edit($id)
	{
		$where = array('id' => $id);
		$data['pegawai'] = $this->m_pegawai->edit_data($where, 'tb_karyawan')->result();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('edit', $data);
		$this->load->view('template/footer');
	}
	public function update()
	{
		$id			= $this->input->post('id');
		$nama		= $this->input->post('nama');
		$nip		= $this->input->post('nip');
		$tgl_lahir 	= $this->input->post('tgl_lahir');
		// $jurusan 	= $this->input->post('jurusan');
		$alamat 	= $this->input->post('alamat');
		// $email		= $this->input->post('email');
		$no_telp 	= $this->input->post('no_telp');
		$foto		= $_FILES['foto'];
		if ($foto = '') {
		} else {
			$config['upload_path'] = './assets/foto';
			$config['allowed_types'] = 'jpg|png|gif|jpeg';
			$this->load->library('upload');
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('foto')) {
				echo "Upload Gagal";
				die();
			} else {
				$foto = $this->upload->data('file_name');
			}
		$data = array(
			'nama' => $nama,
			'nip' => $nip,
			'tgl_lahir' => $tgl_lahir,
			// 'jurusan' => $jurusan,
			'alamat' => $alamat,
			// 'email' => $email,
			'no_telp' => $no_telp,
			'foto' => $foto,
		);
		$where = array(
			'id' => $id
		);
		$this->m_pegawai->update_data($where, $data, 'tb_karyawan');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		DATA BERHASIL DI UBAH !.</div>');
		
		redirect('pegawai/index');
	}
	}
	public function detail($id)
	{
		$this->load->model('m_pegawai');
		$detail = $this->m_pegawai->detail_data($id);
		$data['detail'] = $detail;
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('detail', $data);
		$this->load->view('template/footer');
	}
	public function print(){
		$data['pegawai']=$this->m_pegawai->tampil_data("tb_karyawan")->result();
		$this->load->view('print_pegawai',$data);

	}	
	public function search() {
		$keyword = $this->input->post('search');
		$data['pegawai']=$this->m_pegawai->get_keyword($keyword);
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('pegawai', $data);
		$this->load->view('template/footer');
	}
	
	public function pdf1()
	{
		$this->load->library('Pdf');
		error_reporting(0);
		$pdf = new FPDF('P', 'mm', 'Letter');
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', '16');
		$pdf->Cell(0, 7, 'Daftar Karyawan', 0, 1, 'C');
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 10, 'No', 1, 0, 'C');
		$pdf->Cell(60, 10, 'Nama Karyawan', 1, 0, 'C');
		$pdf->Cell(30, 10, 'NIP', 1, 0, 'C');
		$pdf->Cell(50, 10, 'Tanggal Lahir', 1, 0, 'C');
		$pdf->Cell(50, 10, 'Alamat', 1, 1, 'C');
		$pdf->SetFont('Arial', '', 10);
		$mahasiswa = $this->db->get('tb_karyawan')->result();
		$no = 0;
		foreach ($mahasiswa as $data) {
			$no++;
			$pdf->Cell(10, 10, $no, 1, 0, '');
			$pdf->Cell(60, 10, $data->nama, 1, 0);
			$pdf->Cell(30, 10, $data->nip, 1, 0);
			$pdf->Cell(50, 10, $data->tgl_lahir, 1, 0);
			$pdf->Cell(50, 10, $data->alamat, 1, 1);
		}
		$pdf->Output();
	}

	public function exportExcel()
	{
		$data = $this->m_pegawai->get_data();
		include_once APPPATH . '/third_party/xlsxwriter.class.php';
		ini_set('display_errors', 0);
		ini_set('log_error', 1);
		error_reporting(E_ALL & ~E_NOTICE);
		$filename = "report-" . date('d-m-Y-H-i-s') . ".xlsx";
		header('Content-disposition: attachment; filename="' . XLSXWriter::sanitize_filename($filename) . '"');
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Transfer-Encoding: binary');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		$styles = array(
			'widths' => [3, 20, 30, 40], 'font' => 'Arial', 'font-size' => 10, 'font-styles' => 'bold', 'fill' => '#eee',
			'halign' => 'center', 'border' => 'left,right,top,bottom'
		);
		$styles2 = array(
			[
				'font' => 'Arial', 'font-size' => 10, 'font-styles' => 'bold', 'fill' => '#eee',
				'halign' => 'left', 'border' => 'left,right,top,bottom', 'fill' => '#ffc'
			],
			['fill' => '#fcf'], ['fill' => '#ccf'], ['fill' => '#cff'], ['fill' => '#cff'], ['fill' => '#fcf']
		);
		$header = array(
			'No' => 'integer',
			'Nama Pegawai' => 'string',
			'NIP' => 'string',
			'Tanggal Lahir' => 'string',
			'alamat' => 'string',
			'foto' => 'string',
		);
		$writer = new XLSXWriter();
		$writer->setAuthor('Rifqi');
		$writer->writeSheetHeader('Sheet1', $header, $styles);
		$no = 1;
		foreach ($data as $row) {
			$writer->writeSheetRow('Sheet1', [$no, $row['nama'], $row['nip'], $row['tgl_lahir'], $row['alamat']],$row['Foto'], $styles2);
			$no++;
		}
		$writer->writeToStdOut();
	}

	function tampil_grafik() {
        $this->load->model('m_pegawai');
        $data['hasil']=$this->m_pegawai->jum_pegawai();
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('v_grafik', $data);
		$this->load->view('template/footer');
    }

	public function dashboard()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('dashboard');
		$this->load->view('template/footer');
	}

	public function profile()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('profile');
		$this->load->view('template/footer');
	}

	public function about()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('about');
		$this->load->view('template/footer');
	}

}
