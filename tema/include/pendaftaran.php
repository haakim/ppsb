
<?php
include "Connections/upload-foto.php";
$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name']; ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

?>

<?php $editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

 if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {	
	if (!empty($lokasi_file)){ 
	UploadGaleri($nama_file) ;
  $insertSQL = sprintf("INSERT INTO smapunggur_siswa (username, password, nama_lengkap, jenis_kelamin, agama, tempat_lahir, tanggal_lahir, nama_ortu, alamat_siswa, sekolah_asal, foto,tahun_ajaran, status) VALUES (%s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['jenis_kelamin'], "int"),
                       GetSQLValueString($_POST['agama'], "int"),
                       GetSQLValueString($_POST['tempat_lahir'], "text"),
                       GetSQLValueString($_POST['tanggal_lahir'], "date"),
                       GetSQLValueString($_POST['nama_ortu'], "text"),
                       GetSQLValueString($_POST['alamat_siswa'], "text"),
                       GetSQLValueString($_POST['sekolah_asal'], "text"),
                       GetSQLValueString($nama_file, "text" ),
                       GetSQLValueString($_POST['tahun_ajaran'], "text"),
					   GetSQLValueString($_POST['status'], "int"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($insertSQL, $smapunggur_db) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: index.php?page=berhasil"));
}
else { 
  $insertSQL = sprintf("INSERT INTO smapunggur_siswa (username, password, nama_lengkap, jenis_kelamin, agama, tempat_lahir, tanggal_lahir, nama_ortu, alamat_siswa, sekolah_asal, foto, status) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['nama_lengkap'], "text"),
                       GetSQLValueString($_POST['jenis_kelamin'], "int"),
                       GetSQLValueString($_POST['agama'], "int"),
                       GetSQLValueString($_POST['tempat_lahir'], "text"),
                       GetSQLValueString($_POST['tanggal_lahir'], "date"),
                       GetSQLValueString($_POST['nama_ortu'], "text"),
                       GetSQLValueString($_POST['alamat_siswa'], "text"),
                       GetSQLValueString($_POST['sekolah_asal'], "text"),
                       GetSQLValueString('no-image.jpg', "text" ),
                       GetSQLValueString($_POST['tahun_ajaran'], "text"),
					   GetSQLValueString($_POST['status'], "int"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($insertSQL, $smapunggur_db) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
}
?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO smapunggur_nilai (username, nilai_mtk, nilai_bing, nilai_bindo, nilai_ipa, nilai_ips) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['nilai_mtk'], "double"),
                       GetSQLValueString($_POST['nilai_bing'], "double"),
                       GetSQLValueString($_POST['nilai_bindo'], "double"),
                       GetSQLValueString($_POST['nilai_ipa'], "double"),
                       GetSQLValueString($_POST['nilai_ips'], "double"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($insertSQL, $smapunggur_db) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO smapunggur_tes (username, tes_akademis, tes_akademis_bakat, tes_bakat) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['tes_akademis'], "int"),
                       GetSQLValueString($_POST['tes_akademis_bakat'], "int"),
                       GetSQLValueString($_POST['tes_bakat'], "int"));

  mysql_select_db($database_smapunggur_db, $smapunggur_db);
  $Result1 = mysql_query($insertSQL, $smapunggur_db) or die(mysql_error());
}
?>
<!--BAGIAN ISI-->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="member/jquery-ui.css">
  <script src="member/jquery-1.10.2.js"></script>
  <script src="member/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#tanggal-lahir" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
</head>


<div class="isi">
<div class="judul-web">
REGISTRASI
</div>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
<div class="main">
 <div class="input-identitas">
  <div class="input-label">
  NISN:
    <label for="nama"></label>
    </div>  
  <input type="text" name="username" id="nama" class="input-daftar" maxlength="10" required>
  </div><div class="clear"></div>
   <div class="input-identitas">
  <div class="input-label">
  Password:
    <label for="nama"></label>
    </div>  
  <input type="text" name="password" id="nama" class="input-daftar" required>
  </div><div class="clear"></div>
  
<div class="judul-web">
Formulir Pendaftaran
</div>
<!--BAGIAN MAIN-->
<div class="main">

  <div class="input-identitas">
  <div class="input-label">
  Nama Calon Siswa:
    <label for="nama"></label>
    </div>  
  <input type="text" name="nama_lengkap" id="nama" class="input-daftar" required>
  </div><div class="clear"></div>
  
  <div class="input-identitas">
  <div class="input-label">
  Jenis Kelamin:
  <label for="jenis-kelamin"></label>
  </div>
  <label for="jenis-kelamin"></label>
  <select name="jenis_kelamin" id="jenis-kelamin" class="input-selek" required>
    <option selected>Pilih</option>
    <option value="0">Laki-laki</option>
    <option value="1">Perempuan</option>
  </select>
  </div><div class="clear"></div>
   <div class="input-identitas">
  <div class="input-label">
  Agama:
    <label for="nama"></label>
    </div>  
 <select name="agama" class="input-selek" required>
   <option value="0">islam</option>
   <option value="1">kristen</option>
   <option value="2">katolik</option>
   <option value="3">hindu</option>
   <option value="4">budha</option>
   <option value="5">kong hu chu</option>
 </select>
  <div class="clear"></div>
  
  <div class="input-identitas">
  <div class="input-label">
  Tempat Lahir :
  <label for="tempat-lahir"></label>
  </div>
  <input type="text" name="tempat_lahir" id="tempat-lahir" class="input-daftar" required>
  </div><div class="clear"></div>
  
  
  <div class="input-identitas">
  <div class="input-label">
  Tanggal Lahir:
  <label for="tanggal-lahir"></label>
  </div>
  <input type="text" name="tanggal_lahir" id="tanggal-lahir" class="input-daftar" required>
  </div><div class="clear"></div>
  <div class="input-identitas">
  <div class="input-label">
  Nama Orang Tua/Wali:
  <label for="nama-orangtua"></label>
  </div>
  <input type="text" name="nama_ortu" id="nama-orangtua" class="input-daftar" required>
  </div><div class="clear"></div>
  <div class="input-identitas">
  <div class="input-label">
  Alamat Siswa:
  <label for="alamat"></label>
  </div>
  <input type="text" name="alamat_siswa" id="alamat" class="input-daftar" required>
  </div><div class="clear"></div>
  <div class="input-identitas">
  <div class="input-label">
  Nama Sekolah Asal:
  <label for="nama-sekolah-asal"></label>
  </div>
  <input type="text" name="sekolah_asal" id="nama-sekolah-asal" class="input-daftar" required>
  </div><div class="clear"></div>
  
  <div class="input-identitas">
  <div class="input-label">
  foto 3x4 
  <label for="Foto"></label>
  </div>
  <input type="file" name="fupload" id="foto" class="input-daftar" required>
  </div><div class="clear"></div>
  </p>
  
  <div class="tes">
    <p><strong>NILAI UJIAN AKHIR NASIONAL SLTP</strong></p>
  <table width="254" border="1">
    <tr>
      <td width="31">No</td>
      <td width="164">Mata Pelajaran</td>
      <td width="37">Nilai</td>
    </tr>
    <tr>
      <td>1</td>
      <td>Matematika</td>
      <td><label for="mtk"></label>
        <input type="text" name="nilai_mtk" id="mtk" class="input-nilai" placeholder="90,00" required></td>
    </tr>
    <tr>
      <td>2</td>
      <td>Bahasa Inggris</td>
      <td><label for="bing"></label>
        <input type="text" name="nilai_bing" id="bing" class="input-nilai" required></td>
    </tr>
    <tr>
      <td>3</td>
      <td>Bahasa Indonesia</td>
      <td><label for="bindo"></label>
        <input type="text" name="nilai_bindo" id="bindo" class="input-nilai" required></td>
    </tr>
    <tr>
      <td>4</td>
      <td>Ilmu Pengetahuan Alam</td>
      <td><label for="ipa"></label>
        <input type="text" name="nilai_ipa" id="ipa" class="input-nilai" required></td>
    </tr>
    <tr>
      <td>5</td>
      <td>Ilmu Pengetahuan Sosial</td>
      <td><label for="ips" class=""></label>
        <input type="text" name="nilai_ips" id="ips" class="input-nilai" required></td>
    </tr>
  </table>
  </div>
  <div class="tes">
  <p><strong>TES YANG AKAN DIIKUTI</strong></p>
  
    <input type="checkbox" name="tes_akademis" id="Tes-akademis" required>
    <label for="Tes-akademis">Tes Akademis</label>
  
<br> 
<br> 
    <input type="checkbox" name="tes_akademis_bakat" id="Tes-bakat" required>
    <label for="Tes-bakat">Tes Akademis Dan Bakat</label>
    <br>
    <br>
    Tes bakat yang akan diikuti<br>
    <select name="tes_bakat" class="input-selek">
      <option selected="selected">Tidak Ikut</option>
      <option value="1">basket</option>
      <option value="2">volly</option>
      <option value="3">atletik</option>
      <option value="4">sepak bola</option>
    </select>
  
    
  
  </div>
  <p>&nbsp;</p>
	<div class="clear"></div>
    <div class="tes">
    <input type="submit"  value="Daftar" class="btn">
    <input type="submit"  value="Reset" class="btn reset">
    </div><div class="clear"></div>
<input type="hidden" name="status" value="0">
<input type="hidden" name="tahun_ajaran" value="2015/2016">
<input type="hidden" name="MM_insert" value="form1">
</form> 
</div> <!--PENUTUP ISI-->
</div>
</div>