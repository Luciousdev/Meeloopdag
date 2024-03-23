<?php
    $pageTitle="Dashboard";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('../components.headtags')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    @include('../components.nav')
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                <h1>Welkom <?php echo $data->full_name; ?></h1>
                <p style="max-width: 60vw;">Je bent ingelogd als een "<?php echo $data->type; ?>". Begin met het maken van een opdracht door een opdracht te kiezen hieronder. De docenten doen hun best om het zo snel mogelijk voor je na te kijken! Voor vragen kan je altijd terecht bij een docent.</p>
            </div>
        </div>
    </div>
    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                <div class="card-grid">
                    @foreach ($data['assignments'] as $assignment)
                        <div class="card">
                            <div class="card-header">@php echo $assignment->title; @endphp</div>
                            <div class="card-body">
                                <p class="card-text" style="color:#000;">@php
                                    if(!empty($assignment->short_description)){
                                        echo $assignment->short_description;
                                    } else {
                                        echo "Bij deze opdracht is geen beschrijving";
                                    }
                                @endphp</p>
                            </div>
                            <div class="card-footer">
                                <div class="card-footer-content">
                                    <a href="{{ url('/exercise/'.$assignment->id) }}" class="btn btn-prim">Ga naar opdracht</a>
                                    <small class="text-muted">Max punten: @php echo $assignment['points']; @endphp</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('../components.footer')
</body>
</html>
