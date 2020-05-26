<?php 
    include('koneksi.php');
?>

<?php 
$conn = mysqli_connect('localhost','root','','anggota_baru');
 
// DM0916001

// mengambil kode anggota terakhir di input dengan menggunakan query 
$no = mysqli_query($conn,"SELECT kode_anggota FROM tb_anggota ORDER BY kode_anggota DESC");

$kd_anggota = mysqli_fetch_array($no);
$kode       = $kd_anggota['kode_anggota'];

$urut       = substr($kode, 6, 3);
$tambah     = (int)$urut + 1; // mengubah bilangan menjadi 
$bln        = date("m");
$thn        = date("y");
 
// kondisi if else 
if(strlen($tambah) == 1) {
        $format ="DM". $bln. $thn. "00". $tambah;
    } else if (strlen($tambah) == 2){
        $format ="DM". $bln. $thn. "0". $tambah;
    } else {
        $format ="DM". $bln. $thn. $tambah;
    }

    if (isset($_POST['submit'])) {
        $no_urut = $_POST['no_urut'];
        $nama = $_POST['nama'];

        mysqli_query($conn, "INSERT INTO tb_anggota VALUE ('$no_urut','$nama')");

        header("location:index.php?success");



    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID OTOMATIS</title>
</head>
<body>
    <?php 
        if(isset($_GET['success'])) {
            echo "<h4>Data berhasil di simpan!!</h4>";
        }


    ?>
    <form action="" method="post">
    <table>
        <tr>
            <td>NO. URUT</td>
            <td><input type="text" name="no_urut" value="<?php echo $format; ?>" readonly></td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td><input type="text" name="nama" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Simpan"></td>
        </tr>
    </table>
    </form>
    
</body>
</html>