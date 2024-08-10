<!-- Modal -->
<div class="modal fade" id="modal-admin" tabindex="-1" aria-labelledby="modal-adminLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-adminLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-admin" method="post" action="">
				<div class="modal-body">
					<div class="form-row">
						<div class="col px-4 mb-3">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" required>
							<div class="invalid-feedback">
								nama harus berupa huruf dan jangan kurang dari 3 huruf
							</div>
							<small id="passwordHelpBlock" class="form-text text-muted d-flex">
								<p class="text-danger mr-1">* </p> Nama Wajib di isi minimal 3 karakter
							</small>
						</div>
					</div>
					<div class="form-row" id="form-row-2">
						<div class="col px-4 mb-3">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email">
							<div class="invalid-feedback">
								email harus berupa format email @
							</div>
							<small id="passwordHelpBlock" class="form-text text-muted d-flex">
								<p class="text-primary mr-1">- </p> Email tidak wajib di isi
							</small>
						</div>
					</div>
					<div class="form-row" id="form-row-2">
						<div class="col justify-content-center px-4 mb-3">
							<label for="no_hp">Nomor Hp</label>
							<input type="text" class="form-control" id="no_hp" aria-describedby="no_hpFeedback" name="no_hp" required>
							<div class="invalid-feedback">
								nomor hp harus berupa angka dan panjang minimal 11
							</div>
							<small id="passwordHelpBlock" class="form-text text-muted d-flex">
								<p class="text-danger mr-1">* </p> Nomor Hp Wajib di isi
							</small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="reset" class="btn-admin-1">Reset</button>
					<button type="submit" class="btn-admin" name="tambah" id="modal-admin-submit">
						<img src='/img/admin/icons/plus.svg' width='20px' alt='plus img' style="filter: invert(60%) hue-rotate(180deg) contrast(400%);"> Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>