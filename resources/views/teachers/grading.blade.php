@php $pageTitle = 'Grading' @endphp
<html lang="nl">
<head>
    @include('components.headtags')
    <link rel="stylesheet" href="{{ asset('css/grading.css') }}">
</head>
    <body>
        @include('../components/nav')
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="tablePositioning">
                        <table class="tableStyles">
                            <thead>
                            <tr>
                                <th>Status</th>
                                <th>Opdracht</th>
                                <th>Gemaakt door</th>
                                <th>Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($submissions as $submission)
                                <tr>
                                    <td>{{ $submission->status }}</td>
                                    <td>{{ $submission->assignment->title }}</td>
                                    <td>{{ $submission->user->full_name }}</td>
                                    <td>
                                        <a href="/grade/{{ $submission->id }}" class="btn btn-prim">Nakijken</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @include('../components.footer')
    </body>
</html>
