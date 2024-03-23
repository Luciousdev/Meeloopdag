{{-- NAV BAR --}}
<head>
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head>
<nav>
    <div class="navContainer">
        <div>
            <a href="/dashboard">Dashboard</a>
            <?php if($data->type == "teacher") { ?>
            <a href="/create-exercise">Opdracht aanmaken</a>
            <a href="/grading">Nakijken</a>
            <?php } ?>
            <a href="/logout">Uitloggen</a>
        </div>
        <div>
            <a class="inner-nav-right" href="/profile">Profiel</a>
        </div>
    </div>
</nav>
{{-- END NAV BAR --}}
