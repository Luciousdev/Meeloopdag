{{-- NAV BAR --}}
<section class="navContainer">
    <header class="header" id="header">
        <nav class="navbar containerNormal">
            {{-- <img src="/images/logo.png" alt="" class="brand"> --}}
            <p class="brand">
                {{ $data->full_name }}
            </p>
            <div class="burger" id="burger">
                <span class="burger-line"></span>
                <span class="burger-line"></span>
                <span class="burger-line"></span>
            </div>
            <div class="menu" id="menu">
                <ul class="menu-inner">
                    <?php if( $data->type == "teacher") { ?>
                        <li class="menu-item"><a href="#" class="menu-link">Opdracht aanmaken</a></li>
                        <li class="menu-item"><a href="#" class="menu-link">Nakijken</a></li>
                        <li class="menu-item"><a href="#" class="menu-link">Docenten Dashboard</a></li>
                    <?php } ?>
                    <li class="menu-item"><a href="/logout" class="menu-link">Uitloggen</a></li>
                </ul>
            </div>
        </nav>
    </header>
</section>
