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
                                    <a href="{{ url('/exercise/'.$assignment->id) }}" class="btn">Ga naar opdracht</a>
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
