<h1>List of Contests</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Event Title</th>
            <th>Schedule</th>
            <th>Judges</th>
            <th>Contestants</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contests as $contest)
        <tr>
            <td><a href='{{url("/contest/$contest->id")}}' class="nav-link">{{$contest->title}}</a></td>
            <td>{{$contest->schedule}}</td>
            <td>{{$contest->countJudges}}</td>
            <td>{{$contest->countContestants}}</td>
            <td>{{$contest->status}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
