<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
        &nbsp; <?= $firstName ?>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-<?= $dropdownColor ?>"
         aria-labelledby="navbarDropdownMenuLink-4">
        <a class="dropdown-item waves-effect waves-light" href="<?= base_url('/auth/change_password') ?>"><i
                    class="fa fa-lock fa-fw"></i>&nbsp;Trocar senha</a>
        <a class="dropdown-item waves-effect waves-light" href="<?= base_url('/auth/logout') ?>"><i
                    class="fa fa-sign-out fa-fw"></i>&nbsp;Sair</a>
    </div>
</li>