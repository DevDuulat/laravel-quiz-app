@extends('layouts.user')

@section('content')

    <!-- body overlay area start -->
    <div class="body_overlay"></div>
    <!-- body overlay area end -->
    <!-- crumbs area start -->
    <div class="crumbs-area">
        <div class="container">
            <div class="crumb-content">
                <h4 class="crumb-title">{{ $blog->title }}</h4>
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
                            <!-- Если есть обложка блога, используйте ее -->
                            @if($blog->cover)
                                <img src="{{ asset('storage/' . $blog->cover) }}" alt="{{ $blog->title }}">
                            @else
                                <!-- Если обложки нет, используйте заглушку или уберите этот блок -->
                                <img src="../assets/images/blog/default-cover.jpg" alt="Default Cover">
                            @endif
                        </div>
                        <div class="cs-content">
                            <div class="col-12 d-sm-flex  d-block ">
                                <p class="admin">Автор: {{ $blog->user->name }}</p>
                                <p>Дата публикации: {{ $blog->publication_date }}</p>
                            </div>
                            <h3 class="mb-4"><a href="#">{{ $blog->title }}</a></h3>
                            <p>{{ $blog->description }}</p>
                            <!-- Ваш контент блога -->
                            <p>{!! $blog->content  !!}</p>
                            <!-- Добавьте кнопку "Читать далее" -->
                            <!-- Здесь может быть ваша кнопка, которая будет вести на другую страницу с полным текстом блога -->

                            <div class="col-12">
                                <button type="button" class="btn btn-light  btn_blog">Далее</button>
                                <button type="button" class="btn btn-light  btn_blog">Назад</button>
                                <a href="/" class="btn btn-light  btn_blog">На главную</a>
                            </div>

                        </div>
                    </div>
                    <!-- comments area start -->
                    <div class="comment-area">
                        <h4 class="comment-title">Комментарии <span>({{ $comments->count() }})</span></h4>
                        <ul class="comment-list">
                            @foreach($comments as $comment)
                                <li class="comment-info-inner" id="comment-{{ $comment->id }}">
                                    <article>
                                        <div class="comment-thumb">
                                            <img src="{{ $comment->user->avatar_url }}" alt="image">
                                        </div>
                                        <div class="comment-content">
                                            <h4>{{ $comment->user->name }}</h4>
                                            <p>{{ $comment->content }}</p>
                                            <div class="cs-cmnt-meta">
                                                <ul>
                                                    <li>{{ $comment->created_at->format('d.m.Y') }}</li>
                                                </ul>
                                            </div>
                                            @can('update', $comment)
                                                <button class="btn btn-sm btn-primary edit-comment" data-id="{{ $comment->id }}">Редактировать</button>
                                            @endcan
                                            @can('delete', $comment)
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="delete-comment-form" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </article>
                                    <div class="edit-comment-form" id="edit-form-{{ $comment->id }}" style="display: none;">
                                        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="content">Комментарий</label>
                                                <textarea name="content" class="form-control" rows="5" required>{{ $comment->content }}</textarea>
                                                @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Обновить</button>
                                            <button type="button" class="btn btn-secondary cancel-edit" data-id="{{ $comment->id }}">Отмена</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach


                        </ul>
                    </div>

                    <!-- comments area end -->


                    <!-- Остальной контент блога -->
                    <!-- leave comment area start -->
                    <div class="leave-comment-area">
                        <h4 class="comment-title">Оставьте свой комментарий</h4>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="name" placeholder="Введите ваше имя" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" placeholder="Введите ваш Email" required>
                                </div>
                            </div>
                            <textarea name="content" id="msg" placeholder="Оставьте ваш комментарий тут" required></textarea>
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <button class="btn btn-primary btn-round" type="submit">Оставить комментарий<i class="fa fa-long-arrow-right"></i></button>
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
                                @foreach($randomBlogs as $randomBlog)
                                    <div class="w-cs-single">
                                        <!-- Возможно, у блога есть обложка, используйте ее -->
                                        @if($randomBlog->cover)
                                            <img src="{{ asset('storage/' . $randomBlog->cover) }}" alt="{{ $randomBlog->title }}">
                                        @else
                                            <!-- Если обложки нет, используйте заглушку или уберите этот блок -->
                                            <img src="../assets/images/course/default-cover.jpg" alt="Default Cover">
                                        @endif
                                        <div class="fix">
                                            <p><a href="#">{{ $randomBlog->title }}</a></p>
                                            <span><i class="fa fa-clock-o"></i> {{ $randomBlog->publication_date }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- widget course end -->
                    </div>
                </div>
                </div>
                <!-- sidebar end -->
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-comment').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById(`edit-form-${id}`).style.display = 'block';
                });
            });

            document.querySelectorAll('.cancel-edit').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    document.getElementById(`edit-form-${id}`).style.display = 'none';
                });
            });
        });
    </script>



@endsection
