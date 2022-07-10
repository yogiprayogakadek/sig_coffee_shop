<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

@include('main.mainpage.templates.partials.head')

<body class="landing-page sidebar-collapse">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @include('main.mainpage.templates.partials.navbar')

    @include('main.mainpage.templates.partials.page-header')


    <div class="main main-raised mt-5">
        @yield('content')
    </div>

    {{-- content 2 --}}
    <div class="cd-section" id="contactus">
        <!--     *********    CONTACT US 1     *********      -->
        <div class="contactus-1 section-image"
            style="background-image: url('{{asset('assets/frontend/landing-page/img/examples/city-profile.jpg')}}')">
            <div class="container">
                @yield('content-2')
            </div>
        </div>
        <!--     *********    END CONTACT US 1      *********      -->
    </div>
    {{-- end content 2 --}}

    {{-- div end --}}
    </div>

    @include('main.mainpage.templates.partials.footer')
    @include('main.mainpage.templates.partials.script')

</body>


<!-- Mirrored from demos.creative-tim.com/material-kit-pro-bs4/examples/landing-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Nov 2021 14:24:37 GMT -->

</html>