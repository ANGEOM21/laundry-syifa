<?php

use Mpdf\Mpdf;

$mpdf = new mPDF();


// $header = include __DIR__ . "/../../../partials/header.php";
// $html = $header;
$html .= '
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" type="image/x-icon" href="' . BASEURL . '/img/icon/favicon.ico">
	<title>pdf customer</title>
	<style>
	.container {
		width: 100%;
		padding-right: 15px;
		padding-left: 15px;
		margin-right: auto;
		font-family: Arial;
	}
	.table {
		font-family: times-new-roman;
		font-size: 14px;
		width: 100%;
	}
	th, td {
		padding: 15px;
		text-align: left;
	}

	tr:nth-child(even) {background-color: #f2f2f2;}
	th {
		background-color: #03a7cd;
		color: white;
	}

	.footer {
		position: fixed;
		left: 0;
		bottom: 0;
		width: 100%;
		font-size: 14px;
		background-color: #f5f5f5;
		padding: 10px;
	}
	
	</style>
</head>
<body>
<div class="container">
<h1 style="text-align: center; background-color: #f5f5f5; padding: 10px border-radius: 5px"> Data Semua Customer</h1>
<table class="table table-bordered table-striped ">
					<thead>
						<tr style="text-align: center;">
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">No. Hp</th>
							<th scope="col">Email</th>
						</tr>
					</thead>
					<tbody>';
$no = 1;
foreach ($data['customer'] as $row) {
	if ($row['status_deleted_tmuld'] == 0) {
		if ($row['id_tmru_ld'] == 2) {
			$html .= "
							<tr>
								<td style='text-align: center;'>" . $no++ . "</td>
								<td>" . $row['name'] . "</td>
								<td>" . $row['no_hp'] . "</td>";
			if ($row['email'] == '') {
				$html .= "
								<td> - </td>";
			} else {
				$html .= "
								<td>" . $row['email'] . "</td> ";
			}
			$html .= "
							</tr>";
		}
	}
}
$html .= "</tbody>
				</table>
				</div>
				<footer class='footer'>
					<p style='text-align: center; margin-bottom: 5px'>Copyright &copy; Syifa Laundry</p>
				</footer>
				</body>
</html>";

// $footer = include __DIR__ . "/../../../partials/footer.php";
// $html .= $footer;
$date = date('d-m-Y');
$mpdf->WriteHTML($html);
$mpdf->Output('data-cutomer_'.$date.'.pdf', 'I');
