<!DOCTYPE html>
<?php
    $pageTitle="Opdracht: ";
?>


<html lang="en">
<head>
    @include('../components.headtags')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    @include('../components.nav')

{{--    @if() --}}
{{--        --}}
{{--    @endif--}}
{{--    @php(dd($data['exercise']))--}}
    @foreach($assignment->submissions as $submission)
        @if($submission->grade)
            Feedback: {{ $submission->grade->feedback }}
        @endif
    @endforeach


    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">

            </div>
        </div>

        <div class="row">
            <div class="col">
{{--                <h1>Welkom <?php echo $data->full_name; ?></h1>--}}
{{--                <p>Je bent ingelogd als een "<?php echo $data->type; ?>"</p>--}}
            </div>
        </div>
    </div>

</body>
