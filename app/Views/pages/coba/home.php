<?php use App\Laundry\Core\Message;

include __DIR__ . '/../../partials/header.php'; ?>
<?php Message::flash() ?>
<div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
	<h2>HELLO</h2>
	<a href="<?= BASEURL ?>/coba/logout">Logout</a>
</div>

<?php include __DIR__ . '/../../partials/footer.php'; ?>