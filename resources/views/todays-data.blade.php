<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
    
        h2 {
            text-align: center;
            font-size: 1.5em;
            margin: 10px 0;
        }
    
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
    
        .card {
            width: 100%;
            max-width: 800px;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
    
        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #333;
            font-size: 0.9em;
        }
    
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
    
</head>
<body>
    <h2>Todays List {{ date('Y-M-D') }}</h2>
    <div class="container">
        <div class="card">
            <table border="1px">
                <thead>
                    <tr style="text-align: center">
                        <td colspan="10">
                            <h2>
                                Patient Details
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Tests</th>
                        <th>Amount</th>
                        <th>Amount Paid</th>
                        <th>Amount Online</th>
                        <th>Amount Cash</th>
                        <th>Amount Due</th>
                        <th>Test Delivery Date</th>
                        <th>Doctor Name</th>
                        <th>Ref By Name</th>
                    </tr>
                    @php
                        $todays_commison = 0;
                    @endphp
                    @foreach ($patients as $patient)
                        <tr>
                            <td>{{ $patient->name }}</td>
                            <td>{{ $patient->test }}</td>
                            <td>{{ $patient->amount }}</td>
                            <td>{{ $patient->amount_paid }}</td>
                            <td>{{ $patient->amount_paid_online }}</td>
                            <td>{{ $patient->amount_paid_cash }}</td>
                            <td>{{ $patient->amount_due }}</td>
                            <td>{{ $patient->test_delivery_date }}</td>
                            <td>{{ $patient->doctorDetails->name }}</td>
                            <td>{{ $patient->refByDetails->name }}</td>
                        </tr> 
                    @endforeach
                </thead>
            </table>
        </div>
        <div class="card">
            <table border="1px" style="margin-top: 15px">
                <thead>
                    <tr>
                        <td colspan="4">
                            <h2>
                                RC Details
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <th>Dr/RefBy Name</th>
                        <th>Test Amount</th>
                        <th>RC</th>
                        <th>Type</th>
                    </tr>
                    @foreach($doctors_data as $key => $d)
                        <tr>
                            <td>{{ $d['name'] }}</td>
                            <td>{{ $d['amount'] }}</td>
                            <td>{{ $d['rcless'] }}</td>
                            <td>
                                @if($d['type'] == 1)
                                    <span>Doctor</span>
                                @else
                                    <span>Ref By</span>
                                @endif
                            </td>
        
                        </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
</body>
</html>