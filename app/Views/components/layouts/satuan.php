<?php $categories = [['Karpet' =>[ 'karpet','0.1s']], ['Sepatu' => ['sepatu','0.2s']], ['Tas' => ['tas','0.3s']], ['Boneka' => ['boneka','0.4s']]];
?>
<div class="category-kiloan my-5" id="category-kiloan">
	<div class="container">
		<div class="section-header text-srart wow zoomIn" data-wow-delay="0.1s">
			<p>Kategori</p>
			<h2>Jenis-Satuan</h2>
		</div>
		<div class="row border-kiloan mx-3">
			<?php foreach ($categories as $category) { ?>
				<?php foreach ($category as $k => $v) { ?>
					<div class="col-lg-3 col-6 gap-3 px-lg-5 px-3 card-kiloan-item">
						<div class="category-kiloan-item wow animate__animated animate__fadeInRight" data-wow-delay="<?= $v[1] ?>" data-wow-duration="2s">
							<div class="category-kiloan-img pt-4">
								<img src="/img/category/<?= $v[0] ?>.webp" alt="<?= $v[0] ?>" width="60">
							</div>
							<div class="category-kiloan-text mt-2">
								<h2 class="text-center text-white"><?= $k ?></h2>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
