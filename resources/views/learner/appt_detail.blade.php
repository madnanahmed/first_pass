<table class="table table-bordered table-striped" width="100%">
    <thead>
    <tr>
        <th class="border-top-0">Instructor</th>
        <th class="border-top-0">Lessson Type</th>
        <th class="border-top-0">Schedule Date</th>
        <th class="border-top-0">Status</th>
        <th class="border-top-0">Address</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($appointment_detail))
            <tr class="@if(@$appointment_detail->time_slot == '') bg-danger text-white @endif" @if(@$appointment_detail->time_slot == '') data-toggle="tooltip" data-title="Instructor can't approve a lesson if time is missed, please add schedule time" @endif>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="m-r-10">
                            @if( $appointment_detail->avatar == '')
                                <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle rounded-circle" width="60">
                            @else
                                <img src="{{ url('assets/images/users/'.$appointment_detail->avatar) }}" alt="user" class="img-circle rounded-circle" width="60">
                            @endif
                        </div>
                        <div class="">
                            <h4 class="m-b-0 font-16">{{$appointment_detail->name}} {{$appointment_detail->lname}}</h4>
                            <span>{{$appointment_detail->email}}</span>
                            <span>{{$appointment_detail->phone}}</span>
                        </div>
                    </div>
                </td>
                <td>{{$appointment_detail->type}}</td>
                <td>{{$appointment_detail->schedule_date .' '.$appointment_detail->time_slot }}</td>
                <td>{{$appointment_detail->status}}</td>
                <td>
                    <?php
                    $valid =['city', 'state', 'country', 'postal_code', 'suburb', 'query'];
                    $address = json_decode($appointment_detail->address);

                    $address_r='<table>';
                    foreach ($address->address_detail as $i => $v){
                        if(in_array($i, $valid)){
                            $address_r.= ' <tr><th>'.$i . ':</th> <td>'. $v.'</td></tr>';
                        }
                    }
                    echo $address_r.='</table>';
                    ?>
                </td>

            </tr>

    @else
        <tr>
            <td class="text-center" colspan="4">Record Not Found</td>
        </tr>
    @endif
    </tbody>
</table>
