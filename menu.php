<?php include('db_connect.php'); ?>

<div class="container-fluid">

	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
				<form action="" id="manage-menu">
					<div class="card">
						<div class="card-header">
							Form Menu
						</div>
						<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Nama Menu</label>
								<input type="text" class="form-control" name="name">
							</div>
							<div class="form-group">
								<label class="control-label">Deskripsi Menu</label>
								<textarea cols="30" rows="3" class="form-control" name="description"></textarea>
							</div>
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input type="checkbox" name="status" class="custom-control-input" id="availability" checked>
									<label class="custom-control-label" for="availability">Tersedia</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Kategori</label>
								<select name="category_id" id="" class="custom-select browser-default">
									<?php
									$cat = $conn->query("SELECT * FROM category_list order by name asc ");
									while ($row = $cat->fetch_assoc()) :
									?>
										<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
									<?php endwhile; ?>
								</select>

							</div>
							<div class="form-group">
								<label class="control-label">Harga</label>
								<input type="number" class="form-control text-right" name="price" step="any">
							</div>
							<div class="form-group">
								<label for="" class="control-label">Gambar</label>
								<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
							</div>
							<div class="form-group">
								<img src="<?php echo isset($image_path) ? '../assets/img/' . $cover_img : '' ?>" alt="" id="cimg">
							</div>
						</div>

						<div class="card-footer">
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Simpan</button>
									<button class="btn btn-btn btn-secondary col-sm-4" type="button" onclick="$('#manage-menu').get(0).reset()">Kembali</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Img</th>
									<th class="text-center">Deskripsi</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$cats = $conn->query("SELECT * FROM product_list order by id asc");
								while ($row = $cats->fetch_assoc()) :
								?>
									<tr>
										<td class="text-center"><?php echo $i++ ?></td>


										<td class="text-center">
											<img src="<?php echo isset($row['img_path']) ? '../assets/img/' . $row['img_path'] : '' ?>" alt="" id="cimg">
										</td>
										<td class="">
											<p>Nama : <b><?php echo $row['name'] ?></b></p>
											<p>Deskripsi : <b class="truncate"><?php echo $row['description'] ?></b></p>
											<p>Harga : <b><?php echo "Rp." . number_format($row['price'], 3) ?></b></p>
										</td>
										<td class="text-center">
											<button class="btn btn-sm btn-primary edit_menu" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>" data-status="<?php echo $row['status'] ?>"
											 data-description="<?php echo $row['description'] ?>" data-price="<?php echo $row['price'] ?>" data-img_path="<?php echo $row['img_path'] ?>">Ubah</button>
											<button class="btn btn-sm btn-danger delete_menu" type="button" data-id="<?php echo $row['id'] ?>">Hapus</button>

										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Table Panel -->

<style>
	img#cimg,
	.cimg {
		max-height: 10vh;
		max-width: 6vw;
	}

	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset !important;
	}

	.custom-switch,
	.custom-control-input,
	.custom-control-label {
		cursor: pointer;
	}

	b.truncate {
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
		font-size: small;
		color: #000000cf;
		font-style: italic;
	}
</style>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#manage-menu').submit(function(e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_menu',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data berhasil ditambahkan", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				} else if (resp == 2) {
					alert_toast("Data berhasil diperbarui", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	})
	$('.edit_menu').click(function() {
		start_load()
		var cat = $('#manage-menu')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		if ($(this).attr('data-status') == 1)
			$('#availability').prop('checked', true)
		else
			$('#availability').prop('checked', false)

		cat.find("#cimg").attr('src', '../assets/img/' + $(this).attr('data-img_path'))
		end_load()
	})
	$('.delete_menu').click(function() {
		_conf("Apakah Yakin Ingin Menghaupsnya?", "delete_menu", [$(this).attr('data-id')])
	})

	function delete_menu($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_menu',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data Telah Terhapus", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>