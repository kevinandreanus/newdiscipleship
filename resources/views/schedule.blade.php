@extends('template.template')

@push('custom-css')
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">
    
    <style>
        .fc-dayGridMonth-button.fc-button.fc-button-primary, 
        .fc-timeGridWeek-button.fc-button.fc-button-primary, 
        .fc-timeGridDay-button.fc-button.fc-button-primary,
        .fc-custom1-button.fc-button.fc-button-primary{
            padding: 3px;
            font-size: 12px;
        }
        .fc-prevYear-button.fc-button.fc-button-primary,
        .fc-prev-button.fc-button.fc-button-primary,
        .fc-next-button.fc-button.fc-button-primary,
        .fc-nextYear-button.fc-button.fc-button-primary{
            padding: 1px;
            font-size: 12px;
        }
        .fc-next-button.fc-button.fc-button-primary{
            padding: 2px
        }
        #fc-dom-1{
            font-size: 18px
        }
        .item .item-email{
            font-size: 10px;
            opacity: 0.5;
        }
        label.form-label.text-danger.mt-1{
            font-size: 10px;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <br>
    <div id='calendar'></div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
{{-- Add Event Modal --}}
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">Add Event</h6>
          <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="minimal-tab">
                <ul class="nav nav-tabs mb-3" id="affanTab2" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="event_tab btn active" value="1" id="pemuridan-tab" data-bs-toggle="tab" data-bs-target="#pemuridan" type="button" role="tab" aria-controls="pemuridan" aria-selected="true">Pemuridan</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="event_tab btn" value="2" id="komsel-tab" data-bs-toggle="tab" data-bs-target="#komsel" type="button" role="tab" aria-controls="komsel" aria-selected="false">Komsel</button>
                  </li>
                </ul>
                <div class="tab-content rounded-lg p-3" id="affanTab2Content">
                  <div class="tab-pane fade show active" id="pemuridan" role="tabpanel" aria-labelledby="pemuridan-tab">
                    <form action="{{ route('schedule-add') }}" method="POST" id="pemuridanform">
                        @csrf
                        <input type="text" hidden value="{{ Crypt::encryptString(Auth::id()) }}" name="user_id" id="user_id">
                        <input type="text" name="event_id" value="1" hidden>
                        <div class="form-group mb-3">
                            <label class="form-label" for="Username">Event Name <strong class="text-danger">*</strong></label>
                            <input class="form-control" id="eventName" type="text" name="event_title" placeholder="Event Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="Username">Event Date & Time <strong class="text-danger">*</strong></label>
                            <input class="form-control" id="datetimeinp" name="datetime" type="datetime-local" min="{{ date('m/d/Y h:i:s a', time()) }}" placeholder="Event Date & Time" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="Username">Event End Date & Time <strong class="text-danger">*</strong></label>
                            <input class="form-control" id="end_datetimeinp" name="end_datetime" type="datetime-local" min="{{ date('m/d/Y h:i:s a', time()) }}" placeholder="Event End Date & Time" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="Username">PIC <strong class="text-danger">*</strong></label>
                            <input class="form-control flexdatalist_pic" id="pic" type="text" placeholder="Choose PIC" name="pic">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="Username">Guest <strong class="text-danger">*</strong></label>
                            <input class="form-control flexdatalist_guest" id="guest" type="text" name="guest" multiple='multiple'>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check form-check-inline offlineBtn">
                                <input class="form-check-input" type="radio" name="offline_or_online" id="offlineCheck" value="offline" checked>
                                <label class="form-check-label mt-1" for="offlineCheck">Offline</label>
                            </div>
                            <div class="form-check form-check-inline onlineBtn">
                                <input class="form-check-input" type="radio" name="offline_or_online" id="onlineCheck" value="online">
                                <label class="form-check-label mt-1" for="onlineCheck">Online</label>
                            </div>
                        </div>
                        <div class="offlineContainer">
                            <div class="form-group mb-3">
                                <label class="form-label" for="Username">Location Address <strong class="text-danger">*</strong></label>
                                <input class="form-control" id="locationAddress" name="location_address" type="text" placeholder="Location Address">
                                <a href="" target="_blank" class="btn btn-primary btn-sm mt-2 pt-2" id="checkLocation" hidden>Check Location</a>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="Username">Address Description</label>
                                <input class="form-control" id="addressDescription" name="address_description" type="text" placeholder="Address Description">
                            </div>
                        </div>
                        <div class="onlineContainer">
                            <div class="form-group mb-3">
                                <label class="form-label" for="Username">Automatic Meeting Link</label>
                                <input class="form-control" id="automaticMeetLink" name="generated_meet_link" type="text" placeholder="Meeting Link" readonly>
                                <a href="#" id="generateBtn" class="btn btn-primary btn-sm mt-2 pt-2">Generate Meeting Link</a>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="Username">Manual Meeting Link</label>
                                <input class="form-control" id="manualMeetLink" name="manual_meet_link" type="text" placeholder="Manual Meeting Link">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="Username">Description</label>
                            <input class="form-control" name="description" id="description" type="text" placeholder="Description">
                        </div>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="komsel" role="tabpanel" aria-labelledby="komsel-tab">
                    kosong
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-sm btn-success" type="button" id="savebtn">Save</button>
        </div>
      </div>
    </div>
</div>

{{-- Event Details Modal --}}
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">Event Details</h6>
          <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="minimal-tab">
                <ul class="nav nav-tabs mb-3" id="affanTab2" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="btn active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Details</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="btn" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes" type="button" role="tab" aria-controls="notes" aria-selected="false">Notes</button>
                  </li>
                </ul>
                <div class="tab-content rounded-lg ps-3 pe-3 pb-3" id="affanTab2Content">
                  <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <span style="font-size: 12px" class="mt-3">Event Name: </span><br>
                    <strong style="font-size: 12px" id="event_name_details"></strong><br>
                    <span style="font-size: 12px">Date & Time: </span><br>
                    <strong style="font-size: 12px" id="event_datetime_details"></strong><br>
                    <span style="font-size: 12px" >PIC: </span><br>
                    <strong style="font-size: 12px" id="pic_details"></strong><br>
                    <span style="font-size: 12px">Guests: </span><br>
                    <strong style="font-size: 12px" id="guests_details"></strong><br>
                    <a id="btncheckin" class="btn btn-primary pt-2 mt-2">Check in</a>

                  </div>
                  <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                        <!-- All Comments -->
                        <div class="rating-and-review-wrapper pb-3 mt-3">
                            <div class="container">
                            {{-- <h6 class="mb-3">All comments</h6> --}}
                            <!-- Rating Review -->
                            <div class="rating-review-content">
                                <ul class="ps-2 mb-2" id="notes_container">
                                    {{-- <li class="single-user-review d-flex">
                                        <div class="user-thumbnail mt-0"><img src="{{ asset('img/bg-img/2.jpg') }}" alt=""></div>
                                        <div class="rating-comment">
                                        <p class="comment mb-1">I strongly recommend this agency to everyone interested in running a business.</p><span class="name-date">12 Dec 2021</span>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                            </div>
                        </div>
                        <!-- Comment Form -->
                        <div class="ratings-submit-form pb-3 mt-1">
                            <div class="container">
                            
                            <form>
                                <div class="form-group">
                                <textarea class="form-control mb-3 border-0" id="note_textarea" style="border: lightgray 1px solid !important" name="notes" cols="30" rows="10" placeholder="Write a notes"></textarea>
                                </div>
                                <input type="text" id="schedule_id_note" hidden>
                                <button class="btn w-100 btn-primary pt-2" type="button" id="btn_post_note">Post Notes</button>
                            </form>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('custom-js')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.js"></script>
@if (\Session::has('success'))
    <script>
        function showAlert(title){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });
          Toast.fire({
            icon: 'success',
            title: title
          });
    }

        showAlert('Successfully Check in!');
    </script>
@endif

@if (\Session::has('failed'))
    <script>
        function showAlert(title){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });
          Toast.fire({
            icon: 'error',
            title: title
          });
    }

        showAlert("Can't Check in right now!");
    </script>
@endif
<script>

    var user_id = $('#user_id').val();
    var calendar;

    $('#addEventModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#pemuridanform>div:nth-child(6)>ul>li.value').remove();

        clearForm();
    })

    $('#locationAddress').on('keyup', function(){

        if(this.value.length != 0){
            var data = $('#locationAddress').val();
            $('#checkLocation').attr("hidden", false);
            $('#checkLocation').attr("href", "https://www.google.com/maps?q="+data);
        }else{
            $('#checkLocation').attr("hidden", true);
        }

    });

    // Offline Online Radio Button
        $('.offlineBtn').on('click', function(){
            $('.offlineContainer').attr("checked", true);
            $('.onlineContainer').attr("checked", false);
            $('.onlineContainer').hide();
            $('.offlineContainer').show();
            if ($('#offlineCheck').is(':checked')) {
                $('.offlineContainer').attr("checked", true);
                $('.onlineContainer').attr("checked", false);
                $('.onlineContainer').hide();
                $('.offlineContainer').show();
            }
            if ($('#onlineCheck').is(':checked')){
                $('.onlineContainer').attr("checked", true);
                $('.offlineContainer').attr("checked", false);
                $('.offlineContainer').hide();
                $('.onlineContainer').show();
            }
        });
        $('.onlineBtn').on('click', function(){
            $('.onlineContainer').attr("checked", true);
            $('.offlineContainer').attr("checked", false);
            $('.offlineContainer').hide();
            $('.onlineContainer').show();
            if ($('#offlineCheck').is(':checked')) {
                $('.offlineContainer').attr("checked", true);
                $('.onlineContainer').attr("checked", false);
                $('.onlineContainer').hide();
                $('.offlineContainer').show();
            }
            if ($('#onlineCheck').is(':checked')){
                $('.onlineContainer').attr("checked", true);
                $('.offlineContainer').attr("checked", false);
                $('.offlineContainer').hide();
                $('.onlineContainer').show();
            }
        });
        if ($('#offlineCheck').is(':checked')) {
            $('.offlineContainer').attr("checked", true);
            $('.onlineContainer').attr("checked", false);
            $('.onlineContainer').hide();
            $('.offlineContainer').show();
        }
        if ($('#onlineCheck').is(':checked')){
            $('.onlineContainer').attr("checked", true);
            $('.offlineContainer').attr("checked", false);
            $('.offlineContainer').hide();
            $('.onlineContainer').show();
        }
        // Modal on Shown
        $('#addEventModal').on('shown.bs.modal', function () {
            clearForm();
            if ($('#offlineCheck').is(':checked')) {
                $('.offlineContainer').attr("checked", true);
                $('.onlineContainer').attr("checked", false);
                $('.onlineContainer').hide();
                $('.offlineContainer').show();
            }
            if ($('#onlineCheck').is(':checked')){
                $('.onlineContainer').attr("checked", true);
                $('.offlineContainer').attr("checked", false);
                $('.offlineContainer').hide();
                $('.onlineContainer').show();
            }
        })
    // >>
    
    // Generate Automatic Meeting Link
        $('#generateBtn').on('click', function(){
            var random1 = makeid(5);
            var random2 = makeid(5);
            var random3 = makeid(5);
            var random = random1 + '-' + random2 + '-' + random3
            
            var meetLink = "https://meet.jit.si/discipleship/"+random

            navigator.clipboard.writeText(meetLink);

            $('#automaticMeetLink').val(meetLink);
            $(this).addClass('disabled');
            $(this).removeClass('btn-primary');
            $(this).addClass('btn-success');
            $(this).text('Copied to Clipboard!');
        });

        function makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }

            return result;
        }
    // >>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'custom1',
                center: 'title',
                right: 'prevYear,prev,next,nextYear'
            },
            footerToolbar: {
                left: 'dayGridMonth,timeGridWeek,timeGridDay',
                center: '',
                right: 'prev,next'
            },
            customButtons: {
                custom1: {
                    text: 'Add Event',
                    click: function() {
                        $('#addEventModal').modal("show");
                    }
                }
            },
            eventSources: [
                {
                    url: '/schedule/data/'+user_id, // use the `url` property
                    color: 'yellow',    // an option!
                    textColor: 'black'  // an option!
                }
            ],
            eventClick: function(info) {
                var eventID = info.event.id;
                $.ajax({
                    url: '/schedule/data/each/'+eventID,
                    success: function(result){
                        // console.log(result);
                        $('#event_name_details').text(result.title);
                        $('#event_datetime_details').text(result.datetime + ' - ' + result.end_datetime);
                        $('#pic_details').text(result.pic_name);
                        $('#guests_details').text(result.guest_name);
                        $('#schedule_id_note').val(result.id);
                        $('#note_textarea').val('');
                        if(result.is_attend == 0){
                            $('#btncheckin').removeClass('btn-danger');
                            $('#btncheckin').removeClass('btn-success');
                            $('#btncheckin').addClass('btn-primary');
                            $('#btncheckin').removeClass('disabled');
                            $('#btncheckin').text('Check in');
                            $('#btncheckin').prop('disabled', false);
                            $('#btncheckin').attr('href', 'check-in/'+result.id);
                        }else if(result.is_attend == 2){
                            $('#btncheckin').removeClass('btn-primary');
                            $('#btncheckin').removeClass('btn-success');
                            $('#btncheckin').addClass('btn-danger');
                            $('#btncheckin').addClass('disabled');
                            $('#btncheckin').text("Doesn't Attend");
                            $('#btncheckin').prop('disabled', true);
                        }
                        else{
                            $('#btncheckin').removeClass('btn-danger');
                            $('#btncheckin').removeClass('btn-primary');
                            $('#btncheckin').addClass('btn-success');
                            $('#btncheckin').addClass('disabled');
                            $('#btncheckin').text('Attended');
                            $('#btncheckin').prop('disabled', true);
                        }

                        $('#notes_container').children('li').remove();
                        // Fetch Notes data (not yet)
                        $.ajax({
                            url: '/schedule/notes/get/'+eventID,
                            success: function(result){
                                $.each(result, function(r, k){
                                    $('#notes_container').append(
                                        `<li class="single-user-review d-flex">
                                            <div class="user-thumbnail mt-1"><img src="{{ asset('`+k.profile_picture+`') }}" alt=""></div>
                                            <div class="rating-comment">
                                                <strong style='font-size:12px'>`+k.user_name+`</strong><p class="comment mb-1" style='font-size:12px;white-space: pre-line'>`+k.notes+`</p><span class="name-date" style='font-size:10px'>`+k.created_at_custom+`</span>
                                            </div>
                                        </li>`
                                    );
                                });
                                
                            }
                        });

                        $('#eventDetailsModal').modal('show');
                    }
                });
                // alert('Event: ' + info.event.title);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('View: ' + info.view.type);

                // // change the border color just for fun
                // info.el.style.borderColor = 'red';
            }
        });

        calendar.render();

    });

    $('#btn_post_note').on('click', function(){
        

        $.ajax({
            type: 'post',
            url: '/schedule/notes/store',
            data: {
                'schedule_id': $('#schedule_id_note').val(),
                'notes': $('#note_textarea').val()
            },
            success: function(result){
                console.log(result);
            }
        });

        // Then Fetch newest data (not yet).
        $('#notes_container').LoadingOverlay('show');
        $('#notes_container').children('li').remove();
        // Fetch Notes data (not yet)
        $.ajax({
            url: '/schedule/notes/get/'+$('#schedule_id_note').val(),
            success: function(result){
                $.each(result, function(r, k){
                    
                    $('#notes_container').append(
                        `<li class="single-user-review d-flex">
                            <div class="user-thumbnail mt-1" ><img src="{{ asset('`+k.profile_picture+`') }}" alt=""></div>
                            <div class="rating-comment">
                                <strong style='font-size:12px'>`+k.user_name+`</strong><p class="comment mb-1" style='font-size:12px;white-space: pre-line'>`+k.notes+`</p><span class="name-date" style='font-size:10px'>`+k.created_at_custom+`</span>
                            </div>
                        </li>`
                    );
                });
                $('#note_textarea').val('');
                $('#notes_container').LoadingOverlay('hide');
            }
        });
    });

    $('#savebtn').on('click', function(){
        $.ajax({
            type: "POST",
            url: "/add-schedule",
            data: $('#pemuridanform').serialize(), 
            beforeSend: function(){
              $.LoadingOverlay("show");
            },
            success: function( msg ) {
              $.LoadingOverlay("hide");

              calendar.refetchEvents();
            },
            error: function(xhr, status, error){
                console.log(xhr);
            },
        }).then(function(msg){
            console.log(msg);

            if(msg.error){
                
                if(msg.error.event_title){
                    if($('#pemuridanform>div:nth-child(3)>label.form-label.text-danger.mt-1').length){
                        // 
                    }else{
                        $('#eventName').after('<label class="form-label text-danger mt-1">'+msg.error.event_title[0]+'</label>');
                    }
                }else{
                    if($('#pemuridanform>div:nth-child(3)>label.form-label.text-danger.mt-1').length){
                        $('#pemuridanform>div:nth-child(3)>label.form-label.text-danger.mt-1').remove();
                    }
                }

                if(msg.error.datetime){
                    
                    if($('#pemuridanform>div:nth-child(4)>label.text-danger').length){
                        // 
                    }else{
                        $('#datetimeinp').after('<label class="text-danger" style="font-size: 10px; font-weight: 500;">'+msg.error.datetime[0]+'</label>')
                    }
                }else{
                    if($('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').length){
                        $('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').remove();
                    }
                }

                if(msg.error.end_datetime){
                    if($('#pemuridanform>div:nth-child(5)>label.form-label.text-danger.mt-1').length){
                        // 
                    }else{
                        $('#end_datetimeinp').after('<label class="form-label text-danger mt-1">'+msg.error.end_datetime[0]+'</label>');
                    }
                }

                if(msg.datetimeerror){
                    if($('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').length){
                        // 
                    }else{
                        $('#datetimeinp').after('<label class="form-label text-danger mt-1">'+msg.datetimeerror+'</label>');
                    }
                }else{
                    if($('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').length){
                        $('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').remove();
                    }
                }

                if(msg.error.pic){
                    
                    if($('#pemuridanform>div:nth-child(6)>label:nth-child(4)').length){
                        // 
                    }else{
                        $('#pic-flexdatalist').after('<label class="form-label text-danger mt-1">'+msg.error.pic[0]+'</label>');
                    }
                }else{
                    if($('#pemuridanform>div:nth-child(5)>label:nth-child(4)').length){
                        $('#pemuridanform>div:nth-child(5)>label:nth-child(4)').remove();
                    }
                }

                if(msg.error.guest){
                    if($('#pemuridanform>div:nth-child(7)>label:nth-child(4)').length){
                        // 
                    }else{
                        $('.flexdatalist-multiple').after('<label class="form-label text-danger mt-1">'+msg.error.guest[0]+'</label>');
                    }
                }else{
                    if($('#pemuridanform>div:nth-child(6)>label:nth-child(4)').length){
                        $('#pemuridanform>div:nth-child(6)>label:nth-child(4)').remove();
                    }
                }

                if(msg.error.location_address){
                    if($('#pemuridanform>div.offlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').length){
                        // 
                    }else{
                        $('#locationAddress').after('<label class="form-label text-danger mt-1">'+msg.error.location_address[0]+'</label>');
                    }
                }else{
                    if($('#pemuridanform>div.offlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').length){
                        $('#pemuridanform>div.offlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').remove();
                    }
                }

                if(msg.error.generated_meet_link){
                    if($('#pemuridanform>div.onlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').length){
                        // 
                    }else{
                        $('#generateBtn').after('<label class="form-label text-danger mt-1">'+msg.error.generated_meet_link[0]+'</label>');
                    }
                }else{
                    if($('#pemuridanform>div.onlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').length){
                        $('#pemuridanform>div.onlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').remove();
                    }
                }

                if(msg.error.manual_meet_link){
                    if($('#pemuridanform>div.onlineContainer>div:nth-child(2)>label.form-label.text-danger.mt-1').length){
                        // 
                    }else{
                        $('#manualMeetLink').after('<label class="form-label text-danger mt-1">'+msg.error.manual_meet_link[0]+'</label>');
                    }
                }else{
                    if($('#pemuridanform>div.onlineContainer>div:nth-child(2)>label.form-label.text-danger.mt-1').length){
                        $('#pemuridanform>div.onlineContainer>div:nth-child(2)>label.form-label.text-danger.mt-1').remove();
                    }
                }

            }else{
                
                clearForm();

                showAlert('Success!');
                $('#addEventModal').modal("hide");

            }
        });
    });

    $('.flexdatalist_pic').flexdatalist({
          minLength: 2,
          searchIn: ['name', 'email'],
          data: '/api/user_list',
          maxShownResults: 5,
          selectionRequired: true,
          valueProperty: "id",
          visibleProperties: ['name', 'email'],
    });

    $('.flexdatalist_guest').flexdatalist({
          minLength: 2,
          searchIn: ['name', 'email'],
          data: '/api/user_list',
          maxShownResults: 5,
          selectionRequired: true,
          valueProperty: "id",
          multiple: true,
          visibleProperties: ['name', 'email'],
    });

    function showAlert(title){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          });
          Toast.fire({
            icon: 'success',
            title: title
          });
    }

    function clearForm(){
        if($('#pemuridanform>div:nth-child(3)>label.form-label.text-danger.mt-1').length){
            $('#pemuridanform>div:nth-child(3)>label.form-label.text-danger.mt-1').remove();
        }
        if($('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').length){
            $('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').remove();
        }
        if($('#pemuridanform>div:nth-child(5)>label:nth-child(4)').length){
            $('#pemuridanform>div:nth-child(5)>label:nth-child(4)').remove();
        }
        if($('#pemuridanform>div:nth-child(5)>label.form-label.text-danger.mt-1').length){
            $('#pemuridanform>div:nth-child(5)>label.form-label.text-danger.mt-1').remove();
        }
        if($('#pemuridanform>div:nth-child(6)>label:nth-child(4)').length){
            $('#pemuridanform>div:nth-child(6)>label:nth-child(4)').remove();
        }
        if($('#pemuridanform>div:nth-child(7)>label.form-label.text-danger.mt-1').length){
            $('#pemuridanform>div:nth-child(7)>label.form-label.text-danger.mt-1').remove();
        }
        if($('#pemuridanform>div.offlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').length){
            $('#pemuridanform>div.offlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').remove();
        }
        if($('#pemuridanform>div.onlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').length){
            $('#pemuridanform>div.onlineContainer>div:nth-child(1)>label.form-label.text-danger.mt-1').remove();
        }
        if($('#pemuridanform>div.onlineContainer>div:nth-child(2)>label.form-label.text-danger.mt-1').length){
            $('#pemuridanform>div.onlineContainer>div:nth-child(2)>label.form-label.text-danger.mt-1').remove();
        }
        if($('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').length){
            $('#pemuridanform>div:nth-child(4)>label.form-label.text-danger.mt-1').remove();
        }
        if($('#pemuridanform>div:nth-child(4)>label.text-danger').length){
            $('#pemuridanform>div:nth-child(4)>label.text-danger').remove();
        }
    }

</script>
@endpush