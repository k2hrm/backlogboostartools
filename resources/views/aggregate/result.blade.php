<table border="1">
    @foreach($issueKeyAndHoursArrs as $value)
    <tr>
        @foreach($value as $v)
        <td>{{$v}}</td>
        @endforeach
    </tr>
    @endforeach
</table>