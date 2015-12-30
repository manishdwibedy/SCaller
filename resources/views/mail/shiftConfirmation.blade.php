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
            {{$shift->shift}}
        </td>
    </tr>    
    @endforeach

</table>
<br><br>
Fight on!!<br><br>

Regards<br>
{{$name}}
