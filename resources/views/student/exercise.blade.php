<!DOCTYPE html>
@inject('markdown', 'Illuminate\Mail\Markdown')
<?php
    $pageTitle="Opdracht: " . $assignment->title;
    $parsedown = new Parsedown();
?>
<html lang="en">
<head>
    @include('../components.headtags')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/exercise.css') }}">
</head>
<body>
    @include('../components.nav')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error')}}
        </div>
    @endif
    @if($assignment->submissions != null)
        @foreach($assignment->submissions as $submission)
            @if($submission->grade)
                <div class="container-fluid container-settings feedback-container">
                    <div class="row">
                        <div class="col-11">
                            <h1 style="color:#ffffff;">Feedback</h1>
                        </div>
                        <div class="col-1">
                            <p style="color:#ffffff;">{{ $submission->grade->score }}/{{ $assignment->points }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p style="color:#fff;">{{ $submission->grade->feedback }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3"><p style="color:#fff;">Nagekeken door: {{ $grader->full_name }}</p></div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif


    <div class="container-fluid container-settings feedback-container">
        <div class="row">
            <div class="col">
                {!! $markdown->parse($assignment->description) !!}
            </div>
        </div>
    </div>


    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                @if($assignment->inleverbaar == "TRUE")
                    <h1>Opdracht inleveren</h1>
                    <form action="{{ route('submit-assignment', ['id' => $assignment->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <textarea class="form-control" name="submission_user" id="description" rows="15" placeholder="Lever hier je opdracht in" style="background-color:#121212; border-radius: 25px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-prim" style="">Upload</button>
                    </form>
                @else
                    <h1>Bij deze opdracht hoef je niks in te leveren</h1>
                @endif
            </div>
        </div>
    </div>


</body>
