@extends('layouts.main')
@section('content')
<!-- Calendly inline widget begin -->
<div class="col-md-4">
    <a href="{{route('bookSlot')}}" type="button">Add 20 min extra</a>

</div>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="calendly-inline-widget" data-url="https://calendly.com/susie-speak2impact-/60min" style="min-width:320px;height:630px;"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>

function isCalendlyEvent(e) {
    return e.origin === "https://calendly.com" && e.data.event && e.data.event.indexOf("calendly.") === 0;
}
;

window.addEventListener("message", function (e) {
    if (isCalendlyEvent(e)) {
        /* name of the event */
        console.log("Event name:", e.data.event);

        /* payload of the event */
        console.log("Event details:", e.data.payload);
        console.log("Event URL:", e.data.payload.event.uri);
//        console.log("Event Invitee:", e.data.payload.invitee.uri);
        var event_url = e.data.payload.event.uri;
        var invitee_url = e.data.payload.invitee.uri;

        scheduleEventFunction(event_url, invitee_url);

    }
});

function scheduleEventFunction(event_url, invitee_url) {
    var routeUrl = '<?php echo route("createBooking") ?>';
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        data: {event_url: event_url, invitee_url: invitee_url},
        url: routeUrl,
        success: function (data) {
            if (data.success) {
                alert('booking created successfully');
            } else {
                alert('something went wrong while saving this booking');
            }
        },
        error: function () {
            alert('something went wrong while saving this booking');
        }
    });
}

</script>
<!-- Calendly inline widget end -->
@endsection('content')