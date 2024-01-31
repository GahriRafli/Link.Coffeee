<!DOCTYPE html>
<html>
<head>
	<title>Cetak Laporan</title>
</head>

<style>
      table,
      table td {
        border: 1px solid #cccccc;
      }
      td {
        height: 80px;
        width: 160px;
        text-align: center;
        vertical-align: middle;
      }
</style>

<body>
 
	<center>
 
		<h2>Laporan Penjualan</h2>
		<h4>Link.Coffeee</h4>
 
	</center>
 
	<?php 
	include 'db_connect.php';
	?>

	<table border="1" style="width: 95%">
		<tr> 
			<th width="1%">No</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>No Hp / DANA</th>
			<th>email</th>
			<th>tanggal</th>
			<th width="3%">Jumlah</th>
		</tr>
		<?php 
		$no = 1;
		$sql = mysqli_query($conn,"select * from orders inner join order_list");
		while($data = mysqli_fetch_array($sql)){
		?>

		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $data['name']; ?></td>
			<td><?php echo $data['address']; ?></td>
			<td><?php echo $data['mobile']; ?></td>
			<td><?php echo $data['email']; ?></td>
			<td><?php echo $data['Date']; ?></td>
			<td><?php echo $data['qty']; ?></td>
		</tr>

		<?php 
		}
		?>
	</table>
 
	<script>
		window.print();
	</script>
 
</body>
</html>