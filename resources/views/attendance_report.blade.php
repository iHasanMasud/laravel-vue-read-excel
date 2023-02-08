<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js">
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
    <style>

        @font-face {
            font-family: 'SolaimanLipi';
            font-style: normal;
            font-weight: 400;
            src: url('{{ storage_path('fonts/SolaimanLipi.ttf') }}') format('truetype');
        }
        body {
            font-family:  SolaimanLipi,DejaVu Sans, sans-serif,Helvetica!important;
            font-size: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-3">Attendance Report</h2>
    <table class="table table-bordered mb-5">
        <thead>
        <tr class="table-primary">
            <th scope="col">Month</th>
            <th scope="col">Date</th>
            <th scope="col">Day</th>
            <th scope="col">ID</th>
            <th scope="col">Employee Name</th>
            <th scope="col">Department</th>
            <th scope="col">First-In Time</th>
            <th scope="col">Last-Out Time</th>
            <th scope="col">Hours of Work</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attendance_report as $k => $data)
            <tr>
                <th>{{ $data['month'] }}</th>
                <td>{{ $data['date'] }}</td>
                <td>{{ $data['day'] }}</td>
                <td>{{ $data['employee_id'] }}</td>
                <td>{{ $data['employee_name'] }}</td>
                <td>{{ $data['department'] }}</td>
                <td>{{ $data['first_in'] }}</td>
                <td>{{ $data['last_out'] }}</td>
                <td>{{ $data['hours_of_work'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
