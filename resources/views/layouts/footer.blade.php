  <!-- Required js  -->
<script src="{{ asset('brand_user/assets/vendors/jquery/jquery-3.6.4.min.js') }}"></script>
<script src="{{asset('brand_user/assets/js/custom/bootstrap.min.js')}}" ></script>
<script src="{{ asset('assets_old_dkp/js/sweetalert2.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/custom/common.js') }}"></script> --}}
<script src="{{ asset('assets_old_dkp/js/custom.js') }}"></script>
<script src="{{ asset('brand_user/assets/js/script.js') }}"></script>

{{-- Brand Campaign JS --}}
{{-- <script src="{{ asset('brand_campaign/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="{{ asset('brand_campaign/vendors/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('brand_campaign/js/script.js') }}"></script>
@yield('script')
