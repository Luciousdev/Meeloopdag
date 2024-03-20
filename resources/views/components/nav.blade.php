{{-- NAV BAR --}}
<head>
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<nav>
    <div class="navContainer">
        <div>
            <?php if($data->type == "teacher") { ?>
            <a href="#">Opdracht aanmaken</a>
            <a href="/grading">Nakijken</a>
            <a href="#">Docenten Dashboard</a>
            <?php } ?>
            <a href="/logout">Uitloggen</a>
        </div>
        <div>
            <a class="inner-nav-right" href="/profile">Profiel</a>
        </div>
    </div>
</nav>
{{-- END NAV BAR --}}
