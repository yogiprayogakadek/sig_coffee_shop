<!--   Core JS Files   -->
<script src="{{asset('assets/frontend/landing-page/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/landing-page/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/frontend/landing-page/js/core/bootstrap-material-design.min.js')}}"
    type="text/javascript"></script>
<script src="{{asset('assets/frontend/landing-page/js/plugins/moment.min.js')}}"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="{{asset('assets/frontend/landing-page/js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript">
</script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('assets/frontend/landing-page/js/plugins/nouislider.min.js')}}" type="text/javascript">
</script>
<!--  Google Maps Plugin    -->
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script> --}}
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi4v5LQyLVl2YUfm3Xn3Kb746RO3L8BjA&callback=initMap&libraries=&v=weekly"
    async></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="{{asset('assets/frontend/landing-page/buttons.github.io/buttons.js')}}"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('assets/frontend/landing-page/js/plugins/bootstrap-tagsinput.js')}}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<!--	Plugin for Small Gallery in Product Page -->
<script src="{{asset('assets/frontend/landing-page/js/plugins/jquery.flexisel.js')}}" type="text/javascript">
</script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="{{asset('assets/frontend/landing-page/buttons.github.io/buttons.js')}}"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/frontend/landing-page/js/material-kit.mind1f1.js?v=2.2.0')}}" type="text/javascript">
</script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {

    });
</script>

@yield('script')