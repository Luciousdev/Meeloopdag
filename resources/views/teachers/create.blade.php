@inject('markdown', 'Illuminate\Mail\Markdown')
@php $pageTitle = "Opdracht aanmaken" @endphp
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
            <h1>Opdracht aanmaken</h1>
        </div>
    </div>

    <form action="/create-assignment" method="post" enctype="multipart/form-data" style="padding-top: 10vh; padding-bottom:2.5rem;">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" name="title" id="title" placeholder="Titel">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Beschrijving"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="number" name="points" id="points" placeholder="Punten">
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="file" name="file" id="file">
            </div>
        </div>
        <div class="row">
            <div class="col"><br>
                <button type="submit" class="btn btn-prim">Aanmaken</button>
            </div>
        </div>
    </form>
</div>
@include('../components.footer')
</body>
</html>
