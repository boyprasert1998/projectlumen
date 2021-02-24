
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>StartDate</th>
            <th>EndDate</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataholiday as $holiday)
        <tr>
            <td>{{$holiday->holiday}}</td>
            <td>{{$holiday->start_date}}</td>
            <td>{{$holiday->end_date}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

