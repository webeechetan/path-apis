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
                    <th>Doctor_id</th>
                    <th>Doctor Name</th>
                    <th>ref_by_id</th>
                    <th>Ref_By_Name</th>
                    <th>total_commission</th>
                    <th>total_amount</th>
                    <th>total_amount_paid</th>
                    <th>total_amount_paid_online</th>
                    <th>total_amount_paid_cash</th>
                    <th>total_amount_due</th>
               
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                <tr>
                   
                    <td>{{ $patient->doctor_id }}</td>
                    <td>{{ $patient->ref_by_id }}</td>
           
                    <td>{{ $total_commission->total_commission }}</td>
                    <td>{{ $total_amount->total_amount }}</td>
                    <td>{{ $total_amount_paid->total_amount_paid }}</td>
                    <td>{{ $total_amount_paid_online->total_amount_paid_online }}</td>
                    <td>{{ $total_amount_paid_cash->total_amount_paid_cash }}</td>
                    <td>{{ $total_amount_due->total_amount_due }}</td>

                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
