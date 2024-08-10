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
	<title>pdf customer belum bayar</title>
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
<h1 style="text-align: center; background-color: #f5f5f5; padding: 10px border-radius: 5px"> Data Customer Belum Bayar</h1>
<table class="table table-bordered table-striped ">
					<thead>
						<tr style="text-align: center;">
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">No. Hp</th>
							<th scope="col">Kategori</th>
							<th scope="col">Status Bayar</th>
						</tr>
					</thead>
					<tbody>';
$no = 1;
$total_bayar = 0;
foreach ($data['pesanan'] as $row) {
	if ($row['status_deleted_tmuld'] == 0) {
		if ($row['status_deactive_pld'] == 1) {
			if ($row['status_bayar_pld'] == 0) {
				$total_bayar += $row['bayar'];
				$html .= "
							<tr>
								<td style='text-align: center;'>" . $no++ . "</td>
								<td>" . $row['name'] . "</td>
								<td>" . $row['no_hp'] . "</td>
								<td>" . $row['name_kld'] . "</td>";
				if ($row['status_bayar_pld'] == 1) {
					$html .= "
								<td> Success </td>";
				} else {
					$html .= "
								<td>Rp " . number_format($row['bayar'], 0, ',', '.') . "</td> ";
				}
				$html .= "
							</tr>
							";
			}
		}
	}
}

$html .= "
			<tr>
				<td colspan='5' style='text-align: center; background-color: #4d4d4d; color: white; font-weight: bold'>Total Belum Bayar Rp " . number_format($total_bayar, 0, ',', '.') . "</td>
			</tr> 
				</tbody>
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
$mpdf->Output('customer-belum-bayar_'.$date.'.pdf', 'I');
