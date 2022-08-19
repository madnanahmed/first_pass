@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Welcome back  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card  bg-light no-card-border">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="m-r-10">
                                @if(auth()->user()->avatar !='')
                                <img src="{{ url('assets/images/users/'.auth()->user()->avatar) }}" alt="user" width="60" class="rounded-circle" />
                                @else
                                <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="rounded-circle" width="60">
                                @endif
                            </div>
                            <div>
                                <h3 class="m-b-0">Welcome back!</h3>
                                <span>{{ \Carbon\Carbon::now()->format('l jS \of F Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>{{ $TotalLesson }}</h3>
                            <h6 class="card-subtitle">Total Lessons</h6>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>{{ $TotalLessonCompleted }}</h3>
                            <h6 class="card-subtitle">Total Lesson Completed</h6>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h3>{{ $TotalLearner }}</h3>
                            <h6 class="card-subtitle">Total Learners</h6>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="0" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->

        </div>
        <!-- ============================================================== -->
        <!-- project of the month -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-sm-12 col-lg-8">

                <div class="card">
                    <div class="card-body p-b-0">
                        @if(isset($UpcomingAppointment->avatar))
                        <h4 class="card-title">YOUR NEXT LESSON IN {{\Carbon\Carbon::parse($UpcomingAppointment->schedule_date)->format('j F Y')}}</h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="d-flex align-items-center">
                                    <div class="m-r-10">
                                        @if( $UpcomingAppointment->avatar == '')
                                            <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle" width="60">
                                        @else
                                            <img src="{{ url('assets/images/users/'.$UpcomingAppointment->avatar) }}" alt="user" class="img-circle" width="60">
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="m-b-0">{{$UpcomingAppointment->name}} {{$UpcomingAppointment->lname}}</h3>
                                        <span> <i class="fa fa-phone"></i> <u>{{$UpcomingAppointment->phone}}</u> </span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <strong>
                                    <p>{{$UpcomingAppointment->schedule_date}} {{$UpcomingAppointment->time_slot}}<br>
                                    Status - <strong>{{$UpcomingAppointment->status}}</strong> <br>
{{--                                    43, Barrett Street, Gregory Hills 2557 NSW</p>--}}
                                </strong>

                            </div>
                        </div>
                        @else
                            <h4 class="card-title">Not Any Upcoming Lesson</h4>
                            <hr>
                        @endif

                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-b-0">
                        <h4 class="card-title">UPCOMING Lesson</h4>
                        <div class="table-responsive">
                            <table class="table v-middle">
                                <thead>
                                <tr>
                                    <th class="border-top-0">Learner</th>
                                    <th class="border-top-0">Schedule Date</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($appointments) && count($appointments) > 0 )
                                    @foreach($appointments as $appointment)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="m-r-10">
                                                        @if( $appointment->avatar == '')
                                                            <img src="{{ url('assets/images/users/default.png') }}" alt="user" class="img-circle" width="60">
                                                        @else
                                                            <img src="{{ url('assets/images/users/'.$appointment->avatar) }}" alt="user" class="img-circle" width="60">
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        <h4 class="m-b-0 font-16">{{$appointment->name}} {{$appointment->lname}}</h4>
                                                        <span>{{$appointment->email}}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$appointment->schedule_date}}</td>
                                            <td>@if($appointment->payment_status == 1) Paid @else UnPaid @endif</td>
                                            <td><a href="javascript:void(0)" onclick="AppointmentDetailModal(this)" data-appointment-id="{{$appointment->id}}" data-user-type="{{$appointment->type}}"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">Record Not Found</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="AppointmentDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Appointment Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="appointments_table" class="table table-striped table-bordered display">
                                    <thead>
                                    <tr>
                                        <th>Picture</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Schedule Date</th>
                                        <th>Time Slot</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WithDraw Amount Modal -->
            <div class="modal fade" id="WithDrawAmountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="withdraw_form">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">WithDraw Payment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="instructor_id" value="{{ Auth::user()->id  }}">
                                <div class="form-group">
                                    <label>Enter Amount</label>
                                    <div class="input-group">
                                        <input type="text" name="amount" class="form-control" placeholder="Enter Withdraw Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">WithDraw</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h4 class="card-title">Total Amount (Learners Paid)</h4>
                        <div class="d-flex align-items-center flex-row m-t-30">
                            <h2><strong>${{ (isset($TotalAmount))? $TotalAmount : '0'  }}</strong></h2>
                        </div>

                    </div>
                </div>
                <div class="card bg-light">
                    <div class="card-body">
                        <h4 class="card-title">Withdrawable Amount</h4>
                        <div class="d-flex align-items-center flex-row m-t-30">
                            <h2><strong>${{ (isset($GetCompletedAppointmentsAmount))? $GetCompletedAppointmentsAmount : '0'  }}</strong></h2>
                        </div>
                        @if(isset($GetCompletedAppointmentsAmount) && $GetCompletedAppointmentsAmount > 0 )
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#WithDrawAmountModal">Processed To Withdraw</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{ asset('assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{ asset('assets/js/pages/dashboards/dashboard3.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-html5-1.5.4/b-print-1.5.4/fh-3.1.4/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#withdraw_form').submit(function (){

                $('#loading').show();

                var data = new FormData(this);

                $.ajax({
                    url: "{{ route('withdraw-amount') }}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success')
                            .then(function() {
                                location.reload();
                                });
                        }else if(res.success == false){
                            swal('Warning!', res.message, 'error');
                        }

                        $('#loading').hide();
                    },
                    error: function () {
                        $('#loading').hide();
                    }

                });

                return false;
            });
        });

        function AppointmentDetailModal(e){
            $("#loading").show();
            var AppointmentID = $(e).attr('data-appointment-id');
            var UserType = $(e).attr('data-user-type');
            $.post('{{route('get-appointment-detail')}}',
                {AppointmentID: AppointmentID, UserType: UserType},
                function (res) {
                    var PaymentStatus = '';
                    var LearnerAvatar = '';
                    if(res.success == true){
                        if(res.message.payment_status == 1){
                            PaymentStatus = 'Paid';
                        }else{
                            PaymentStatus = 'UnPaid';
                        }
                        if(res.message.avatar == ''){
                            LearnerAvatar = '{{ url('assets/images/users/default.png') }}';
                        }else{
                            LearnerAvatar = '{{ url('assets/images/users/') }}'+res.message.avatar;
                        }
                        var AppendRow = '<tr>' +
                            '<td><img src="'+ LearnerAvatar +'" alt="user" class="img-circle" width="60"></td>' +
                            '<td>'+ res.message.name +' '+ res.message.lname +'</td>' +
                            '<td>'+ res.message.email +'</td>' +
                            '<td>'+ res.message.phone +'</td>' +
                            '<td>'+ res.message.schedule_date +'</td>' +
                            '<td>'+ res.message.time_slot +'</td>' +
                            '<td>'+ PaymentStatus +'</td>' +
                            '<td>'+ res.message.status +'</td>' +
                            '</tr>';
                        $('#appointments_table tbody').append(AppendRow);
                        $("#loading").hide();
                        $('#AppointmentDetailModal').modal('show');
                        console.log(AppendRow);
                    }
                });
        }
    </script>
@endsection
