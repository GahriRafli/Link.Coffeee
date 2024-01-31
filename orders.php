<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			
		<div class="float-right input-group mb-2 col-md-5">
				<input type="text" class="form-control" placeholder="cari" aria-label="Recipient's username" aria-describedby="basic-addon2">
				
				<div class="input-group-append mb-3 col-md-2">
					<a href="print.php" target="_blank"><button class="btn btn-sm btn-primary">Cetak</button></a>
				</div>
			</div>

			<table class="table table-bordered">
				<thead>
					<tr>

						<th>No</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>Email</th>
						<th>No Hp / Dana</th>
						<th>Tanggal</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					include 'db_connect.php';
					$qry = $conn->query("SELECT * FROM orders");
					while ($row = $qry->fetch_assoc()) :
					?>
						<tr>
							<td><?php echo $i++ ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['address'] ?></td>
							<td><?php echo $row['email'] ?></td>
							<td><?php echo $row['mobile'] ?></td>
							<td><?php echo $row['Date'] ?></td>

							<?php if ($row['status'] == 1) : ?>
								<td class="text-center"><span class="badge badge-success">Terkonfirmasi</span></td>
							<?php else : ?>
								<td class="text-center"><span class="badge badge-secondary">Belum dikonfirmasi</span></td>
							<?php endif; ?>
							<td>
								<button class="btn btn-sm btn-primary view_order" type="button" data-id="<?php echo $row['id'] ?>">Lihat</button>
								<button class="btn btn-sm btn-danger delete_order" type="button" data-id="<?php echo $row['id'] ?>">Hapus</button>
							</td>
						</tr>
					<?php
					endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>

</div>

<script>
	$('.view_order').click(function() {
		uni_modal('Order', 'view_order.php?id=' + $(this).attr('data-id'))
	})

	$('.delete_order').click(function() {
		_conf("Apakah Yakin Ingin menghapusnya ?", "delete_order", [$(this).attr('data-id')])
	})

	function delete_order($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_order',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data Sukses dihapus", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>