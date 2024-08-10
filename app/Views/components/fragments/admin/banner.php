<?php
$banners = [
	['Kategori Jenis Kiloan' => ['/img/category/kiloan.webp']],
	['Kategori Jenis Satuan' => ['/img/category/satuan.webp']],
	['Kategori Jenis Express' => ['/img/category/express.webp']],
];
?>
<h3 style="font-weight: 400;">Jenis Layanan</h3>
<p>Berikut beberapa Jenis Layanan Kategori</p>
<div class="d-flex justify-content-center">
	<div class="row gap-5">
		<?php foreach ($banners as $banner) { ?>
			<?php foreach ($banner as $k => $v) { ?>
				<div class=" d-flex align-items-center p-1 rounded-lg col col-lg-4">
					<div class="bg-banner">
						<img src="<?= BASEURL; ?><?= $v[0] ?>" alt="" width="150">
						<h5 class="mx-2 text-white"><?= $k ?></h4>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
</div>
<hr>