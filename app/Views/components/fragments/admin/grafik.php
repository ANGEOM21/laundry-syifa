<h3 style="font-weight: 400; margin-top: 30px">Grafik Pendapatan</h3>
<p>1 Minggu, 1 Bulan, 6 Bulan, 1 Tahun</p>
<div class="row justify-content-center align-items-center">
	<div class="col col-md-6">
		<canvas id="myChart" style="width:100%;max-width:500px"></canvas>
	</div>
	<div class="col col-md-4 border-left">
		<canvas id="doughnut" style="width:100%;max-width:500px"></canvas>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


<script>
	var xValues = ["1 Minggu", "1 Bulan", "6 Bulan", "1 Tahun"];
	var yValues = [<?= $data['1minggu'] ?>, <?= $data['1bulan'] ?>, <?= $data['6bulan'] ?>, <?= $data['1tahun'] ?>];
	var barColors = ["#03a7cd", "#63c856", "#febe8c","#e76161"];

	new Chart("myChart", {
		type: "bar",
		data: {
			labels: xValues,
			datasets: [{
				backgroundColor: barColors,
				data: yValues
			}]
		},
		options: {
			legend: {
				display: false
			},
			title: {
				display: true,
				text: "Persentase Pendapatan Bar Chart"
			}
		}
	});
</script>
<script>
	var xValues = [" 1 Minggu", " 1 Bulan", " 6 Bulan", " 1 Tahun"];
	var yValues = [<?= $data['1minggu'] ?>, <?= $data['1bulan'] ?>, <?= $data['6bulan'] ?>, <?= $data['1tahun'] ?>];
	var barColors = ["#03a7cd",  "#63c856", "#febe8c", "#e76161"];

	new Chart("doughnut", {
		type: "doughnut",
		data: {
			labels: xValues,
			datasets: [{
				backgroundColor: barColors,
				data: yValues
			}]
		},
		options: {
			legend: {
				display: false
			},
			title: {
				display: true,
				text: "Persentase Pendapatan Pie Chart"
			}
		}
	});
</script>