<?php if ($_SESSION['username'] != "" && $_SESSION['oturum'] == 'ok') { ?>
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="bekleyen-firmalar.php" class="sidebar-brand">
                <img src="../assets/images/impetus_logo.png" width="132" height="60" alt="LOGO">
            </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">ANASAYFA</li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Anasayfa</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Domain & Hizmetler</li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#domainler" role="button" aria-expanded="false"
                       aria-controls="domainler">
                        <i class="link-icon" data-feather="globe"></i>
                        <span class="link-title">Alan Adları</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="domainler">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="domain-listesi.php" class="nav-link">Alan Adı Listesi</a>
                            </li>
                            <li class="nav-item">
                                <a href="domain-ekle.php" class="nav-link">Alan Adı Ekle</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#vhizmetler" role="button" aria-expanded="false"
                       aria-controls="vhizmetler">
                        <i class="link-icon" data-feather="radio"></i>
                        <span class="link-title">İş Takibi</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="vhizmetler">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="v-hizmet-listesi.php" class="nav-link">İş Listesi</a>
                            </li>
                            <li class="nav-item">
                                <a href="v-hizmet-ekle.php" class="nav-link">İş Ekle</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a href="bugun-dusecek-domainler.php" class="nav-link">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">Bugün Düşecek Domainler</span>
                    </a>
                </li>


                <li class="nav-item nav-category">Genel</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#musteriler" role="button" aria-expanded="false"
                       aria-controls="musteriler">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">Müşteriler</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="musteriler">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="musteri-listesi.php" class="nav-link">Müşteri Listesi</a>
                            </li>
                            <li class="nav-item">
                                <a href="musteri-ekle.php" class="nav-link">Müşteri Ekle</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#hizmetler" role="button" aria-expanded="false"
                       aria-controls="hizmetler">
                        <i class="link-icon" data-feather="rss"></i>
                        <span class="link-title">Hizmetler</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="hizmetler">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="hizmet-listesi.php" class="nav-link">Hizmetler Listesi</a>
                            </li>
                            <li class="nav-item">
                                <a href="hizmet-ekle.php" class="nav-link">Hizmet Ekle</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ayarlar" role="button" aria-expanded="false"
                       aria-controls="ayarlar">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Ayarlar</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="ayarlar">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="sms-ayarlari.php" class="nav-link">SMS Ayarları</a>
                            </li>
                            <li class="nav-item">
                                <a href="mail-ayarlari.php" class="nav-link">Mail Ayarları</a>
                            </li>
                            <li class="nav-item">
                                <a href="x-gun-ayarlari.php" class="nav-link">X Gün Ayarları</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#sablonlar" role="button" aria-expanded="false"
                       aria-controls="sablonlar">
                        <i class="link-icon" data-feather="terminal"></i>
                        <span class="link-title">Şablonlar</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="sablonlar">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="sms-sablonu.php" class="nav-link">SMS Şablonu</a>
                            </li>
                            <li class="nav-item">
                                <a href="mail-sablonu.php" class="nav-link">Mail Şablonu</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item nav-category">Çıkış</li>

                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="link-icon" data-feather="log-out"></i>
                        <span class="link-title">Çıkış</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<?php } ?>