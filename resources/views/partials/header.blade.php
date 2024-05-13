<!-- header area start -->
<header id="header">
    <!-- header two area start -->
    <div class="header-two">
        <div class="container">
            <div class="row align-items-center ptb--10">
                <div class="col-lg-3 col-sm-6  d-block d-lg-none">
                    <div class="logo_model">
                        <a href="{{ url('/') }}"><img src="{{ asset('images/logo.svg') }}" alt="logo"></a>
                    </div>
                </div>

                <div class="col-lg-7 offset-lg-1 d-none d-lg-block ">
                    <div class="main-menu menu-style2">
                        <nav>
                            <ul id="m_menu_active">
                                <li class="middle-logo">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ asset('images/logo.svg') }}" class="logo_left logo" alt="logo">
                                    </a>
                                </li>
                                <li class="active"><a href="/">Главная</a></li>
                                <li><a href="{{route('about')}}">О проекте</a></li>
                                <li><a href="{{route('blog-user')}}">Блок</a></li>
                                <li><a href="{{route('contact')}}">Контакты</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-4 col-8 ">
                    <div class="header-bottom-right-style-2">
                        <ul>
                            @guest
                            <li><a data-toggle="modal" data-target="#exampleModal" class="btn btn-light btn-round"
                                   href="{{ route('login') }}">Вход</a></li>
                            <li><a data-toggle="modal" data-target="#exampleModal2"
                                   class="btn btn-primary btn-round" class="active" href="{{ route('register') }}">Регистрация</a></li>

                            @else
                                <li class="col-sm-5">
                                    <p class="address email-info">{{ Auth::user()->name }}  <a href="#"></a></p>
                                </li>
                                <li>
                                    <a class="btn btn-light btn-round" href="{{route('dashboard')}}">Кабинет</a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-light btn-round" id="logoutBtn">Выход</a>
                                </li>


                            @endguest
                        </ul>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Вход</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <input type="email" placeholder="Введите Email..." required="">
                                        <input type="password" placeholder="Введите пароль">
                                        <label class="checkbox-inline mr-5"><input type="checkbox"
                                                                                   value="">Запомнить меня</label>
                                        <a class="primary-color" href="#"><u>Забыл пароль</u></a>
                                        <input class="btn btn-primary btn-sm" type="submit" value="Вход">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="signup-form text-center">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="text" placeholder="Имя">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder="Фамилия">
                                            </div>
                                        </div>
                                        <input type="email" placeholder="Введите Email..." required="">
                                        <input type="password" placeholder="Введите пароль">
                                        <input type="password" placeholder="Введите повторно пароль">

                                        <input class="btn btn-primary btn-sm" type="submit" value="Регистрация">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- col-lg-2 -->

                <div class="col-sm-12 col-12 d-block d-lg-none">
                    <div id="mobile_menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- header two area end -->
</header>
<!-- header area end -->
<script>
    document.getElementById('logoutBtn').addEventListener('click', function(event) {
        event.preventDefault();

        fetch("{{ route('logout') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        }).then(response => {
            if (response.ok) {
                // Обработка успешного выхода
                window.location.href = '/'; // Редирект, например, на главную страницу
            } else {
                // Обработка ошибки
                console.error('Ошибка выхода');
            }
        }).catch(error => {
            console.error('Ошибка выхода:', error);
        });
    });
</script>
