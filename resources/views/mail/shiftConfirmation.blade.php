Hi, <br><br>

I am hereby submitting my shift schedule. <br><br>

<table>
    @foreach($shifts as $shift)
    <tr>
        <td>
            {{$shift->sno }}.
        </td>
        <td>
            {{ $shift->date}}
        </td>
        <td>
            @foreach($shift->shift as $data)
                {{$data}}
            @endforeach

        </td>
    </tr>
    @endforeach

</table><br><br>

Total Shifts: {{$totalShifts}} ({{$totalShifts * 2}} hours)
<br><br>
Fight on!!<br><br>

Regards<br>
{{$name}}
