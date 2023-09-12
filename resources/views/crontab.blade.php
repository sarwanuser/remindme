<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{url('assets/admin/vendors/mdi/css/materialdesignicons.min.css')}}">
        <!-- inject:css -->
        <link rel="stylesheet" href="{{url('assets/admin/css/vertical-layout-light/style.css')}}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{url('assets/admin/images/favicon.png')}}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Set New Reminder</title>
    </head>

    <body>
        <div class="content-wrapper" style="padding-bottom: 0px;">
            <div class="row" style="padding-top: 20px;">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body" style="padding-bottom: 10px;">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-10">
                                    <h6 class="card-title" style="font-size:20px">Set New Reminder</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-2" style="text-align: right;">
                                    <a href="{{url('/')}}" title="Click for return back"><i class="mdi mdi-arrow-left-bold-circle"></i></a>
                                </div>
                            </div>
                            <form class="form-sample" action="{{url('/cron-tab')}}" id="myForm" method="get">
                                <!-- <p class="card-description">
                                    Feedback Details
                                </p> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">Reminder Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="remind_type" id="">
                                                    @foreach ($remind_type as $remind_types)
                                                        <option value="{{$remind_types->id}}">{{$remind_types->remind_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row  form-group">
                                            <label class="col-sm-3 col-form-label">Day</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="day" id="">
                                                    <option value="Sun" selected>Sunday</option>
                                                    <option value="Mon">Monday</option>
                                                    <option value="Tue">Tuesday</option>
                                                    <option value="Wed">Wednesday</option>
                                                    <option value="Thu">Thursday</option>
                                                    <option value="Fri">Friday</option>
                                                    <option value="Sat">Saturday</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row  form-group">
                                            <label class="col-sm-3 col-form-label">Time</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" name="time" id="" value="{{date('00:00')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row  form-group">
                                            <label class="col-sm-3 col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="date" id="" value="{{date('Y-m-d')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary me-2" id="submit_btn" style="width:100%;">Check Scheduler</button>
                                    </div>
                                </div>
                                <div id="alertMSG">&nbsp;</div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <!-- plugins:js -->
    <script src="{{url('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
    
    