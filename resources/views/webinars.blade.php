@extends('layouts.main')
@section('content')


<!-- ===============   Webinar Start   ============== -->
<div class="upcoming-webinar">
    <div class="container-main">
        <h2>Upcoming webinars</h2>
        <div class="webinar-cards">
            @foreach($data['upcoming'] as $key=>$record)
            <div class="webinar-card">
                <div class="date">{{$record['date']}}</div>
                <div class="webinar-heading">{{$record['title']}}</div>
                <div class="webinar-description">{{$record['instructor']}}, Instructor</div>
                <div class="webinar-image">
                    <img src="./images/f1.png" alt="">
                </div>
                <div class="webinar-button">
                    <button>Book a slot</button>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- ===============   Webinar End   ============== -->
<!-- ===============   Webinar Start   ============== -->
<div class="current-webinar">
    <div class="container-main">
        <h2>Previous Webinars</h2>
        <div class="webinar-cards">
            @foreach($data['recorded'] as $key=>$record)
            <div class="webinar-card">
                <div class="date">{{$record['date']}}</div>
                <div class="webinar-heading">{{$record['title']}}</div>
                <div class="webinar-description">{{$record['instructor']}}, Instructor</div>
                <div class="webinar-image">
                    <img src="./images/f1.png" alt="">
                </div>
                <div class="webinar-button">
                    <button>Book a slot</button>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- ===============   Webinar End   ============== -->

@endsection