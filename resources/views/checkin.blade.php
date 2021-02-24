
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Check in</th>
            <th>Check out</th>
            <th>date</th>
        </tr>
    </thead>
    <tbody>
        {{-- {{dd($dataCheckin)}} --}}
        @foreach($dataCheckin as $checkin)
        <tr>
            <td>{{$checkin->nameuser}}</td>
            <td>{{$checkin->start_date}}</td>
            <td>{{$checkin->end_date}}</td>
            <td>{{$checkin->start_date}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

