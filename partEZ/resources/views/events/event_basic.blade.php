<div class="container">
    <br>
    <h3> {{ $event['name'] }} </h3>
    <br>
    <ul>
        <li> Date:{{ $event['date'] }} </li>
        <li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
        <li> Location: {{ $event['location'] }} </li>
        <li> Description: {{ $event['description'] }} </li>

        <table> 
            <tr>
                <td>  
                    {{ Form::open(array('route' => array('events.event_details', $eid))) }}
                        <!-- Details Button -->
                        <button type="submit" name="details-button" href="{{ URL::route('events.event_details', array($eid))     }}"
                                class="btn btn-mini">Details</button>
                    {{ Form::close() }} 
                </td>
                <td>
                    {{ Form::open(array('route' => array('events.event_details_edit', $eid))) }}
                        <!-- Edit Button -->
                        <button type="submit" name="edit-button" href="{{ URL::route('events.event_details_edit', array($eid))     }}"
                                class="btn btn-mini" style="display:inline-block;">Edit</button>
                    {{ Form::close() }} 
                </td>
            </tr>
        </table>
    </ul>
    <br>
</div>