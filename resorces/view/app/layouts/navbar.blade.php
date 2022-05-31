<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" style="direction: rtl;">
    <div class="container">
        <a class="navbar-brand" href="index.html">Royal<span>estate</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> منو
      </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= HomeActive() ?>"><a href="<?= route('home.index') ?>" class="nav-link">خانه</a></li>
                <li class="nav-item <?= SlidAction(route('home.all.ads')) ?>"><a href="<?= route('home.all.ads') ?>" class="nav-link">آگهی ها</a></li>
                <li class="nav-item <?= SlidAction(route('home.about'))?>"><a href="<?= route('home.about') ?>" class="nav-link">درباره ما</a></li>
                <li class="nav-item <?= SlidAction(route('home.all.blog')) ?>"><a href="<?= route('home.all.blog') ?>" class="nav-link">بلاگ</a></li>
                <?php if(\System\Auth\Auth::checkLogin()){ ?>
                <li class="nav-item cta"><a href="" class="nav-link ml-lg-1 mr-lg-5 bg-success"><span class=" icon-user-md m-2"><?= \System\Auth\Auth::user()->first_name.' '.\System\Auth\Auth::user()->last_name ?></span></a></li>
                <li class="nav-item"><a href="<?= route('home.logout') ?>" class="nav-link ml-lg-1 bg-danger"><span class=" icon-exit_to_app">خروج</span></a></li>
                <?php }else { ?>
                <li class="nav-item cta"><a href="<?= route('auth.login') ?>" class="nav-link ml-lg-1 mr-lg-5"><span class="icon-user m-2"></span>ورود</a></li>
                <li class="nav-item cta cta-colored"><a href="<?= route('auth.register.view') ?>" class="nav-link"><span class="icon-pencil m-2"></span>ثبت نام</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->