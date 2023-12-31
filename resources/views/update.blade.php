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
        <title>Update Reminder</title>
    </head>

    <body>
        <div class="content-wrapper" style="padding-bottom: 0px;">
            <div class="row" style="padding-top: 20px;">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body" style="padding-bottom: 10px;padding: 0.5rem 1.5rem 1.5rem 0.5rem;">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                  <h6 style="text-align:center;">
                                    <img src="{{url('public/assets/img/logo/logo.png')}}" alt="Logo" style="height:50px">  
                                  </h6>
                                </div>
                                <div class="col-lg-10 col-md-10 col-10">
                                    <h6 class="card-title" style="font-size:20px">Update Reminder</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-2" style="text-align: right;">
                                    <a href="{{url('/')}}" title="Click for return back"><i class="mdi mdi-arrow-left-bold-circle"></i></a>
                                </div>
                            </div>
                            <form class="form-sample" id="myForm">
                                <!-- <p class="card-description">
                                    Feedback Details
                                </p> -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="title" value="{{$data->title}}" required/>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="description" class="form-control" cols="10" rows="30" style="height:100px;">{{$data->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label">Reminder Type</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="remind_type" id="remind_type" onchange="checkForInput(jQuery(this).val());" disabled>
                                                    @foreach ($remind_type as $remind_types)
                                                        <option value="{{$remind_types->id}}" @if($remind_types->id == $data->remind_type){{'selected'}}@endif>{{$remind_types->remind_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="day_div" style="display:none;">
                                        <div class="row  form-group">
                                            <label class="col-sm-3 col-form-label">Day</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="day" id="day" disabled>
                                                    <option value="Sun" @if($data->day =='Sun') {{'selected'}} @endif>Sunday</option>
                                                    <option value="Mon" @if($data->day =='Mon') {{'selected'}} @endif>Monday</option>
                                                    <option value="Tue" @if($data->day =='Tue') {{'selected'}} @endif>Tuesday</option>
                                                    <option value="Wed" @if($data->day =='Wed') {{'selected'}} @endif>Wednesday</option>
                                                    <option value="Thu" @if($data->day =='Thu') {{'selected'}} @endif>Thursday</option>
                                                    <option value="Fri" @if($data->day =='Fri') {{'selected'}} @endif>Friday</option>
                                                    <option value="Sat" @if($data->day =='Sat') {{'selected'}} @endif>Saturday</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="from_date_div" style="display:none;">
                                        <div class="row  form-group">
                                            <label class="col-sm-3 col-form-label">From Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="from_date" id="from_date"  value="{{date('Y-m-d', strtotime($data->date))}}" onchange="timeValidation(jQuery(this).val())" required readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="to_date_div" style="display:none;">
                                        <div class="row  form-group">
                                            <label class="col-sm-3 col-form-label">To Day</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="to_date" id="to_date" value="{{date('Y-m-d', strtotime($data->date))}}" min="{{date('Y-m-d', strtotime($data->date))}}" required readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6" id="time_div" style="display:none;">
                                        <div class="row  form-group">
                                            <label class="col-sm-3 col-form-label">Time</label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" name="time" id="time" value="{{date('H:i A', strtotime($data->time))}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="date_div" style="display:none;">
                                        <div class="row  form-group">
                                            <label class="col-sm-3 col-form-label">Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="date" id="date" value="{{date('Y-m-d', strtotime($data->date))}}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Status</label>
                                            <div class="col-sm-9">
                                            <select class="form-control" name="active_status" required>
                                                <option value="Y" @if($data->status=='Y') {{'selected'}} @endif>Active</option>
                                                <option value="N" @if($data->status=='N') {{'selected'}} @endif>Inactive</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary me-2" id="submit_btn" style="width:100%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update Reminder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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
    
	
    <script>    
        jQuery(document).ready(function(){
            // alert('sds');
            checkForInput();
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery('#myForm').on('submit', function(e){
                e.preventDefault();
                var btn  = jQuery('#submit_btn');
                var msg  = jQuery('#alertMSG');
                var form = new FormData(this);
                var url = '/update-{{$data->id}}';
                jQuery.ajax({
                type: 'POST',
                url: url,
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend:function(){
                    msg.html('&nbsp;');
                    btn.html("<i class='fa fa-circle-o-notch fa-spin'></i> Updating Reminder");
                },
                success: function(data) {
                    if (data.status=='1') {
                    // Ajax call completed successfully
                    // alert(data.msg);
                    msg.html(data.msg).css('color', 'green');
                    jQuery('#myForm').trigger('reset');
                    checkForInput();
                    btn.html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update Reminder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    setTimeout(() => {
                        jQuery(msg).html('&nbsp;');
                    },3500);
                    } else {
                    // alert(data.msg);
                    msg.html(data.msg).css('color', 'red');
                    btn.html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update Reminder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                    }
                },
                error: function(data) {
                    // Some error in ajax call
                    // alert("some Error");
                    msg.html("some Error").css('color', 'red');
                    btn.html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update Reminder&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                }
                });  
            });
        });


        function checkForInput(val){
            jQuery('#day_div, #from_date_div, #to_date_div, #time_div, #date_div').hide();
            jQuery('#day, #from_date, #to_date, #time, #date').attr('disabled', true);
            var val = jQuery('#remind_type').val();
            // alert(val);

            // condition for Daily
             if (val == '1') {
                jQuery('#time_div').show();
                // jQuery('#time').attr('disabled', false);
            }

            // condition for Daily
            if (val == '2') {
                jQuery('#time_div, #date_div').show();
                // jQuery('#time, #date').attr('disabled', false);
            }

            // condition for Weekly
            if (val == '3') {
                jQuery('#day_div, #from_date_div, #to_date_div, #time_div').show();
                // jQuery('#time').attr('disabled', false);
            }
        }

        // time validation
        function timeValidation(val){
            // alert(val);
            jQuery('#to_date').val(val).attr('min', val);
        }
    </script>
    