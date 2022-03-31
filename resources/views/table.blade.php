@extends('layout')

@section('content')
    <div class="container">
    @if(Session::has('EmailSuccess'))
        @if(Session::get('EmailSuccess') === true)
            <div class="alert alert-success">
                Email was sent
            </div>
        @else
            <div class="alert alert-danger">
                Email was not sent
            </div>
        @endif
        @php
            Session::forget('EmailSuccess');
        @endphp
    @endif
    </div>


    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                <canvas id="canvas" style="width:100%;max-width:700px"></canvas>
            </div>
            <div class="col">
                <canvas id="canvas1" style="width:100%;max-width:700px"></canvas>
            </div>
        </div>
    </div>



    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Open</th>
                <th scope="col">High</th>
                <th scope="col">Low</th>
                <th scope="col">Close</th>
                <th scope="col">Volume</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->getDate()) }}</td>
                    <td>{{ round($item->getOpen(), 3)}}</td>
                    <td>{{ round($item->getHigh(), 3)}}</td>
                    <td>{{ round($item->getLow(), 3)}}</td>
                    <td>{{ round($item->getClose(), 3)}}</td>
                    <td>{{ round($item->getVolume(), 3)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
<?php
    $open = json_encode($data->pluck('open')->all());
    $close = json_encode($data->pluck('close')->all());
    $time = $data->map(function ($price) {
        return $price->getDate()->format('Y-m-d');
    });

    $open = [];
    $close = [];
    foreach ($data as $dataItem) {
        $open[] = [
            'x' => $dataItem->getDate()->format('Y-m-d'),
            'y' => $dataItem->getOpen()
        ];
        $close[] = [
            'x' => $dataItem->getDate()->format('Y-m-d'),
            'y' => $dataItem->getClose()
        ];
    }
?>


@push('bottomScripts')
    <script>
        var timeFormat = 'YYYY-MM-DD';
        var options = {
            responsive: true,
            title:      {
                display: true,
            },
            scales:     {
                xAxes: [{
                    type:       "time",
                    time:       {
                        format: timeFormat,
                        tooltipFormat: 'L'
                    },
                    scaleLabel: {
                        display:     true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display:     true,
                        labelString: 'value'
                    }
                }]
            }
        }
        var config = {
            type:    'line',
            data:    {
                datasets: [
                    {
                        label: "Open",
                        data: {!! json_encode($open) !!},
                        fill: false,
                        borderColor: 'red'
                    },
                ]
            },
            options: options
        };
        var config1 = {
            type:    'line',
            data:    {
                datasets: [
                    {
                        label: "Close",
                        data:  {!! json_encode($close) !!},
                        fill:  false,
                        borderColor: 'blue'
                    }
                ]
            },
            options: options
        };

        window.onload = function () {
            var ctx       = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);

            var ctx       = document.getElementById("canvas1").getContext("2d");
            window.myLine1 = new Chart(ctx, config1);
        };

    </script>
@endpush
