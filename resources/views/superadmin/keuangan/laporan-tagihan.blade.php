<!DOCTYPE html>
<html>
<head>
	<title>Kwitansi Pembayaran</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<style type="text/css" media="screen">
		*,
		*::before,
		*::after {
		  box-sizing: border-box;
		}

		html {
		  font-family: sans-serif;
		  line-height: 1.15;
		  -webkit-text-size-adjust: 100%;
		  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
		}

		body {
		  margin: 0;
		  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
		  font-size: 1rem;
		  font-weight: 400;
		  line-height: 1.5;
		  color: #212529;
		  text-align: left;
		  background-color: #fff;
		}

		h1, h2, h3, h4, h5, h6 {
		  margin-top: 0;
		  margin-bottom: 0.5rem;
		}

		p {
		  margin-top: 0;
		  margin-bottom: 1rem;
		}

		table {
		  border-collapse: collapse;
		}

		th {
		  text-align: inherit;
		}

		h1, h2, h3, h4, h5, h6,
		.h1, .h2, .h3, .h4, .h5, .h6 {
		  margin-bottom: 0.5rem;
		  font-weight: 500;
		  line-height: 1.2;
		}

		h1, .h1 {
		  font-size: 2.5rem;
		}

		h2, .h2 {
		  font-size: 2rem;
		}

		h3, .h3 {
		  font-size: 1.75rem;
		}

		h4, .h4 {
		  font-size: 1.5rem;
		}

		h5, .h5 {
		  font-size: 1.25rem;
		}

		h6, .h6 {
		  font-size: 1rem;
		}

		p, td, th {
			font-size: .9rem;
		}

		.container {
		  width: 100%;
		  padding-right: 15px;
		  padding-left: 15px;
		  margin-right: auto;
		  margin-left: auto;
		}

		

		.row {
		  display: -ms-flexbox;
		  display: block;
		  -ms-flex-wrap: wrap;
		  flex-wrap: wrap;
		  margin-right: -15px;
		  margin-left: -15px;
		}

		.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
		.col-auto{
		  position: relative;
		  width: 100%;
		  padding-right: 15px;
		  padding-left: 15px;
		}

		.col-1 {
		  -ms-flex: 0 0 8.333333%;
		  flex: 0 0 8.333333%;
		  max-width: 8.333333%;
		}

		.col-2 {
		  -ms-flex: 0 0 16.666667%;
		  flex: 0 0 16.666667%;
		  max-width: 16.666667%;
		}

		.col-3 {
		  -ms-flex: 0 0 25%;
		  flex: 0 0 25%;
		  max-width: 25%;
		}

		.col-4 {
		  -ms-flex: 0 0 33.333333%;
		  flex: 0 0 33.333333%;
		  max-width: 33.333333%;
		}

		.col-5 {
		  -ms-flex: 0 0 41.666667%;
		  flex: 0 0 41.666667%;
		  max-width: 41.666667%;
		}

		.col-6 {
		  -ms-flex: 0 0 50%;
		  flex: 0 0 50%;
		  max-width: 50%;
		}

		.col-7 {
		  -ms-flex: 0 0 58.333333%;
		  flex: 0 0 58.333333%;
		  max-width: 58.333333%;
		}

		.col-8 {
		  -ms-flex: 0 0 66.666667%;
		  flex: 0 0 66.666667%;
		  max-width: 66.666667%;
		}

		.col-9 {
		  -ms-flex: 0 0 75%;
		  flex: 0 0 75%;
		  max-width: 75%;
		}

		.col-10 {
		  -ms-flex: 0 0 83.333333%;
		  flex: 0 0 83.333333%;
		  max-width: 83.333333%;
		}

		.col-11 {
		  -ms-flex: 0 0 91.666667%;
		  flex: 0 0 91.666667%;
		  max-width: 91.666667%;
		}

		.col-12 {
		  -ms-flex: 0 0 100%;
		  flex: 0 0 100%;
		  max-width: 100%;
		}

		.table {
		  width: 100%;
		}

		.table th,
		.table td {
		  padding: 0.75rem;
		  vertical-align: top;
		}

		.table thead th {
		  vertical-align: bottom;
		}

		.bg-white {
		  background-color: #fff !important;
		}

		.mt-0,
		.my-0 {
		  margin-top: 0 !important;
		}

		.mr-0,
		.mx-0 {
		  margin-right: 0 !important;
		}

		.mb-0,
		.my-0 {
		  margin-bottom: 0 !important;
		}

		.ml-0,
		.mx-0 {
		  margin-left: 0 !important;
		}

		.m-1 {
		  margin: 0.25rem !important;
		}

		.mt-1,
		.my-1 {
		  margin-top: 0.25rem !important;
		}

		.mr-1,
		.mx-1 {
		  margin-right: 0.25rem !important;
		}

		.mb-1,
		.my-1 {
		  margin-bottom: 0.25rem !important;
		}

		.ml-1,
		.mx-1 {
		  margin-left: 0.25rem !important;
		}

		.m-2 {
		  margin: 0.5rem !important;
		}

		.mt-2,
		.my-2 {
		  margin-top: 0.5rem !important;
		}

		.mr-2,
		.mx-2 {
		  margin-right: 0.5rem !important;
		}

		.mb-2,
		.my-2 {
		  margin-bottom: 0.5rem !important;
		}

		.ml-2,
		.mx-2 {
		  margin-left: 0.5rem !important;
		}

		.m-3 {
		  margin: 1rem !important;
		}

		.mt-3,
		.my-3 {
		  margin-top: 1rem !important;
		}

		.mr-3,
		.mx-3 {
		  margin-right: 1rem !important;
		}

		.mb-3,
		.my-3 {
		  margin-bottom: 1rem !important;
		}

		.ml-3,
		.mx-3 {
		  margin-left: 1rem !important;
		}

		.m-4 {
		  margin: 1.5rem !important;
		}

		.mt-4,
		.my-4 {
		  margin-top: 1.5rem !important;
		}

		.mr-4,
		.mx-4 {
		  margin-right: 1.5rem !important;
		}

		.mb-4,
		.my-4 {
		  margin-bottom: 1.5rem !important;
		}

		.ml-4,
		.mx-4 {
		  margin-left: 1.5rem !important;
		}

		.m-5 {
		  margin: 3rem !important;
		}

		.mt-5,
		.my-5 {
		  margin-top: 3rem !important;
		}

		.mr-5,
		.mx-5 {
		  margin-right: 3rem !important;
		}

		.mb-5,
		.my-5 {
		  margin-bottom: 3rem !important;
		}

		.ml-5,
		.mx-5 {
		  margin-left: 3rem !important;
		}

		.p-0 {
		  padding: 0 !important;
		}

		.pt-0,
		.py-0 {
		  padding-top: 0 !important;
		}

		.pr-0,
		.px-0 {
		  padding-right: 0 !important;
		}

		.pb-0,
		.py-0 {
		  padding-bottom: 0 !important;
		}

		.pl-0,
		.px-0 {
		  padding-left: 0 !important;
		}

		.p-1 {
		  padding: 0.25rem !important;
		}

		.pt-1,
		.py-1 {
		  padding-top: 0.25rem !important;
		}

		.pr-1,
		.px-1 {
		  padding-right: 0.25rem !important;
		}

		.pb-1,
		.py-1 {
		  padding-bottom: 0.25rem !important;
		}

		.pl-1,
		.px-1 {
		  padding-left: 0.25rem !important;
		}

		.p-2 {
		  padding: 0.5rem !important;
		}

		.pt-2,
		.py-2 {
		  padding-top: 0.5rem !important;
		}

		.pr-2,
		.px-2 {
		  padding-right: 0.5rem !important;
		}

		.pb-2,
		.py-2 {
		  padding-bottom: 0.5rem !important;
		}

		.pl-2,
		.px-2 {
		  padding-left: 0.5rem !important;
		}

		.p-3 {
		  padding: 1rem !important;
		}

		.pt-3,
		.py-3 {
		  padding-top: 1rem !important;
		}

		.pr-3,
		.px-3 {
		  padding-right: 1rem !important;
		}

		.pb-3,
		.py-3 {
		  padding-bottom: 1rem !important;
		}

		.pl-3,
		.px-3 {
		  padding-left: 1rem !important;
		}

		.p-4 {
		  padding: 1.5rem !important;
		}

		.pt-4,
		.py-4 {
		  padding-top: 1.5rem !important;
		}

		.pr-4,
		.px-4 {
		  padding-right: 1.5rem !important;
		}

		.pb-4,
		.py-4 {
		  padding-bottom: 1.5rem !important;
		}

		.pl-4,
		.px-4 {
		  padding-left: 1.5rem !important;
		}

		.p-5 {
		  padding: 3rem !important;
		}

		.pt-5,
		.py-5 {
		  padding-top: 3rem !important;
		}

		.pr-5,
		.px-5 {
		  padding-right: 3rem !important;
		}

		.pb-5,
		.py-5 {
		  padding-bottom: 3rem !important;
		}

		.pl-5,
		.px-5 {
		  padding-left: 3rem !important;
		}

		.text-center {
		  text-align: center !important;
		}

		.font-weight-bold {
		  font-weight: 700 !important;
		}

		.justify-content-between {
		  -ms-flex-pack: justify !important;
		  justify-content: space-between !important;
		}

		.align-items-center {
		  -ms-flex-align: center !important;
		  align-items: center !important;
		}

		.d-flex {
		  display: -ms-flexbox !important;
		  display: flex !important;
		}
	</style>
</head>
<body class="bg-white">
	<div class="container">
		<div class="row mb-2">
			<div class="col-12 text-center" style="border-bottom: 6px solid #d40089;">
				<h3 class="font-weight-bold" style="color: #d40089;">PT. LITERASIA EDUTEKNO DIGITAL</h3>
				<h6 class="font-weight-bold">Web Developer - App Developer - IT Solution</h6>
				<p>Jl. Karya Kasih Komp. Mitra Duta No. 8 Medan Johor, Sumatera Utara</p>
			</div>
		</div>

		<div class="container">
			<div class="row mt-1">
				<div class="col-12 text-center p-4" style="border-bottom: 3px solid #000;">
					<h4 class="font-weight-bold" style="text-decoration: underline;">KWITANSI</h4>
				</div>
			</div>

			<div class="row mt-3">
				<div class="col-12" style="border-bottom: 3px solid #000;">
					<table>
						<tr>
							<td class="col-4 font-weight-bold pb-5 px-0">No</td>
							<td class="col-1 pb-5 px-0 font-weight-bold">:</td>
							<td class="col-7 pb-5 px-0 font-weight-bold"></td>
						</tr>
						<tr>
							<td class="col-4 font-weight-bold pb-5 px-0">Sudah Terima Dari</td>
							<td class="col-1 pb-5 px-0 font-weight-bold">:</td>
							<td class="col-7 pb-5 px-0"></td>
						</tr>
						<tr>
							<td class="col-4 font-weight-bold pb-5 px-0">Uang Sejumlah</td>
							<td class="col-1 pb-5 px-0 font-weight-bold">:</td>
							<td class="col-7 pb-5 px-0"></td>
						</tr>
						<tr>
							<td class="col-4 font-weight-bold pb-5 px-0">Untuk Pembayaran</td>
							<td class="col-1 pb-5 px-0 font-weight-bold">:</td>
							<td class="col-7 pb-5 px-0"></td>
						</tr>
						<tr>
							<td class="col-4 font-weight-bold pb-5 px-0">Jumlah Rp</td>
							<td class="col-1 pb-5 px-0 font-weight-bold">:</td>
							<td class="col-7 pb-5 px-0"></td>
						</tr>
					</table>
				</div>
			</div>

			<div class="row mt-3">
				<div class="col-12">
					<p><!-- tempat -->, <span><!-- tanggal --> </span><span><!-- bulan --> </span>2021</p>
				</div>
			</div>

			<div class="row">
				<table class="table">
					<tr>
						<td class="col-4">Setuju Dibayar</td>
						<td class="col-4"> </td>
						<td class="col-4 text-center">Hormat kami,</td>
					</tr>
				</table>
			</div>

			<div class="row mt-3">
				<table class="table">
					<tr>
						<td class="col-4">Kepala Sekolah</td>
						<td class="col-4">Bendahara</td>
						<td class="col-4 text-center">PT. Literasia EduTekno Digital</td>
					</tr>
					<tr>
						<td class="col-4"><div class="pr-1" style=" margin-top: 3rem; border-bottom: 3px solid #000;"></div></td>
						<td class="col-4"><div style=" margin-top: 3rem; border-bottom: 3px solid #000;"></div></td>
						<td class="col-4"><div class="pl-1" style=" margin-top: 3rem; border-bottom: 3px solid #000;"></div></td>
					</tr>
				</table>
			</div>
			
			<div class="row mt-4">
				<table class="table">
					<tr>
						<td class="col-4">NIP</td>
						<td class="col-4">NIP</td>
						<td class="col-4 text-center">Direktur Utama</td>
					</tr>
				</table>
			</div>

			<div class="row" style="margin-top: 60px; border-top: 6px solid #d40089;">
				<table class="table">
					<tr>
						<td class="col-4 text-center font-weight-bold">info@literasia.co.id</td>
						<td class="col-4 text-center font-weight-bold">+62 813 7038 6448</td>
						<td class="col-4 text-center font-weight-bold">www.literasia.co.id</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>