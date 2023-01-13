<div class = "content-wrapper">
    <section class = "content">
        <h4><strong> DETAIL DATA PEGAWAI</strong>
    </h4>
    <table class ="table">
        <tr>
            <th> Nama Lengkap </th>
            <td><?php echo $detail->nama ?> </td>
</tr>

            <th> nip </th>
            <td><?php echo $detail-> nip ?> </td>
</tr>

            <th> tanggal lahir </th>
            <td><?php echo $detail->tgl_lahir ?> </td>
<!-- </tr>

            <th> jurusan </th>
            <td><?php echo $detail->jurusan ?> </td> -->
</tr>
            <th> alamat </th>
            <td><?php echo $detail->alamat?> </td>
<!-- </tr>

            <th> email </th>
            <td><?php echo $detail->email ?> </td> -->
</tr>
           <th> no_telp </th>
            <td><?php echo $detail->no_telp ?> </td>

            <tr>
            <td>
                <img src="<?php echo base_url() ?>assets/foto/<?php echo $detail->foto; ?>" width="90" height="110">
            </td>
        </tr>
    </table>
    <a href = "<?php echo base_url('pegawai/index'); ?>"class="btn btn-primary">kembali</a>   
</section>
</div>