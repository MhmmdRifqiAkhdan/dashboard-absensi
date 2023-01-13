<div class="content-wrapper">
    <section class="content">
        <?php foreach ($pegawai as $pgw) { ?>
            <!-- <form action="<?php echo base_url() . 'pegawai/update'; ?>" method="post"> -->
            <?php echo form_open_multipart('pegawai/update') ?>
            <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="hidden" name="id" class="form-control" value="<?php echo $pgw->id ?>">
                <input type="text" name="nama" class="form-control" value="<?php echo $pgw->nama ?>">
            </div>
            <div class="form-group">
                <label>NIP</label>
                <input type="text" name="nip" class="form-control" value="<?php echo $pgw->nip ?>">
            </div>
            <div class=" form-group">
                <label>Tanggal Lahir</label>
                <input type="text" name="tgl_lahir" class="form-control datepicker" value="<?php echo $pgw->tgl_lahir ?>">
            </div>
            <!-- <div class=" form-group">
                <label>Jurusan</label>
                <input type="text" name="jurusan" class="form-control" value="<?php echo $pgw->jurusan ?>">
            </div> -->
            <div class=" form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo $pgw->alamat ?>">
            </div>
            <!-- <div class=" form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $pgw->email ?>">
            </div> -->
            <div class=" form-group">
                <label>no_telp</label>
                <input type="text" name="no_telp" class="form-control" value="<?php echo $pgw->no_telp ?>">
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            <!-- </form> -->
            <?php echo form_close(); ?>
        <?php } ?>
</div>