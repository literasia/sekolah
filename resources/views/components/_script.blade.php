{{-- Required Jquery --}}
<script type="text/javascript" src="{{ asset('bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
{{-- waves js --}}
<script src="{{ asset('assets/pages/waves/js/waves.min.js') }}"></script>
{{-- jquery slimscroll js --}}
<script type="text/javascript" src="{{ asset('bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
{{-- Float Chart js --}}
<script src="{{ asset('assets/pages/chart/float/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/pages/chart/float/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('assets/pages/chart/float/curvedLines.js') }}"></script>
<script src="{{ asset('assets/pages/chart/float/jquery.flot.tooltip.min.js') }}"></script>
{{-- Chartlist charts --}}
<script src="{{ asset('bower_components/chartist/js/chartist.js') }}"></script>
{{-- amchart js --}}
<script src="{{ asset('assets/pages/widget/amchart/amcharts.js') }}"></script>
<script src="{{ asset('assets/pages/widget/amchart/serial.js') }}"></script>
<script src="{{ asset('assets/pages/widget/amchart/light.js') }}"></script>
{{-- Custom js --}}
<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('assets/js/vertical/vertical-layout.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/script.min.js') }}"></script>
<script type="text/javascript">
        $(document).on('click', '.profile', function () {
            $('.modal-title').html('Edit Profil');
            $('#btn')
                .removeClass('btn-info')
                .addClass('btn-success')
                .val('Simpan');
            $('#btn-cancel')
                .removeClass('btn-outline-info')
                .addClass('btn-outline-success')
                .val('Batal');
            $('#profile').modal('show');
        });
</script>
<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/608138f662662a09efc0feb5/1f3scd0so';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
	})();
</script>
{{-- add ons JS --}}
@stack('js')