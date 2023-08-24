    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <link rel="preload" as="script" href="{{ asset('scripts/platform.client.min.js') }}?v={{ config('app.website_version')}}">
    <script type="text/javascript" src="{{ asset('scripts/platform.client.min.js') }}?v={{ config('app.website_version')}}" data-cookieconsent="ignore"></script>


    <link rel="icon" href="{{ asset('images/logo/favicon-3224021.svg')}}">

    <title>{{ config('app.name') }}</title>

    @include('front.includes.metadata')

    <script type="text/javascript">
        var WebPlatform = window.WebPlatform || {};
        WebPlatform.serviceApiDomain = "{{ config('app.url')}}";
        WebPlatform.hash = "3cmL6GHK5/KxuB3YdjDrsEhF1UDmD/MXGKr+ol/jHarukWHzx/5sE/vCaSw+5TfPT8E8nselXRHSuIXr5SQLQxBqVV30PYN2jnmCrmJ5vFPhIcp7Ugz/qqP28Zw43/ZCXq+BIgWY19fEgcE9JFbmM+iiTP8g4F6EfN0Xdl2/gF6yyvAr/FWFRY7N64DUe8zFYGK5i7Xm4Xd1OHXepL2GHJsh0i9CvGRoEf9jlbnYghpmKpp1vaiffDnBttue/eCPa7uME3BcWQIEz1ZVFZSxLcSUJx4xQ/5WCo9i/16YXG8=";
        WebPlatform.cookiesDisclaimer = ''.trim();
        WebPlatform.cookiesInfoBtn = "".trim();
        WebPlatform.cookiesInfoBtnLink = "".trim();
        WebPlatform.cookiesAcceptBtnText = "".trim() || 'OK';
        WebPlatform.ipCountryCode = "EC";

        WebPlatform.dateFormat = 'mm/dd/yy';
        if (!WebPlatform.onReady) {
          WebPlatform.documentReadyRequests = [];
          WebPlatform.onReady = function (request) {
            if (WebPlatform.documentReadyRequests === null)
              request();
            else
              WebPlatform.documentReadyRequests.push(request);
          };
        }

        if (!WebPlatform.merge) {
          WebPlatform.merge = function (target, source) {
            for (var key in source)
              if ((typeof target[key] === "undefined") || target[key] === '')
                target[key] = source[key];
            return target;
          };
        }
      </script>
    <!-- STYLESHEETS -->
    <link rel="preload stylesheet" href="{{ asset('styles/preloader.css') }}?v={{ config('app.website_version')}}" type="text/css" media="all">
    <link rel="preload stylesheet" href="{{ asset('styles/platform.client.min.css') }}?v={{ config('app.website_version')}}" type="text/css" media="all">
    <link rel="preload stylesheet" href="{{ asset('styles/trunk.min.css') }}?v={{ config('app.website_version')}}" type="text/css" media="all">
    <link rel="preload stylesheet" as="style" href="{{ asset('styles/trunk-1024.min.css') }}?v={{ config('app.website_version')}}" type="text/css">
    <link rel="preload stylesheet" as="style" href="{{ asset('styles/trunk-768.min.css') }}?v={{ config('app.website_version')}}" type="text/css">
    <link rel="preload stylesheet" as="style" href="{{ asset('styles/trunk-480.min.css') }}?v={{ config('app.website_version')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('styles/global.css')}}?v={{ config('app.website_version')}}">
    <link rel="stylesheet" href="{{ asset('styles/home.css')}}?v={{ config('app.website_version')}}">
    @include('front.includes.fonts')
    
    
<!-- Meta Pixel Code -->
{{-- <script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '228985376561007');
fbq('track', 'PageView');
</script> --}}
      
    <!-- Facebook Pixel Code -->
    {{-- <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '1024585225579109');
      fbq('track', 'PageView');
    </script> --}}
    <!-- End Facebook Pixel Code -->