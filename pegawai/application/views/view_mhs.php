<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <table border='1px solid black'>
        <tr>
            <th>NAMA MAHASISWA</th>
            <th>NIM</th>
            <th>ALAMAT</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs):?>
        <tr>
            <td><?php echo $mhs['nama'];?></td>
            <td><?php echo $mhs['nim'];?></td>
            <td><?php echo $mhs['alamat'];?></td>
        </tr>
        <?php endforeach;?>
    </table>
    <!-- <?php print_r ($mahasiswa);?> -->
</body>
</html>