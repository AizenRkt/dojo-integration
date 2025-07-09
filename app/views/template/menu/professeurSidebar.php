<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?= Flight::base() ?>/"><img style="width: 250px; height:auto" src="<?= Flight::base() ?>/public/assets/static/images/logo/logo.png" alt="logo" srcset=""></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu"> 
                <li class="sidebar-title">élève</li>
                <li class="sidebar-item">
                    <a href="<?= Flight::base() ?>/evolution" class='sidebar-link'>
                        <i class="bi bi-box-seam"></i>
                        <span>Suivi p&eacute;dagogique</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= Flight::base() ?>/presence" class='sidebar-link'>
                        <i class="bi bi-fingerprint"></i>
                        <span>Suivi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= Flight::base() ?>/presence_eleve" class='sidebar-link'>
                        <i class="bi bi-fingerprint"></i>
                        <span>présence</span>
                    </a>
                </li>
                <li class="sidebar-title">connexion</li>
                <li class="sidebar-item">
                    <a href="<?= Flight::base() ?>/logout" class='sidebar-link'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
