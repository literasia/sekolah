<!DOCTYPE html>
<html>
<head>
	<title>Kwitansi Pembayaran</title>
	{{-- Meta --}}
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff" />
	{{-- Google font--}}
	<link href="{{ asset('fonts.googleapis.com/css0f7c.css?family=Open+Sans:300,400,600,700,800') }}" rel="stylesheet">
	<link href="{{ asset('fonts.googleapis.com/css1180.css?family=Quicksand:500,700') }}" rel="stylesheet">
	{{-- Required Fremwork --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/bootstrap/css/bootstrap.min.css') }}">

</head>
<body class="bg-white">

	<div class="container p-5">
		<div class="row mb-4">
			<div class="col-md-12 text-center" style="border-bottom: 6px solid #e90096;">
				<h3 style="color: #e90096;">PT. LITERASIA EDUTEKNO DIGITAL</h3>
				<h6>Web Developer - App Developer - IT Solution</h6>
				<p>Jl. Karya Kasih Komp. Mitra Duta No. 8 Medan Johor, Sumatera Utara</p>
			</div>
		</div>

		<div class="container px-5">
			<div class="row mt-5">
				<div class="col-md-12 text-center p-4" style="border-bottom: 4px solid #000;">
					<h4 class="font-weight-bold" style="text-decoration: underline;">KWITANSI</h4>
				</div>
			</div>
		</div>
	</div>


{{-- Required Jquery --}}
<script type="text/javascript" src="{{ asset('bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>