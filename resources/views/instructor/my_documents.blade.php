@extends('layouts.app')
@section('content')

    <style>
        .sl select{
            width: 32.8%;
            border-color: lightgrey;
            height: 2.2em;
            padding: 0px 5px;
            border-radius: 3px;
        }
    </style>

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">MY Documents</h4>
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
                            <li class="breadcrumb-item active" aria-current="page">MY Documents</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            <?php
                            $driving=$inst_l = "";
                            if( isset($docs) && $docs->driving_licence !='' ){
                                $driving = json_decode($docs->driving_licence);
                            }

                            if( isset($docs) && $docs->instructor_licence !='' ){
                                $inst_l = json_decode($docs->instructor_licence);
                            }
                            if( isset($docs) && $docs->wwcc !='' ){
                                $wwcc = json_decode($docs->wwcc);
                            }

                            ?>

                            <div id="licence-container">
                                <h3 class="pull-left">Driver’s Licence (C)</h3>
                                <button class="btn btn-success pull-right" type="button" @if(isset($docs->driving_licence_status) && $docs->driving_licence_status == 'pending') disabled @else data-toggle="modal" data-target=".driving-modal" @endif> @if(isset($docs->driving_licence_status) && $docs->driving_licence_status == 'pending') Pending status @else Update Driver's Licence @endif </button>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-6 small-margin-top-5">
                                        <label for="">Expiration Date</label>
                                        <input type="text" class="form-control"  value="{{ @$driving->exp_month}}-{{ @$driving->exp_day}}-{{ @$driving->exp_year}}" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row m-t-15">
                                            <div class="col-md-6">
                                                <p>Driver's Licence (C) - Front</p>
                                                @if(@$driving->file_front=='')
                                                <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                @else
                                                    <img src="{{ asset('assets/images/documents/'.@$driving->file_front) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <p>Driver's Licence (C) - Back</p>
                                                @if(@$driving->file_back=='')
                                                    <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                @else
                                                    <img src="{{ asset('assets/images/documents/'.@$driving->file_back) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div id="inst-licence-container">
                                <h3 class="pull-left">Driving Instructor’s Licence (C)</h3>
                                <button class="btn btn-success pull-right" type="button" @if(isset($docs->instructor_licence_status) && $docs->instructor_licence_status =='pending') disabled @endif  data-toggle="modal" data-target=".driving-instructor-modal"> @if(isset($docs->instructor_licence_status) && $docs->instructor_licence_status =='pending') Pending status @else Update Driving Instructor’s Licence (C) @endif</button>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row m-t-15">
                                            <div class="col-md-6 small-margin-top-5">
                                                <label for="">Expiration Date</label>
                                                <input type="text" class="form-control" value="{{ @$inst_l->exp_month}}-{{ @$inst_l->exp_day}}-{{ @$inst_l->exp_year}}" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Driver's Licence (C) - Front</p>
                                                @if(@$inst_l->file=='')
                                                    <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                @else
                                                    <img src="{{ asset('assets/images/documents/'.@$inst_l->file) }}" alt="" class="img-responsive">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div id="wwcc-container">
                                <h3 class="pull-left">Working with Children Check (WWCC)</h3>
                                <button class="btn btn-success pull-right" type="button" data-toggle="modal" data-target=".driving-wwcc-modal">Update Working with Children Check (WWCC)</button>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row m-t-15">
                                            <div class="col-sm-12 small-margin-top-5">

                                                <div class="form-group">
                                                    <label for="">Full name</label>
                                                    <input type="text" class="form-control" value="{{ @$wwcc->full_name }}" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">WWCC number (or application number)</label>
                                                    <input type="text" class="form-control" value="{{ @$wwcc->wwcc }}"  readonly>
                                                </div>

                                                <label for="">WWCC expiry date</label>
                                                <div class="form-group ">
                                                    <select name="" id="" disabled>
                                                        <option value="">{{ @$wwcc->dob_day_expire }}</option>
                                                    </select>
                                                    <select name="" id="" disabled>
                                                        <option value="">{{ @$wwcc->dob_month_expire }}</option>
                                                    </select>
                                                    <select name="" id="" disabled>
                                                        <option value="">{{ @$wwcc->dob_year_expire }}</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group ">
                                                    <p>Date of Birth</p>
                                                    <select name="" id="" disabled>
                                                        <option value="{{ @$wwcc->dob_day }}">{{ @$wwcc->dob_day }}</option>
                                                    </select>
                                                    <select name="" id="" disabled>
                                                        <option value="{{ @$wwcc->dob_month }}">{{ @$wwcc->dob_month }}</option>
                                                    </select>
                                                    <select name="" id="" disabled>
                                                        <option value="{{ @$wwcc->dob_year }}">{{ @$wwcc->dob_year }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    @if(@$docs->wwcc_image=='')
                                                        <div class="form-group">
                                                            <img src="{{ asset('assets/images/empty.png') }}" alt="" class="img-responsive">
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <img src="{{ asset('assets/images/documents/'.$docs->wwcc_image) }}" alt="" class="img-responsive">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group ">
                                                    <p> Verification date</p>
                                                    @if(@$docs->status=='1')
                                                        <select name="" id="" disabled>
                                                            <option value="">{{$dat}}</option>
                                                        </select>
                                                        <select name="" id="" disabled>
                                                            <option value="">{{$month}}</option>
                                                        </select>
                                                        <select name="" id="" disabled>
                                                            <option value="">{{$year}}</option>
                                                        </select>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade driving-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="driving_licence_form" action="" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Driver’s Licence </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="driving_licence">
                        <label for=""><span class="text-danger">*</span> Licence Front Side</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" required name="file_front" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>

                        <label for=""><span class="text-danger">*</span> Licence Back Side</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" required name="file_back" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>

                        <label for=""><span class="text-danger">*</span>  Expiration Date</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="exp_day" class="form-control" required="required" aria-required="true">
                                    <option value="">Day</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="exp_month" class="form-control" required="required" aria-required="true">
                                    <option value="">Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="exp_year" class="form-control" required="required" aria-required="true">
                                    <option value="">Year</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                    <option value="2034">2034</option>
                                    <option value="2035">2035</option>
                                    <option value="2036">2036</option>
                                    <option value="2037">2037</option>
                                    <option value="2038">2038</option>
                                    <option value="2039">2039</option>
                                    <option value="2040">2040</option>
                                    <option value="2041">2041</option>
                                    <option value="2042">2042</option>
                                    <option value="2043">2043</option>
                                    <option value="2044">2044</option>
                                    <option value="2045">2045</option>
                                    <option value="2046">2046</option>
                                    <option value="2047">2047</option>
                                    <option value="2048">2048</option>
                                    <option value="2049">2049</option>
                                    <option value="2050">2050</option>
                                    <option value="2051">2051</option>
                                    <option value="2052">2052</option>
                                    <option value="2053">2053</option>
                                    <option value="2054">2054</option>
                                    <option value="2055">2055</option>
                                    <option value="2056">2056</option>
                                    <option value="2057">2057</option>
                                    <option value="2058">2058</option>
                                    <option value="2059">2059</option>
                                    <option value="2060">2060</option>
                                    <option value="2061">2061</option>
                                    <option value="2062">2062</option>
                                    <option value="2063">2063</option>
                                    <option value="2064">2064</option>
                                    <option value="2065">2065</option>
                                    <option value="2066">2066</option>
                                    <option value="2067">2067</option>
                                    <option value="2068">2068</option>
                                    <option value="2069">2069</option>
                                    <option value="2070">2070</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect text-left" >Save</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade driver_instructor_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="" id="driver_instructor_form">
                    <div class="modal-header">
                        <h4 class="modal-title">DRIVING INSTRUCTOR’S LICENCE (C)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="driving_instructor">
                        <label for=""><span class="text-danger">*</span> Upload File</label>
                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                            <small>You can only upload images of type PNG or JPG. Please take a clear photo of the front of your driving instructor licence.</small>
                        </div>

                        <label for=""><span class="text-danger">*</span>  Expiration Date</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="exp_day" class="form-control" required="required" aria-required="true">
                                    <option value="">Day</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="exp_month" class="form-control" required="required" aria-required="true">
                                    <option value="">Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="exp_year" class="form-control" required="required" aria-required="true">
                                    <option value="">Year</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                    <option value="2034">2034</option>
                                    <option value="2035">2035</option>
                                    <option value="2036">2036</option>
                                    <option value="2037">2037</option>
                                    <option value="2038">2038</option>
                                    <option value="2039">2039</option>
                                    <option value="2040">2040</option>
                                    <option value="2041">2041</option>
                                    <option value="2042">2042</option>
                                    <option value="2043">2043</option>
                                    <option value="2044">2044</option>
                                    <option value="2045">2045</option>
                                    <option value="2046">2046</option>
                                    <option value="2047">2047</option>
                                    <option value="2048">2048</option>
                                    <option value="2049">2049</option>
                                    <option value="2050">2050</option>
                                    <option value="2051">2051</option>
                                    <option value="2052">2052</option>
                                    <option value="2053">2053</option>
                                    <option value="2054">2054</option>
                                    <option value="2055">2055</option>
                                    <option value="2056">2056</option>
                                    <option value="2057">2057</option>
                                    <option value="2058">2058</option>
                                    <option value="2059">2059</option>
                                    <option value="2060">2060</option>
                                    <option value="2061">2061</option>
                                    <option value="2062">2062</option>
                                    <option value="2063">2063</option>
                                    <option value="2064">2064</option>
                                    <option value="2065">2065</option>
                                    <option value="2066">2066</option>
                                    <option value="2067">2067</option>
                                    <option value="2068">2068</option>
                                    <option value="2069">2069</option>
                                    <option value="2070">2070</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect text-left" >Save</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade driving-wwcc-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="" id="wwcc_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Children Check (WWCC)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="type" value="wwcc">

                        <label for=""><span class="text-danger">*</span> Full Name </label>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <label for=""><span class="text-danger">*</span> WWCC number </label>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="wwcc" required>
                        </div>

                        <label for=""><span class="text-danger">*</span> Date of Birth</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="dob_day" class="form-control" required="required" aria-required="true">
                                    <option value="">Day</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="dob_month" class="form-control" required="required" aria-required="true">
                                    <option value="">Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="dob_year" class="form-control" required="required" aria-required="true">
                                    <option value="">Year</option>
                                    <?php
                                       for($i = 1950 ; $i < date('Y'); $i++){
                                          echo "<option>$i</option>";
                                       }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <label for=""><span class="text-danger">*</span> Expire Date</label>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="dob_day_expire" class="form-control" required="required" aria-required="true">
                                    <option value="">Day</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="dob_month_expire" class="form-control" required="required" aria-required="true">
                                    <option value="">Month</option>
                                    <option value="january">January</option>
                                    <option value="february">February</option>
                                    <option value="march">March</option>
                                    <option value="april">April</option>
                                    <option value="may">May</option>
                                    <option value="june">June</option>
                                    <option value="july">July</option>
                                    <option value="august">August</option>
                                    <option value="september">September</option>
                                    <option value="october">October</option>
                                    <option value="november">November</option>
                                    <option value="december">December</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="dob_year_expire" class="form-control" required="required" aria-required="true">
                                    <option value="">Year</option>
                                    <?php
                                        $last_year=date('Y')+15;
                                          for($i = 1950 ; $i < $last_year; $i++){
                                             echo "<option>$i</option>";
                                          }
                                       ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect text-left" >Save</button>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection

@section('scripts')

    <script>

        $(document).ready(function() {

            $('#driving_licence_form, #driver_instructor_form, #wwcc_form').submit(function (){

                $('#loading').show();
                var data = new FormData(this);

                $.ajax({
                    url: "{{Route('save_my_documents')}}",
                    data: data,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (res) {
                        if(res.success == true){
                            swal('Success', res.message, 'success');
                            $('.driving-wwcc-modal').modal('hide');
                            $('.driving-modal').modal('hide');
                            $('.driver_instructor_modal').modal('hide');
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

            $('#association_member').change(function (){
                if($(this).val() == 'Other'){
                    $('#member_input').show();
                }else{
                    $('#member_input').hide();
                }
            })

        });
    </script>
@endsection
