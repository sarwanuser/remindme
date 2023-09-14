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
        <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/simple-datatables@latest.css')}}">
        <title>Your All Reminders</title>
    </head>

    <body>
        <div class="content-wrapper" style="padding-bottom: 0px;">
            <div class="row" style="padding-top: 20px;">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body" style="padding-bottom: 10px;">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-10">
                                    <h6 class="card-title" style="font-size:20px">Your All Reminders</h6>
                                </div>
                                <div class="col-lg-2 col-md-2 col-2" style="text-align: right;">
                                    <a href="{{url('/create')}}" title="Click for create page"><i class="mdi mdi-plus-box"></i></a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    @if(Session::has('Failed'))<span id="Massage" style="color: red;" min-height="10px" max-height="10px"> &nbsp; {{Session::get('Failed')}}</span>@endif
                                    @if(Session::has('Success'))<span id="Massage" style="color: green;" min-height="10px" max-height="10px"> &nbsp; {{Session::get('Success')}}</span>@endif
                                </div>
                            </div>
                  <!-- <p class="card-description">
                    Add class <code>.table-striped</code>
                  </p> -->
                  <div class="table-responsive">
                    <table class="table table-hover" id="datatablesSimple">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Description</th> 
                          <th>Reminder Type</th>
                          <th>Day</th>
                          <th>Date</th>
                          <th>Time</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        @foreach($remind as $datas)
                          <tr>
                            <td>{{$datas->title}}</td>
                            <td>{{$datas->description}}</td> 
                            <td>{{$datas->remind_type}}</td>
                            <td>{{$datas->day}}</td>
                            <td>{{date('d-m-Y', strtotime($datas->date))}}</td>
                            <td>{{date('H:i A', strtotime($datas->time))}}</td>
                            <td>
                              @if($datas->active_status=='Y')
                                <span style="color:#0d6efd;">Active</span>
                              @else
                                <span style="color:red;">Inactive</span></b>
                              @endif
                            </td>
                            <td>
                              <a href="{{url('/admin/feedback/edit-'.$datas->id)}}"><i class="mdi mdi-table-edit"></i></a>
                              <a href="{{url('/admin/feedback/delete-'.$datas->id)}}"><i class="mdi mdi-delete-forever"></i></a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </body>

    <!-- plugins:js -->
    <script src="{{url('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
    
    <!-- start custum table -->
      <script src="{{ URL::asset('assets/admin/js/datatables-simple-demo.js')}}"></script>
      <script src="{{ URL::asset('assets/admin/js/simple-datatables@latest.js')}}"></script>
    <!-- end custum table -->
    <script>    
        jQuery(document).ready(function(){
        // alert('sds');
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
            let files = jQuery('#profile_photo');
            form.append('files', files);
            var url = '/admin/feedback/store';
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
                btn.html("<i class='fa fa-circle-o-notch fa-spin'></i> Submiting");
            },
            success: function(data) {
                if (data.status=='1') {
                // Ajax call completed successfully
                // alert(data.msg);
                msg.html(data.msg).css('color', 'green');
                jQuery('#myForm').trigger('reset');
                btn.html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                setTimeout(() => {
                    jQuery(msg).html('&nbsp;');
                },3500);
                } else {
                // alert(data.msg);
                msg.html(data.msg).css('color', 'red');
                btn.html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                }
            },
            error: function(data) {
                // Some error in ajax call
                // alert("some Error");
                msg.html("some Error").css('color', 'red');
                btn.html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
            }
            });  
        });
        });
    </script>
    