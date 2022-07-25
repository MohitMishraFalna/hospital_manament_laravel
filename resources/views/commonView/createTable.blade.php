<tbody class="tableBody">
    @foreach ($values as $key => $value)
        <tr>                     
            @for($val = 0; $val < count($value); $val++)
                @if($values[$key][$val] == "activate")
                    <td><a href="{{route($urls['sts'], [$values[$key][$val], $values[$key][0]])}}"><i class="bi bi-toggle2-on" id="toggle2-on" style="color:#012970; font-size:23px; cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate"></i></a></td>
                @elseif($values[$key][$val] == "deactivate")
                    <td><a href="{{route($urls['sts'], [$values[$key][$val], $values[$key][0]])}}"><i class="bi bi-toggle2-off" id="toggle2-off" style="color:#012970; font-size:23px; cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top" title="Activate"></i></a></td>
                @else
                    <td>{{ucwords($values[$key][$val])}}</td>
                @endif
            @endfor
            <td>
                <a href="{{route($urls['edit'], $values[$key][0])}}"><i class="bi bi-pencil-square" style="color:#012970;" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a>
                <a href="{{route($urls['delete'], $values[$key][0])}}"><i class="bi bi-trash" style="color:#012970;" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a>
            </td>
        </tr>
    @endforeach
    
</tbody>