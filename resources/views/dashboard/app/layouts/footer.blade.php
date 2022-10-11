<div class="footer-copyright-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="footer-copy-right">
                <p>
                    @lang('site.copy') {{ $settings['settings']->getTranslation('name',app()->getLocale(),false) }}
                </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public/dashboard/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{ asset('public/dashboard/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('public/dashboard/js/jquery-price-slider.js')}}"></script>
<script src="{{ asset('public/dashboard/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{ asset('public/dashboard/js/meanmenu/jquery.meanmenu.js')}}"></script>
<script src="{{ asset('public/dashboard/js/counterup/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('public/dashboard/js/counterup/waypoints.min.js')}}"></script>
<script src="{{ asset('public/dashboard/js/counterup/counterup-active.js')}}"></script>
<script src="{{ asset('public/dashboard/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{ asset('public/dashboard/js/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('public/dashboard/js/sparkline/sparkline-active.js')}}"></script>
<script src="{{ asset('public/dashboard/js/flot/jquery.flot.js')}}"></script>
<script src="{{ asset('public/dashboard/js/flot/jquery.flot.resize.js')}}"></script>
<script src="{{ asset('public/dashboard/js/flot/flot-active.js')}}"></script>
<script src="{{ asset('public/dashboard/js/knob/jquery.knob.js')}}"></script>
<script src="{{ asset('public/dashboard/js/knob/jquery.appear.js')}}"></script>
<script src="{{ asset('public/dashboard/js/knob/knob-active.js')}}"></script>
<script src="{{ asset('public/dashboard/js/plugins.js')}}"></script>
@stack('scripts')
<script src="{{ asset('public/dashboard/js/dialog/sweetalert2.min.js')}}"></script>
<script src="{{ asset('public/dashboard/js/dialog/dialog-active.js')}}"></script>
<script src="{{ asset('public/dashboard/js/main.js')}}?v=3"></script>

</body>

</html>
