@php($pageTitle = 'Profiel - ' . $data->full_name)
<html lang="nl">
<head>
    @include('components/headtags')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
//    dd($gradesByWeek);
    ?>

    @include('components/nav')
    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                <h1>Profiel</h1>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>Algemene gegevens</h2>
                <div class="row">
                    <div class="col">
                        <p>Naam:</p>
                        <p>E-mail:</p>
                    </div>
                    <div class="col">
                        <p>{{ $data->full_name }}</p>
                        <p>{{ $data->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid container-settings">
        <div class="row">
            <div class="col">
                <h2>Verloop van cijfers per week</h2>
                <div style="max-width: 700px; max-height: 480px;">
                    <canvas id="gradesChart" width="500" height="300"></canvas>
                </div>

            </div>
        </div>
    </div>
    @include('components/footer')
<script>
    var ctx = document.getElementById('gradesChart').getContext('2d');
    var gradesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_keys($gradesByWeek)); ?>,
            datasets: [
                {
                    label: 'Minimale Cijfer',
                    data: <?php echo json_encode(array_column($gradesByWeek, 'min')); ?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Maximale Cijfer',
                    data: <?php echo json_encode(array_column($gradesByWeek, 'max')); ?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Gemiddelde Cijfer',
                    data: <?php echo json_encode(array_column($gradesByWeek, 'avg')); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }
            ]
        },
        options: {
            scales: {
                x: {
                    reverse: true,
                    title: {
                        display: true,
                        text: 'Week'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cijfer'
                    }
                }
            }
        }
    });
</script>


</body>
</html>
