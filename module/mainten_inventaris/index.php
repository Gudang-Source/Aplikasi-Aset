<?php require_once('Connections/koneksi.php');?>
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

mysql_select_db($database_koneksi, $koneksi);
$query_rs_data = "SELECT * FROM maintenance ORDER BY id_pemeliharaan ASC";
$rs_data = mysql_query($query_rs_data, $koneksi) or die(mysql_error());
$row_rs_data = mysql_fetch_assoc($rs_data);
$totalRows_rs_data = mysql_num_rows($rs_data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<!--tombol tambah -->
<div class=grid_12> 
   <br/>
   <a href='?mod=mainten_inventaris&amp;act=add' class='button'>
   <span>Tambahkan Data</span>
   </a></div>

<!-- Data  -->
<div class="grid_12">
  <div class="block-border">
    <div class="block-header">
      <h1>Data Perbaikan Inventaris</h1>
      <span></span> </div>
    <div class="block-content">
      <table id="table-example" class="table" cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr> 
            <th>NO</th>
            <th>ID </th>
            <th>Kode Inventaris</th>
            <th>Tgl Servis</th>
            <th>Tempat Servis</th>
            <th>Keluhan</th>
            <th>Ket.</th>
            <th>Biaya</th>
            <th>User Posting</th>
            <th>Tgl Posting</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
         <?php $no = 1;?>
          <?php do { ?>
            <tr class=gradeX>
              <td><center><?php echo $no++ ?></center></td>
              <td><center>
                <?php echo $row_rs_data['id_pemeliharaan']; ?>
              </center></td>
              <td><?php echo $row_rs_data['kode_inventarisasi']; ?></td>
              <td ><?php echo $row_rs_data['tgl_servis']; ?></td>
              <td ><?php echo $row_rs_data['tempat_servis']; ?></td>
              <td  width="80"><?php echo $row_rs_data['keluhan']; ?></td>
              <td  width="50"><?php echo $row_rs_data['keterangan_pem']; ?></td>
              <td  width="50"><?php echo $row_rs_data['biaya_servis']; ?></td>
              <td  width="50"><?php echo $row_rs_data['user_posting']; ?></td>
              <td  width="50"><?php echo $row_rs_data['tgl_posting']; ?></td>
              <td  width="50"><a href="?mod=mainten_inventaris&amp;act=delete&amp;id_pemeliharaan=<?php echo $row_rs_data['id_pemeliharaan']; ?>" onclick="return confirm('Hapus Data <?php echo $row_rs_data['kode_inventarisasi']; ?> ')"><img src="img/icons/packs/silk/16x16/cross.png" width="16" height="16" alt="Hapus" title="Hapus" /></a></td>
            </tr>
            <?php } while ($row_rs_data = mysql_fetch_assoc($rs_data)); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($rs_data);
?>
