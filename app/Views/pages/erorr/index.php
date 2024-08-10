<?php include __DIR__ . '/../../partials/header.php'; ?>
<div class=" bg-dark d-flex align-items-center" style="height: 100vh;">
	<div style="height:auto; min-height:100%; background: var(--dark1); ">
		<div style="text-align: center; width:800px; margin-left: -400px; position:absolute; top: 30%; left:50%;">
			<h1 class="teks-not-found">404</h1>
			<h2 style="margin-top:20px;font-size: 30px; color: var(--light1);">Not Found
			</h2>
			<p style="color: var(--light2);">The resource requested could not be found on this server!</p>
			<a href="<?= BASEURL ?>/" class="back-home">Back to Home</a>
		</div>
	</div>
</div>
<style>
	.teks-not-found {
		margin: 0;
		font-size: 150px;
		line-height: 150px;
		font-weight: bold;
		color: var(--dark);
		text-shadow: 0px 2px 5px var(--red), 0px -1px 2px var(--red);
		animation: not-found 1s alternate infinite;
	}

	@keyframes not-found {
		0% {
			text-shadow: 0px 2px 10px var(--red), 0px -1px 10px var(--primary);
		}

		50% {
			text-shadow: 0px 2px 10px var(--primary), 0px -1px 10px var(--red);
		}

		100% {
			text-shadow: 0px 2px 10px var(--red), 0px -1px 10px var(--primary);
		}
	}

	.back-home {
		display: inline-block;
		color: var(--light1);
		border-top: 2px solid var(--danger1);
		border-right: 2px solid var(--danger1);
		padding: 3px 10px;
		border-radius: 3px;
	}

	.back-home:hover {
		display: inline-block;
		color: var(--light2);
		border-bottom: 2px solid var(--danger1);
		border-left: 2px solid var(--danger1);
		transition: 0.3s;
		padding: 3px 10px;
		border-radius: 3px;
		box-shadow: 0px 0px 10px var(--danger1);
	}
</style>
<?php include __DIR__ . '/../../partials/footer.php'; ?>