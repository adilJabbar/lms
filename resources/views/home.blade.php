<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Speek2Impact</title>
  <!-- css link  -->

  <link rel="stylesheet" href="{{url('css/home.css')}}">
</head>

<body>
  <header class="main-site">
    <div class="container-main">
      <div class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Speak2Impact Academy</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Course</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Schedule meeting with Coach</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Practice</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Webinars</a>
              </li>
            </ul>
          </div>
          <a href="#" class="user-option">
            <img src="./images/user1.png" alt="">
          </a>
        </nav>
      </div>
    </div>
  </header>
    <div class="container-main">
      <h1>Hi James</h1>
    </div>
  
  <!-- ===============   Practice Start   ============== -->
  <div class="daily-goals">
    <div class="container-main">
      <div class="daily-goal">
        <div class="trophy">
          <img src="./images/trophy.png" alt="">
        </div>
        <div class="daily-progress">
          <h3>Daily Goals<span><img src="./images/edit.svg" alt="">Edit Goals</span></h3>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
              aria-valuemax="100"></div>
          </div>
          <small>04/10 xp</small>
        </div>
      </div>
    </div>
  </div> 
  {{-- {{ dd($courses);}} --}}
  <!-- ===============   Practice End   ============== -->
  <!-- ===============   Chapter Start   ============== -->
  <div class="chapter-detail" >
    <div class="container-main">
      <div class="chapter-detail-content"style="background-color: black; color: white;">
        <div class="chapter-header">
          <h6>Continue learning</h6>
          <h1>Introduction to the public speaking</h1>
        </div>
        <div class="chapter-playlist">
          <div class="chapter-video">
            <div class="webinar-image">
               <?php 
               
                $file_name = 'course/'.$courses[0]->course_id.'/'.$courses[0]->video_title.'.'.$courses[0]->video_type;

                ?>
                <video width="100%" height="100%" controls preload="auto"><source src="{{ url($file_name)}}" type="video/mp4"></video>
              {{-- <img src="./images/f1.png" alt="" style="width: 100%;"> --}}
            </div>
          </div>
          <div class="chapter-list" style="word-break: break-all; width: 68%;">
            <div class="count"id="accordionExample">
                <h5 class="accordion-header" id="headingOne">
                  The right way to express yourself
                </h5>
                <p>{{$courses[0]->overview}}
                </p>
             
              <div class="item">
                  <div class="play-list video-done">
                    <img src="./images/Play button.svg" alt="">
                    <span>Continue learning</span>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- ===============   Chapter End   ============== -->
  <div class="upcoming-webinar">
    <div class="container-main">
      <h2>Newly launched courses</h2>

 
     
      <div class="webinar-cards">
        @foreach ($courses as $course)
        <?php $file_name = 'course/'.$course->course_id.'/'.$course->video_title.'.'.$course->video_type;
        ?>
        <div class="webinar-card">
            <div class="webinar-heading">{{$course->course_title}}</div>
            <div class="webinar-description">Susie Ashfield, Instructor</div>
            <div class="webinar-image">
                <video width="100%" height="100%" controls preload="auto"><source src="{{ url($file_name)}}" type="video/mp4"></video>
            </div>
            <div class="webinar-button">
              <button>Start learning</button>
            </div>
          </div>
        @endforeach
        
        
      </div>
    </div>
  </div>




  <div class="upcoming-webinar">
    <div class="container-main">
      
    </div>
    <div class="action">
        <button type="button"data-bs-target="#exampleModal">
          Load more
        </button>
    </div>
  </div>

  <!-- ================   Modal   =============== -->



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <div class="membership-plan-pop">
            <div class="toggle-membership">
              Monthly
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
              </div>
              Annually
            </div>
            <h3>$3588.00</h3>
            <h6>Annual membership<span>$299.00/month</span></h6>
            <button class="start-membership">Start membership</button>
            <a href="#">Sign up for free</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>


  <footer>
    <div class="container-main">
      <div class="footer">
        <div class="footer-top">
          <div class="footer-logo">
            <span>Speak2Impact Academy</span>
          </div>
          <div class="footer-link">
            <a href="#">Contact US</a>
            <a href="#">Speak2impact</a>
            <a href="#">Sign up</a>
            <a href="#">Login</a>
          </div>
        </div>
        <div class="social-icon">
          <a href="#">
            <img src="./images/icons8-instagram.svg" alt="">
          </a>
          <a href="#">
            <img src="./images/icons8-facebook.svg" alt="">
          </a>
        </div>
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>