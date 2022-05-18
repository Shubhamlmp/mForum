<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>mForum</title>
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  <!-- progress barstle -->
  <link rel="stylesheet" href="css/css-circular-prog-bar.css">
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <!-- font wesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/css-circular-prog-bar.css">

</head>

<body>
  <div class="top_container">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="" alt="">
            <span>
              mForum
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="dashboard"> Discussion <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  @if(Session::has('user'))
                  <a class="nav-link" href=""></a>
                  @else
                  <a class="nav-link" href="{{ url('registration') }}"> Signup </a>
                  @endif
                </li>
              </ul>
            </div>
        </nav>
      </div>

    </header>
    <section class="hero_section ">
      <div class="hero-container container">
        <div class="hero_detail-box">
          <h3>
            Welcome to <br>
          </h3>
          <h1>
            mForum
          </h1>
          <p>
            decision forum where the user can post his/her question and get the solution. He/She can also add questions to the website and answer the query that is unsolved.
          </p>

        </div>
        <div class="hero_img-container">
          <div>
            <img src="images/hero.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end header section -->

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container">
      <h2 class="main-heading ">
        About mForum
      </h2>
      <p class="text-center">
        mForum’s mission is to share and grow the world’s knowledge. Not all knowledge can be written down, but much of that which can be, still isn't. It remains in people’s heads or only accessible if you know the right people. We want to connect the people who have knowledge to the people who need it, to bring together people with different perspectives so they can understand each other better, and to empower everyone to share their knowledge for the benefit of the rest of the world.
      </p>
      <div class="about_img-box ">
        <img src="images/kids.jpg" alt="" class="img-fluid w-100">
      </div>
    </div>
  </section>
  <!-- about section -->

  <!-- team section -->
  <section class="teacher_section layout_padding-bottom">
    <div class="container">
      <h2 class="main-heading ">
        Our Team
      </h2>
      <p class="text-center">
      </p>
      <div class="teacher_container layout_padding2">
        <div class="card-deck">
          <div class="card">
            <img class="card-img-top" src="images/anish.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Anish</h5>
            </div>
          </div>

          <div class="card">
            <img class="card-img-top" src="images/shubham.jpeg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Shubham Verma</h5>
            </div>
          </div>

          <div class="card">
            <img class="card-img-top" src="images/tahir.jpeg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Tahir Ahmed</h5>
            </div>
          </div>

          <div class="card">
            <img class="card-img-top" src="images/shweta.jpeg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Shweta Suman</h5>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- Team section -->

  <!-- landing section -->
  <section class="landing_section layout_padding">
    <div class="container">
      <h2 class="main-heading">
        mForum
      </h2>
      <p class="landing_detail text-center">
        The heart of mForum is questions — questions that affect the world, questions that explain recent world events, questions that guide important life decisions, and questions that provide insights into why other people think differently. mForum is a place where you can ask questions that matter to you and get answers from people who have been there and done that. mForum is where scientists, artists, entrepreneurs, mechanics, and homemakers take refuge from misinformation and incendiary arguments to share what they know.
      </p>
    </div>
  </section>
  <!-- end landing section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      Copyright &copy; 2022 All Rights Reserved By
      <a href="/">mForum</a>
    </p>
  </section>
  <!-- footer section -->

  <script>
    function myFunction() {
      var element = document.body;
      element.classList.toggle("dark-theme");
    }
  </script>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>