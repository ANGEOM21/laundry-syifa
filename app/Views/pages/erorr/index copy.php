<?php include __DIR__ . '/../../partials/header.php'; ?>
<div class=" bg-dark d-flex align-items-center" style="height: 100vh;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="card border-0 bg-dark align-items-center p-5">
				<div class="col  text-center">
					<h1 class="display-4 text-white fw-bold">Error</h1>
					<div class="justify-content-center d-flex">
						<h1 class="text-white fw-bold fs-5">4</h1>
						<h1 class="text-danger fw-bold fs-5">0</h1>
						<h1 class="text-white fw-bold fs-5">4</h1>
					</div>
					<p class="lead class text-white"><?= $data['message'] ?></p>
					<a href="<?= BASEURL ?>/" class="btn btn-outline btn-danger">Kembali ke Beranda</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include __DIR__ . '/../../partials/footer.php'; ?>