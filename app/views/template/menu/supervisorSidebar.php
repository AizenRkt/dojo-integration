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
                <li class="sidebar-title">suivi</li> 
                <li class="sidebar-item  has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-box-seam"></i>
                        <span>matériel et salle</span>                    
                    </a>
                    <ul class="submenu submenu-closed" style="--submenu-height: 86px;">
                        <li class="submenu-item  ">
                            <a href="<?= Flight::base() ?>/dashboard" class="submenu-link">dashboard</a>
                        </li>
                        <li class="submenu-item  ">
                            <a href="<?= Flight::base() ?>/materiel" class="submenu-link">matériel</a>
                        </li>
                        <li class="submenu-item  ">
                            <a href="<?= Flight::base() ?>/stock" class="submenu-link">stock matériel</a>
                        </li>
                        <li class="submenu-item  ">
                            <a href="<?= Flight::base() ?>/suivi-salle" class="submenu-link">suivi salle</a>
                        </li>
                        <li class="submenu-item  ">
                            <a href="<?= Flight::base() ?>/facturation/liste" class="submenu-link">facturation</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="<?= Flight::base() ?>/pointage-professeur" class='sidebar-link'>
                        <i class="bi bi-fingerprint"></i>
                        <span>pointage professeur</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-person"></i>
                        <span>élève</span>
                    </a>
                
                    <ul class="submenu submenu-closed" style="--submenu-height: 86px;">
                        <li class="submenu-item  ">
                            <a href="<?= Flight::base() ?>/eleves" class="submenu-link">liste</a>
                        </li>
                        <li class="submenu-item  ">
                            <a href="<?= Flight::base() ?>/eleves/create" class="submenu-link">inscription</a>
                        </li>

                    </ul>
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
