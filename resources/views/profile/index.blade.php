@extends('layouts.user')

@section('content')

    <!-- body overlay area start -->
    <div class="body_overlay"></div>
    <!-- body overlay area end -->

    <div class="container account_user pt--130 pb--10 mt-5  ">
        <div class="row ">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <img class="rounded-circle mt-5" width="150px" src="{{ asset('storage/' . $user->avatar) ?? 'https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg' }}">
                        <input type="file" name="avatar" class="form-control mt-3">
                        <span class="font-weight-bold">{{ $user->name }}</span>
                        <span class="text-black-50">{{ $user->email }}</span>
                        <button type="submit" class="btn btn-primary profile-button mt-4">Изменить</button>
                    </form>
                </div>
            </div>

            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Настройки профиля</h4>
                    </div>
                    <form id="profile-form" method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <label class="labels">Имя</label>
                                <input type="text" class="form-control p-3" name="name" placeholder="Введите ваше ФИО">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input type="email" class="form-control p-3" name="email" placeholder="Введите ваш Email">
                            </div>
                            <div class="col-md-12">
                                <label class="labels mt-4">Ваш статус: Пользователь</label>
                            </div>
                        </div>

                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Сохранить профиль</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <h4>Изменить пароль</h4>
                    </div><br>
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div class="col-md-12">
                            <label class="labels">Текущий пароль</label>
                            <input type="password" name="current_password" class="form-control p-3" placeholder="Текущий пароль" value="">
                        </div> <br>

                        <div class="col-md-12">
                            <label class="labels">Новый пароль</label>
                            <input type="password" name="password" class="form-control p-3" placeholder="Новый пароль" value="">
                        </div>

                        <div class="col-md-12">
                            <label class="labels">Подтвердите пароль</label>
                            <input type="password" name="password_confirmation" class="form-control p-3" placeholder="Подтвердите пароль" value="">
                        </div>

                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button mt-5" type="submit">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

    </div>


    <div class="container">
        <div class="row d-flex justify-content-center">
            <h3 class="pb--80">Статистика пользователя</h3>

        </div>
    </div>


    <div class="container">
        <div class="row d-flex justify-content-center pb--120">
            <!-- <h3 class="pb--80">Статистика пользователя</h3> -->

            <div class="col-sm-8 col-12 pb--30">
                <div class="col-8">
                    <h4 class="pb--30">Прогресс прохождения курса</h4>
                </div>

                <div class="progress col-10" role="progressbar" aria-label="Example with label" aria-valuenow="{{ $progress }}"
                     aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: {{ $progress }}%">{{ round($progress, 2) }}%</div>
                </div>
            </div>
            <div class="col-sm-4 col-12">
                <div class=" mb-5">
                    <h4>Пройденный материал</h4>
                </div>
                <div class="col-6">
                    <table class="table text-dark table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Статус </th>
                            <th scope="col">Статьи</th>
                            <th scope="col">Лекции</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Пройдено</th>
                            <td>5</td>
                            <td>4</td>

                        </tr>
                        <tr>
                            <th scope="row">Осталось</th>
                            <td>5</td>
                            <td>10</td>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


@endsection
