<h1>{{ $title }}</h1>
<p>Date: {{ $date }}</p>

<table>
    <thead>
        <tr>
       
            <th>Doctor</th>
            <th>Referred By</th>
            <th>total commission</th>
            <th>Total Amount</th>
            <th>total_amount_paid</th>
            <th>total_amount_paid_online</th>
            <th>total_amount_paid_cash</th>
            <th>total_amount_due</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->doctor->name }}</td>
                <td>{{ $patient->refby->name ?? 'N/A' }}</td>
                <td>{{ $total_commission }}</td>
                <td>{{ $total_amount }}</td>
                <td>{{ $total_amount_paid }}</td>
                <td>{{ $total_amount_paid_online }}</td>
                <td>{{ $total_amount_paid_cash }}</td>
                <td>{{ $total_amount_due }}</td>
              
            </tr>
        @endforeach
    </tbody>
</table>


