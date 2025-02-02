<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Departures</title>

    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }
        h1 {
            background-color: #0044cc;
            color: white;
            padding: 20px;
            text-align: center;
        }
        h2 {
            color: #444;
            margin-top: 30px;
        }
        .status-scheduled {
            color: green;
        }
        .status-delayed {
            color: red;
        }
        .status-cancelled {
            color: gray;
        }
        .table-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <h1>Flight Departures from DOH</h1>

    <div class="container table-container">
        <h2 class="text-center">Upcoming Departures</h2>

        <!-- Flight Departures Table -->
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Flight Number</th>
                    <th>Status</th>
                    <th>Aircraft Model</th>
                    <th>Departure Time</th>
                    <th>Destination</th>
                    <th>Destination Airport Code</th>
                    <th>Departure Airport</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through the dynamic flight data -->
                @if(!empty($flights['airport']['pluginData']['schedule']['departures']['data']))
                    @foreach($flights['airport']['pluginData']['schedule']['departures']['data'] as $flight)
                        <tr>
                            <td>{{ $flight['flight']['identification']['number']['default'] }}</td>
                            <td class="
                                @if($flight['flight']['status']['text'] == 'Scheduled') status-scheduled
                                @elseif($flight['flight']['status']['text'] == 'Delayed') status-delayed
                                @elseif($flight['flight']['status']['text'] == 'Cancelled') status-cancelled
                                @endif">
                                {{ $flight['flight']['status']['text'] }}
                            </td>
                            <td>{{ $flight['flight']['aircraft']['model']['code'] }}</td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp($flight['flight']['time']['scheduled']['departure'])->format('d-m-Y H:i') }}</td>
                            <td>{{ $flight['flight']['airport']['destination']['name'] }}</td>
                            <td>{{ $flight['flight']['airport']['destination']['code']['iata'] }}</td>
                            <td>{{ $flights['airport']['pluginData']['details']['name'] }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No departure data available.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
