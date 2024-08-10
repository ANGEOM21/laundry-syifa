<?php $categories = [['Kiloan' => ['kiloan','0.1s']], ['Satuan' => ['satuan','0.2s']], ['Express' =>[ 'express','0.3s']]]; ?>

<div class="category my-5" id="category">
	<div class="container">
		<div class="section-header text-srart wow zoomIn" data-wow-delay="0.1s">
			<p>Kategori</p>
			<h2>Sistem Pemesanan</h2>
		</div>
		<div class="row">
			<?php foreach ($categories as $category) { ?>
				<?php foreach ($category as $k => $v) { ?>
					<div class="col-lg-4 gap-4 px-5">
						<div class="category-item wow animate__animated animate__fadeInUp" data-wow-delay="<?= $v[1]?>">
							<div class="category-img">
								<img src="/img/category/<?= $v[0] ?>.webp" alt="<?= $v[0] ?>" width="60">
							</div>
							<div class="category-text">
								<h2 class="text-center">Sistem Pemesanan</h2>
								<h2 class="text-center"><?= $k ?></h2>
								<a class="btn" href="<?= BASEURL ?>/<?= $v[0] ?>">Read More <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>