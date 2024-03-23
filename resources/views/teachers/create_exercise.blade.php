@php($pageTitle = 'Opdracht aanmaken')
<head>
    @include('../components/headtags')
    <link rel="stylesheet" href="css/simplemde.css">
    <link rel="stylesheet" href="css/createexercise.css">
</head>
<body>
    @include('../components/nav')
    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Opdracht aanmaken</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="post" action="/submitExercise">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titel" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Short description" required>
                    </div>
                    <div class="form-group">
                        <label for="points">Totaal aantal haalbare punten:</label>
                        <input type="number" class="form-control" id="points" name="points" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="inleverbaar" placeholder id="lang">
                            <option value="" disabled selected>Kies de inleverbaar status</option>
                            <option value="TRUE">Ja</option>
                            <option value="FALSE">Nee</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="instructions">Opdracht:</label>
                        <textarea id="instructions" name="description" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-prim">Opdracht aanmaken</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        let instructionsEditor = new SimpleMDE({
            element: document.getElementById("instructions")
        });

        let antwoordEditor = new SimpleMDE({
            element: document.getElementById("antwoord")
        });
    </script>
</body>
</html>
