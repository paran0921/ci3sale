<!doctype html>
<html lang="ko">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <title>판매관리</title>
        <link href="/my/css/bootstrap.min.css" rel="stylesheet">
        <link href="/my/css/cis.css" rel="stylesheet">
        <script src="/my/js/jquery-3.3.1.min.js"></script>
        <script src="/my/js/popper.min.js"></script>
        <script src="/my/js/bootstrap.min.js"></script>

        <script src="/my/js/moment-with-locales.min.js"></script>
        <script src="/my/js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="/my/css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="/my/css/fontawesome-all.css">
    </head>
    <body>
        <div class="container">
            <!-- navigation start -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">판매관리</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="/jangbui">매입</a></li>
                        <li class="nav-item"><a class="nav-link" href="/jangbuo">매출</a></li>
                        <li class="nav-item"><a class="nav-link" href="/gigan">기간조회</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                통계
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                <a class="dropdown-item" href="/best">BEST제품</a>
                                <a class="dropdown-item" href="/crosstab">월별제품별현황</a>
                                <a class="dropdown-item" href="/graph">종류별 분포도</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                기초정보
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                <a class="dropdown-item" href="/gubun">구분</a>
                                <a class="dropdown-item" href="/product">제품</a>
                            <?php if ($this->session->userdata('rank') == 1) : ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/member">사용자</a>
                            <?php endif; ?>
                            </div>
                        </li>
                        <li class="nav-item"><a href="/picture" class="nav-link">사진</a></li>
                        <li class="nav-item">
                        <?php // echo "session[uid]=>[".$this->session->userdata('uid')."]<br>"; ?>
                        <?php if (!$this->session->userdata('uid')) : ?>
                            <a class="btn btn-sm btn-outline-secondary btn-dark" href="#exampleModal" data-toggle="modal">로그인</a>
                        <?php else : ?>
                            <a class="btn btn-sm btn-outline-secondary btn-dark" href="/login/logout">로그아웃</a>
                        <?php endif ?>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- navigation end -->
            <!-- Model Login Start -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="model-dialog modal-sm" role="document">
                    <div class="model-content">
                        <div class="modal-header mycolor1">
                            <h4 class="modal-title" id="exampleModalLabel">로그인</h4>                
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body bg-light" style="text-align:center">
                            <form action="/login/check" name="form_login" method="post">
                                <div class="form-inline">
                                    아이디 : &nbsp;&nbsp;
                                    <input class="form-control form-control-sm" type="text" name="uid" size="15" value="">
                                </div>
                                <div style="height:10px"></div>
                                <div class="form-inline">
                                    암 &nbsp;&nbsp; 호 : &nbsp;&nbsp; 
                                    <input class="form-control form-control-sm" type="password" name="pwd" size="15" value="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer alert-secondary" style="text-align:center">
                           <button class="btn btn-sm btn-secondary" type="button" onclick="form_login.submit();">확인</button>
                           <button class="btn btn-sm btn-light" type="button" data-dismiss="modal">닫기</button>
                        </div>
                    </div>     
                </div>
            </div>
            <!-- Model Login End -->
            <!-- Image slide Start -->
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/my/img/main1.jpg" class="d-block w-100" height="150">
                </div>
                <div class="carousel-item">
                  <img src="/my/img/main2.jpg" class="d-block w-100" height="150">
                </div>
                <div class="carousel-item">
                  <img src="/my/img/main3.jpg" class="d-block w-100" height="150">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </button>
            </div>
            <!-- Image slide End -->
