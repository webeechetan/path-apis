<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px; 
        }

        .page {
            width: 210mm;
            height: 297mm;
            padding: 10mm;
            margin: 0;
        }

        table {
            width: 83%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            word-wrap: break-word;
            font-size: 9px; 
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
          
            margin-bottom: 20px;
        }

        th, td {
            width: 70px; 
        }
    </style>
</head>
<body>
    <div class="page">
        <h1>{{ $title }}</h1>
        <p>Date: {{ $date }}</p>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Doctor ID</th>
                    <th>Ref By ID</th>
                    <th>Test</th>
                    <th>Amount</th>
                    <th>Amount Paid</th>
                    <th>Paid Online</th>
                    <th>Paid Cash</th>
                    <th>Amount Due</th>
                    <th>RCLess</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->doctor_id }}</td>
                    <td>{{ $patient->ref_by_id }}</td>
                    <td>{{ $patient->test }}</td>
                    <td>{{ $patient->amount }}</td>
                    <td>{{ $patient->amount_paid }}</td>
                    <td>{{ $patient->amount_paid_online }}</td>
                    <td>{{ $patient->amount_paid_cash }}</td>
                    <td>{{ $patient->amount_due }}</td>
                    <td>{{ $patient->rcless }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
