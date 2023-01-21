@extends('layouts.main')
@section('content')
  <!-- ===============   Practice Start   ============== -->
  <div class="daily-goals">
    <div class="container-main">
      <div class="daily-goal">
        <div class="trophy">
          <img src="{{url('images/trophy.png')}}" alt="">
        </div>
        <div class="daily-progress">
          <h3>Daily Goals<span><img src="{{url('images/edit.svg')}}" alt="">Edit Goals</span></h3>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
              aria-valuemax="100"></div>
          </div>
          <small>04/10 xp</small>
        </div>
      </div>
    </div>
  </div>
  <!-- ===============   Practice End   ============== -->
  <!-- ===============   Chapter Start   ============== -->
  <div class="chapter-detail">
    <div class="container-main">
      <div class="chapter-detail-content">
        <div class="chapter-header">
          <h6>Chapter I</h6>
          <h1>Introduction to the public speaking</h1>
          <h6>Susie Ashfield, Instructor</h6>
        </div>
        <div class="chapter-playlist">
          <div class="chapter-video">
          <?php 
                // dd($courses[0]->course_videos[0]->video_type);
                if(isset($first_video->video_title))
                {
                    $file_name = 'course/'.$course->id.'/'.$first_video->video_title.'.'.$first_video->video_type;
                
               
                
  // dd($file_name,$courses[0]);
                ?>
          <video width="100%" height="100%" controls="" preload="auto"><source src="{{url($file_name)}}" type="video/mp4"></video>
                    <?php 
                
                }else{
                    ?>
     <video width="100%" height="100%" controls="" preload="auto"><source src="http://127.0.0.1:8000/course/1/raw_1673556794_bandicam-2022-10-29-17-37-27-682-16735567941201.mp4" type="video/mp4"></video>
                <?php }
                 ?>
          </div>
          <div class="chapter-list">
            <div class="accordion" id="accordionExample">
            @php $sectioncount = '1'; $lecturecount = '1'; $quizcount = '1'; @endphp
            @foreach($sections as $section)  
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Chapter {{ $section->section_id}}: {{ $section->title}}
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                   @foreach($lecturesquiz[$section->section_id] as $lecturequiz)
                    <div  class="play-list video-done {{ Request::segment(3) == '' ? 'active-video'.$lecturequiz->lecture_quiz_id : null }}">
                      <img src="{{url('images/Play button.svg')}}" alt="">
                     <a href="{{route('course-lesson-number',[$course->id,$lecturequiz->lecture_quiz_id])}}"> <span>{!! $lecturequiz->title !!}<small style= "float:right"> 2:01 mins</small></span> </a>
                    </div>
                    @php
                    @endphp
                    @endforeach   
              
                  </div>
                </div>
              </div>
            @endforeach   
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- ===============   Chapter End   ============== -->
  <div class="chapter-tabs">
    <div class="container-main">
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button"
            role="tab" aria-controls="nav-profile" aria-selected="false">Notes</button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
         @php 
         
         echo $quiz_description;

         @endphp
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <form>
            <textarea rows="5" cols="33" style="padding: 1; margin: 1; width: 53%; " placeholder="Write something"> 
            </textarea>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ================   Modal   =============== -->
  <!-- <div class="action" ">
    <div style="display: flex; justify-content: center; margin-bottom: 2%;" class="container-main">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Get full access
      </button>
    </div>
  </div> -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="membership-plan-pop">
            <i class="fa fa-lock"></i>
            <h3>Get full access</h3>
            <i class="fas fa-band-aid"></i>
            <div class="toggle-membership">
              Monthly
              <div class="form-check form-switch">
                <input class="form-check-input"  type="checkbox" id="flexSwitchCheckDefault">
              </div>
              Annually
            </div>
            <h3><span id="plan-price" > ${{$subscriptionPlanMonthly->price}}.00 </span></h3>
            <h6>Annual membership<span>$<?php echo number_format($subscriptionPlanAnually->price/12,2) ?>/month</span></h6>
            <a href="{{route('membershipPlans')}}"> <button class="start-membership">Start membership</button></a>
            <a href="#">Sign up for free</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
<?php //dd($access); ?>
<script>
   $("#flexSwitchCheckDefault").click(function(){
    $("#display").toggle();
    if($(this).text() == "Show"){
        $price = '<?php echo $subscriptionPlanMonthly->price; ?>';
        $('#plan-price').html('$'+$price+'.00');
       $(this).text("Hide");
    }else{
        $price = '<?php echo $subscriptionPlanAnually->price; ?>';
        $('#plan-price').html('$'+$price+'.00');
       $(this).text("Show");
    }
});

var access = "<?= $access; ?>";

  if(access == 'false')
  {
    // $('#exampleModal').modal();
    $('#exampleModal').modal({backdrop: 'static', keyboard: false}, 'show');
  }
    </script>
@endsection('body')
