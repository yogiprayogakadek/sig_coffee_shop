<div class="sticky" style="margin-bottom: -74px;">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar ps ps--active-y sidemenu-scroll">
        <div class="side-header"> <a class="header-brand1" href="{{route('main')}}"> <img
                    src="{{asset('assets/frontend/landing-page/img/denpasar.png')}}" class="header-brand-img desktop-logo"
                    alt="logo"> <img src="{{asset('assets/frontend/landing-page/img/denpasar.png')}}"
                    class="header-brand-img toggle-logo" alt="logo"> <img
                    src="{{asset('assets/frontend/landing-page/img/denpasar.png')}}" class="header-brand-img light-logo"
                    alt="logo"> <img src="{{asset('assets/frontend/landing-page/img/denpasar.png')}}"
                    class="header-brand-img light-logo1" style="width: 100px" alt="logo"> </a> <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                    </path>
                </svg></div>
            <ul class="side-menu" style="margin-right: 0px; margin-left: 0px;">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide"> 
                    <a class="side-menu__item has-link {{Request::is('dashboard') ? 'active' : (Request::is('/') ? 'active' : '') }}" data-bs-toggle="slide"
                        href="{{route('dashboard.index')}}"><i class="side-menu__icon fe fe-home"></i><span
                            class="side-menu__label">Dashboard</span>
                    </a>
                    @can('admin')
                    <a class="side-menu__item has-link {{Request::is('admin/owner') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('admin.owner.index')}}"><i class="side-menu__icon fe fe-users"></i><span
                            class="side-menu__label">Data Owner</span>
                    </a>
                    @endcan

                    <a class="side-menu__item has-link {{Request::is('owner/kedai') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('owner.kedai.index')}}"><i class="side-menu__icon fe fe-server"></i><span
                            class="side-menu__label">Data Kedai</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('owner/produk') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('owner.produk.index')}}"><i class="side-menu__icon fe fe-package"></i><span
                            class="side-menu__label">Data Produk</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('owner/promo') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('owner.promo.index')}}"><i class="side-menu__icon fe fe-globe"></i><span
                            class="side-menu__label">Data Promo</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('owner/ulasan') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('owner.ulasan.index')}}"><i class="side-menu__icon fe fe-message-circle"></i><span
                            class="side-menu__label">Data Ulasan</span>
                    </a>

                    {{--
                    <a class="side-menu__item has-link {{Request::is('barang') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('barang.index')}}"><i class="side-menu__icon fe fe-aperture"></i><span
                            class="side-menu__label">Data Barang</span>
                    </a>
                    <a class="side-menu__item has-link {{Request::is('pengadaan') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('pengadaan.index')}}"><i class="side-menu__icon fe fe-book"></i><span
                            class="side-menu__label">Pengadaan Barang</span>
                            @can('validator')
                            <span class="badge bg-pink side-badge">{{pengadaanNeedApproval()}}</span>
                            @endcan
                            @can('staff_administrasi')
                            <span class="badge bg-pink side-badge">{{pengadaanNeedApproval()}}</span>
                            @endcan
                            @can('bendahara')
                            <span class="badge bg-pink side-badge">{{pengadaanNeedApprovalBendahara()}}</span>
                            @endcan
                    </a>
                    <a class="side-menu__item has-link {{Request::is('perbaikan') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('perbaikan.index')}}"><i class="side-menu__icon fe fe-slack"></i><span
                            class="side-menu__label">Perbaikan Barang</span>
                            @can('validator')
                            <span class="badge bg-pink side-badge">{{maintenanceNeedApproval('Perbaikan')}}</span>
                            @endcan
                            @can('bendahara')
                            <span class="badge bg-pink side-badge">{{maintenaceNeedApproveBendahara('Perbaikan')}}</span>
                            @endcan
                    </a>
                    <a class="side-menu__item has-link {{Request::is('kerusakan') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('kerusakan.index')}}"><i class="side-menu__icon fe fe-settings"></i><span
                            class="side-menu__label">Kerusakan Barang</span>
                            @can('validator')
                            <span class="badge bg-pink side-badge">{{maintenanceNeedApproval('Kerusakan')}}</span>
                            @endcan
                            @can('bendahara')
                            <span class="badge bg-pink side-badge">{{maintenaceNeedApproveBendahara('Kerusakan')}}</span>
                            @endcan
                    </a>
                    <a class="side-menu__item has-link {{Request::is('perawatan') ? 'active' : '' }}" data-bs-toggle="slide"
                        href="{{route('perawatan.index')}}"><i class="side-menu__icon fe fe-settings"></i><span
                            class="side-menu__label">Perawatan Barang</span>
                            @can('validator')
                            <span class="badge bg-pink side-badge">{{maintenanceNeedApproval('Perawatan')}}</span>
                            @endcan
                            @can('bendahara')
                            <span class="badge bg-pink side-badge">{{maintenaceNeedApproveBendahara('Perawatan')}}</span>
                            @endcan
                    </a> --}}
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                    </path>
                </svg></div>
        </div>
        <div class="ps__rail-x" style="left: 0px; bottom: -558px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 558px; height: 969px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 314px; height: 544px;"></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>