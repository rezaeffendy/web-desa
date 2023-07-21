<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="javascript:void(0)" class="site_title">
                <img src="{{ url('login/images/Indramayu.png') }}" width="50">
                <span>
                    Desa Krimun
                </span>
            </a>
        </div>

        <div class="clearfix"></div>
        <div class="profile clearfix">
            {{-- <div class="profile_pic">
                <img src="{{ $user->gambar }}" alt="{{ $user->nama }}" class="img-circle profile_img">
            </div> --}}
            <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2>{{ Session::get('penduduk') ? $user->nama : $user->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                @if (Session::get('penduduk'))
                <ul class="nav side-menu">
                    <li class="">
                        <a href="{{ url('penduduk') }}">
                            <i class="fa fa-home"></i>Dashboard
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('penduduk/formulir') }}">
                            <i class="fa fa-envelope"></i>Pengisian Surat
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('penduduk/profil') }}">
                            <i class="fa fa-user"></i>Profil
                        </a>
                    </li>
                </ul>
                @else
                <ul class="nav side-menu">
                    <li class="">
                        <a href="{{ url('admin/dashboard') }}">
                            <i class="fa fa-home"></i>Dashboard
                        </a>
                    </li>

                    <li>
                        <a>
                            <i class="fa fa-envelope"></i> Surat Masuk
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li class="">
                                <a href="{{ url('admin/surat/skd') }}">
                                    SKD
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ url('admin/surat/sku') }}">
                                    SKU
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ url('admin/surat/sktm') }}">
                                    SKTM
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ url('admin/surat/skm') }}">
                                    SKM
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ url('admin/surat/sknn') }}">
                                    SKNN
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ url('admin/surat/lkp') }}">
                                    LKP
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="{{ url('admin/berita') }}">
                            <i class="fa fa-newspaper-o"></i>Berita
                        </a>
                    </li>

                    <li>
                        <a>
                            <i class="fa fa-group"></i> Kependudukan
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li class="">
                                <a href="{{ url('admin/penduduk/tetap') }}">
                                    Data Penduduk
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ url('admin/penduduk/baru') }}">
                                    Penduduk Baru
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="{{ url('admin/vaksin') }}">
                            <i class="fa fa-eyedropper"></i> Data Vaksin
                        </a>
                    </li>

                    <li class="">
                        <a href="{{ url('admin/akun') }}">
                            <i class="fa fa-user"></i>Akun
                        </a>
                    </li>
                </ul>
                @endif
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Logout" style="width: 100%"
                href="{{ Session::get('penduduk') ? url('penduduk/logout') : url('auth/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>
