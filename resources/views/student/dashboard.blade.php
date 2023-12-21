<!DOCTYPE html>
<?php
$pageTitle="Dashboard";


?>
<html lang="en">
<head>
    @include('../components.headtags')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    @include('../components.nav')
    {{-- <a href="logout">logout</a>
    <p>Full name</p>
    <p>{{$data->full_name}}</p> --}}
    {{-- create an simple card with bootstrap --}}

    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                <h1>Welkom <?php echo $data->full_name; ?></h1>
                <p>Je bent ingelogd als een "<?php echo $data->type; ?>"</p>
            </div>
        </div>
    </div>
    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                <div class="card-grid">
                    @foreach ($data['assignments'] as $assignment)
                        <div class="card">
                            <div class="card-header">@php echo $data->full_name; @endphp</div>
                            <div class="card-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium soluta libero reprehenderit porro voluptate esse quidem alias quasi, facilis culpa cum voluptatum! Quibusdam impedit porro deleniti cupiditate nemo sint dolores.
                            </div>
                            <div class="card-footer">
                                <a href="" class="btn">Ga naar opdracht</a>
                                <small class="text-muted">Max punten: @php echo $assignment['points']; @endphp</small>
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
