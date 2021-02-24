
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>LeaveType</th>
            <th>Description</th>
            <th>StartDate</th>
            <th>EndDate</th>
            <th>status</th>
            <th>Approve</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataLeaveall as $leave)
        <tr>
            <td>{{$leave->nameuser}}</td>
            <td>{{$leave->leave_type}}</td>
            <td>{{$leave->leave_description}}</td>
            <td>{{$leave->start_date}}</td>
            <td>{{$leave->end_date}}</td>
            <td>{{$leave->leave_status}}</td>
            <td>{{$leave->nameadmin}}</td>

        </tr>
        @endforeach
    </tbody>
</table>

