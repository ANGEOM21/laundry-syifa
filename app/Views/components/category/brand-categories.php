<?php $categories = [
	['Cuci dan setrika' => 'cuci dan setrika'],
	['Setrika' => 'setrika'],
	['Cuci' => 'cuci']
];
?>

<div class="category mt-5" id="category">
	<div class="container">
		<div class="row">
			<?php foreach ($categories as $category) { ?>
				<?php foreach ($category as $k => $v) { ?>
					<div class="col-lg-4 gap-5 px-5">
						<div class="category-item wow fadeInUp" data-wow-delay="0.1s">
							<div class="category-img py-4">
								<img src="img/category/<?= $v ?>.png" alt="<?= $v ?>">
							</div>
							<div class="category-text py-4">
								<h2 class="text-center"><?= $k ?></h2>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>