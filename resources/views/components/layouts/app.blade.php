<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

{{-- @livewireScripts --}}

@include('components.layouts.head')
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @includeWhen(auth()->user()->isAdmin(), 'components.layouts.sidebar')
    @includeWhen(auth()->user()->isModerator(), 'components.layouts.mod-sidebar')
    @includeWhen(auth()->user()->isStudent(), 'components.layouts.stud-sidebar')
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->

    @include('components.layouts.header')
    <!-- [ Header ] end -->


    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title d-flex align-items-center">
                                <h2 class="mb-0">{{ $title }}</h2>
                                @yield('title-extra')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            {{ $slot }}
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm-6 my-1">
                    <p class="m-0">Made with &#9829;</p>
                </div>
            </div>
        </div>
    </footer>


    <!-- [Page Specific JS] start -->
    <script src="/assets/js/plugins/apexcharts.min.js"></script>
    <script src="/assets/js/plugins/jsvectormap.min.js"></script>
    <script src="/assets/js/plugins/world.js"></script>
    <script src="/assets/js/plugins/world-merc.js"></script>
    <script src="/assets/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="/assets/js/plugins/popper.min.js"></script>
    <script src="/assets/js/plugins/simplebar.min.js"></script>
    <script src="/assets/js/plugins/bootstrap.min.js"></script>
    <script src="/assets/js/fonts/custom-font.js"></script>
    <script src="/assets/js/pcoded.js"></script>
    <script src="/assets/js/plugins/feather.min.js"></script>

    @yield('extra-scripts')

    <script>
        layout_change('light');
    </script>

    <script>
        layout_sidebar_change('light');
    </script>

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_caption_change('true');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change('preset-1');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::flash />
</body>
<!-- [Body] end -->

</html>
