@extends('layouts.main')
@section('content')
<!-- Calendly inline widget begin -->
<div class="col-md-4">
    <a href="{{route('bookSlot')}}" type="button">Add 20 min extra</a>

</div>

<div class="calendly-inline-widget" data-url="https://calendly.com/susie-speak2impact-/60min" style="min-width:320px;height:630px;"></div>
<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
<!-- Calendly inline widget end -->
@endsection('content')