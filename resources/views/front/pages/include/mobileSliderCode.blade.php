
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}" />

<style>
  .social-div .btn-monochrome {
    --btn-bg-color: #fff;
    --btn-border-color: #e8e1e0;
    --btn-text-color: #2d383f;
    --btn-hover-bg-color: #f7f5f5;
    --btn-hover-border-color: #e8e1e0;
    --btn-hover-text-color: #403b45;
  }

</style>
@endpush

@push('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $(".pro-slider").slick({
      dots: true,
      autoplay: false,
      autoplaySpeed: 2000,
      speed: 150,
    });
  });
</script>
@endpush
