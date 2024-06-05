@extends('layouts.user')

@section('content')

    <!-- body overlay area start -->
    <div class="body_overlay"></div>
    <!-- body overlay area end -->
    <!-- crumbs area start -->
    <div class="crumbs-area ">
        <div class="container">
            <div class="crumb-content">
                <h4 class="crumb-title">О проекте</h4>
            </div>
        </div>
    </div>
    <!-- crumbs area end -->
    <!-- about area start -->
    <div class="about-area ptb--120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-left-content">
                        <div class="section-title">
                            <h3>Добро пожаловать на наш </h3>
                            <h3><span>веб-ресурс, посвященный </span> <span class="primary-color">криптографическим
                                    методам защиты
                                    информации!</span></h3>
                        </div>
                        <p>Мы - команда энтузиастов, которые убеждены в важности обеспечения конфиденциальности и
                            безопасности данных в цифровом мире. Наша миссия состоит в том, чтобы предоставить вам
                            доступ к высококачественным материалам по криптографии, чтобы вы могли углубить свои знания,
                            улучшить свои навыки и обеспечить надежную защиту вашей информации.</p>

                        <a data-toggle="modal" data-target="#exampleModal" href="#"
                           class="btn btn-primary btn-round">Узнать больше</a>
                    </div>



                </div>
                <div class="col-lg-6">
                    <div class="abt-right-thumb">
                        <div class="abt-rt-inner">
                            <a class="expand-video" href="https://www.youtube.com/watch?v=cdfMgotGKIM"><i
                                    class="fa fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->


@endsection
