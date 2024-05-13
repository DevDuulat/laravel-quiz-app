@extends('layouts.user')

@section('content')

    <!-- body overlay area start -->
    <div class="body_overlay"></div>
    <!-- body overlay area end -->
    <!-- crumbs area start -->
    <div class="crumbs-area">
        <div class="container">
            <div class="crumb-content">
                <h4 class="crumb-title">Основы криптографической защиты</h4>
            </div>
        </div>
    </div>
    <!-- crumbs area end -->
    <!-- course area start -->
    <div class="blog-details-area ptb--120">
        <div class="container">
            <div class="row">
                <!-- course details start -->
                <div class="col-lg-8 col-md-12">
                    <div class="course-details">
                        <div class="cs-thumb mb-5">
                            <img src="../assets/images/blog/blog-details.jpg" alt="image">
                        </div>
                        <div class="cs-content">
                            <div class="col-12 d-sm-flex  d-block ">
                                <p class="admin">Автор: Admin</p>
                                <p>Дата публикации: 20.10.24</p>
                            </div>


                            <h3 class="mb-4"><a href="#">Основы криптографической защиты </a></h3>

                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro
                                quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
                                quia non numquam eius modi tempora incidunt ut labore et dolore voluptatem.</p>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis
                                iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam,
                                eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                                explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                                sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque
                                porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                                sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam
                                quaerat voluptatem.</p>
                            <div class="cs-post-share">

                            </div>
                            <!-- post autohr info -->

                        </div>
                    </div>
                    <!-- comments area end -->
                    <div class="comment-area">
                        <h4 class="comment-title">Комментарии <span>(03)</span></h4>
                        <ul class="comment-list">
                            <li class="comment-info-inner">
                                <article>
                                    <div class="comment-thumb">
                                        <img src="../assets/images/author/cs-comment-auth1.jpg" alt="image">
                                    </div>
                                    <div class="comment-content">
                                        <h4>Томас</h4>
                                        <p>Курс максимально простой и познавательный для начинающих</p>
                                        <div class="cs-cmnt-meta">
                                            <ul>
                                                <li> 06.10.2024</li>
                                            </ul>
                                        </div>
                                    </div>
                                </article>

                            </li>
                            <li class="comment-info-inner">
                                <article>
                                    <div class="comment-thumb">
                                        <img src="../assets/images/author/cs-comment-auth3.jpg" alt="image">
                                    </div>
                                    <div class="comment-content">
                                        <h4>Багун хан</h4>
                                        <p>Рекомендую всем для ознакомление данны курсом. Автору большое спасибо за
                                            материал </p>
                                        <div class="cs-cmnt-meta">
                                            <ul>
                                                <li>25.10.2024</li>
                                            </ul>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        </ul>
                    </div>
                    <!-- comments area end -->

                    <!-- leave comment area start -->
                    <div class="leave-comment-area">
                        <h4 class="comment-title">Оставьте свой комментарий</h4>
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="Name" placeholder="Введите ваше имя">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" placeholder="Введите ваш Email">
                                </div>
                            </div>
                            <textarea name="msg" id="msg" placeholder="Оставьте ваш комментарий тут"></textarea>
                            <button class="btn btn-primary btn-round" type="submit">Оставить комментарий<i
                                    class="fa fa-long-arrow-right"></i></button>
                        </form>
                    </div>
                    <!-- leave comment area end -->
                </div>
                <!-- course details end -->

                <!-- sidebar start -->
                <div class="col-lg-4 col-md-4 d-none d-lg-block ">
                    <div class="sidebar">
                        <!-- widget course start -->
                        <div class="widget widget-course d-none d-sm-block">
                            <h4 class="widget-title">Другие статьи</h4>
                            <div class="course-list">
                                <div class="w-cs-single">
                                    <img src="../assets/images/course/cs-small-thumb1.jpg" alt="image">
                                    <div class="fix">
                                        <p><a href="#">Ui / Ux Design</a></p>
                                        <span><i class="fa fa-clock-o"></i> 12.05.2024</span>
                                    </div>
                                </div>
                                <div class="w-cs-single">
                                    <img src="../assets/images/course/cs-small-thumb2.jpg" alt="image">
                                    <div class="fix">
                                        <p><a href="#">Learn Java</a></p>
                                        <span><i class="fa fa-clock-o"></i> 12.05.2024</span>
                                    </div>
                                </div>
                                <div class="w-cs-single">
                                    <img src="../assets/images/course/cs-small-thumb3.jpg" alt="image">
                                    <div class="fix">
                                        <p><a href="#">C++</a></p>
                                        <span><i class="fa fa-clock-o"></i> 02.09.2023</span>
                                    </div>
                                </div>
                                <div class="w-cs-single">
                                    <img src="../assets/images/course/cs-small-thumb4.jpg" alt="image">
                                    <div class="fix">
                                        <p><a href="#">Seo</a></p>
                                        <span><i class="fa fa-clock-o"></i> 22.04.2024</span>
                                    </div>
                                </div>
                                <div class="w-cs-single">
                                    <img src="../assets/images/course/cs-small-thumb5.jpg" alt="image">
                                    <div class="fix">
                                        <p><a href="#">Python</a></p>
                                        <span><i class="fa fa-clock-o"></i>12.12.2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- widget course end -->

                    </div>
                </div>
                <!-- sidebar end -->
            </div>
        </div>
    </div>
    <!-- course area end -->

@endsection
