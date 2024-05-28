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
                                @guest
                                <li class="active"><a href="/">Главная</a></li>
                                @endguest
                                @auth
                                    <li><a href="{{ route('user-lectures') }}">Лекции</a></li>
                                    <li><a href="{{ route('user-tests') }}">Тренажеры</a></li>
                                @else
                                    <li><a href="{{route('about')}}">О проекте</a></li>
                                    <li><a href="{{route('contact')}}">Контакты</a></li>
                                @endauth
                                <li><a href="{{route('blog-user')}}">Блог</a></li>

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


                    <!-- Modal Structure -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Вход</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Login Form -->
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <!-- Session Status -->
                                        <x-auth-session-status class="mb-4" :status="session('status')" />

                                        <!-- Email Address -->
                                        <div class="form-group">
                                            <x-input-label for="email" :value="__('Email')" />
                                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group mt-4">
                                            <x-input-label for="password" :value="__('Пароль')" />
                                            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="form-group form-check mt-4">
                                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                            <label for="remember_me" class="form-check-label">
                                               Запомнить меня
                                            </label>
                                        </div>

                                        <!-- Forgot Password and Login Button -->
                                        <div class="form-group mt-4">
                                            @if (Route::has('password.request'))
                                                <a class="d-block mb-2" href="{{ route('password.request') }}">
                                                   Забыли пароль?
                                                </a>
                                            @endif

                                            <x-primary-button class="btn btn-primary">
                                              Войти
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Structure -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Registration Form -->
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <!-- First Name and Last Name -->
                                        <!-- Email Address -->
                                        <div class="mb-3">
                                                <div class="form-group">
                                                    <x-input-label for="first_name" :value="__('Имя')" />
                                                    <x-text-input id="first_name" class="form-control" type="text" name="name" :value="old('first_name')" required autofocus autocomplete="given-name" />
                                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                                </div>
                                        </div>


                                        <!-- Email Address -->
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <x-input-label for="email" :value="__('Email')" />
                                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <x-input-label for="password" :value="__('Пароль')" />
                                                <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <x-input-label for="password_confirmation" :value="__('Повторите пароль')" />
                                                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                        </div>

                                        <!-- Already Registered -->
                                        <div class="form-group">
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                                {{ __('Уже зарегистрированы?') }}
                                            </a>
                                        </div>

                                        <!-- Register Button -->
                                        <div class="text-center">
                                            <x-primary-button class="btn btn-primary">
                                              Регистрация
                                            </x-primary-button>
                                        </div>
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
