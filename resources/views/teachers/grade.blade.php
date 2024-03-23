@inject('markdown', 'Illuminate\Mail\Markdown')
@php $pageTitle = $submission->assignment->title . " aan het nakijken van ". $submission->user->full_name;
$parsedown = new Parsedown();
@endphp
<html lang="nl">
<head>
    @include('components.headtags')
    <link rel="stylesheet" href="{{ asset('css/grading.css') }}">
</head>
<body>
@include('../components/nav')

    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                <h1>Inzending</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-9" style="border-right: 2px solid #fff;">
                <p>
                    @php
                        $parsedown = new Parsedown()
                    @endphp
                    <?= $parsedown->text($submission->text_submission); ?>
                </p>
            </div>
            <div class="col-3">
                <p style="margin-bottom:0;">Opdracht: {{ $submission->assignment->title }}</p>
                <p style="margin-bottom:0;">Gemaakt door: {{ $submission->user->full_name }}</p>
                <p>Status: {{ $submission->status }}</p>
            </div>
        </div>

        @if($submission->status == "submitted")
            <form action="/grade-submission" method="post" enctype="multipart/form-data" style="padding-top: 10vh; padding-bottom:2.5rem;">
                @csrf
                <div class="row">
                    <div class="col">
                        <textarea name="feedback" id="feedback" cols="30" rows="10" placeholder="Feedback"></textarea>
                        <input type="hidden" name="id" value={{ $submission->id }}>
                    </div>
                </div>
                <div class="row">
                    <div class="col"><br>
                        <button type="submit" class="btn btn-prim">Afronden</button>&nbsp;&nbsp;&nbsp;
                        <input type="number" name="score" id="score"><span><strong> / {{ $submission->assignment->points }}</strong></span>
                    </div>
                </div>
            </form>
        @else
            <div class="row" style="padding-top: 2.5rem;">
                <div class="col">
                    <h1>Deze opdracht is al nagekeken</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if($submission->grade->feedback != null)
                        <p>Cijfer: {{ $submission->grade->score }}/{{ $submission->assignment->points }}</p>
                        <p>Gegeven feedback: {{ $submission->grade->feedback }}</p>
                    @else
                        <p>Geen feedback gegeven</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
@include('../components.footer')
</body>
</html>
