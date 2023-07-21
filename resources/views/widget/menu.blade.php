<div class="collapse navbar-collapse order-3" id="navbarCollapse">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle">Tentang Kami</a>
            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="{{ url('tentang/visi-misi') }}" class="dropdown-item">Visi Misi </a></li>
                <li><a href="{{ url('tentang/profil-wilayah') }}" class="dropdown-item">Profil Wilayah </a>
                </li>
                <li><a href="{{ url('tentang/map') }}" class="dropdown-item">Maps </a></li>

                <li class="dropdown-divider"></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                class="nav-link dropdown-toggle">Pengisian Surat</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="{{ url('formulir/skd') }}" class="dropdown-item">Surat Keterangan Domisili </a></li>

                <li class="dropdown-divider"></li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ url('berita') }}" class="nav-link">Berita</a>
        </li>
        <li class="nav-item">
            <a href="{{ url('vaksin') }}" class="nav-link">Data Vaksin</a>
        </li>
        <li class="nav-item">
            <a href="https://api.whatsapp.com/send?phone=6289660931433&text=Silahkan Isi Disini, jangan lupa sertakan nama Anda dan sertakan Foto KTP."
                class="nav-link">Hubungi Kami</a>
        </li>
    </ul>
</div>
