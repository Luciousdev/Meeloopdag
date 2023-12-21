<!DOCTYPE html>
<?php
$pageTitle="Dashboard";


// DEBUG

// dd($data['submissions']);
// echo "<pre>";
// print_r($data['assignments']);
// echo "</pre>";

?>
<html lang="en">
<head>
    @include('../components.headtags')
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
                <?php foreach($data['assignments'] as $assignment) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $assignment['title']; ?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <a href="" class="btn btn-card">werwer</a>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Max punten: <?php echo $assignment['points']; ?></small>
                            <small class="text-muted"></small>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    @include('../components.footer')
</body>
</html>
