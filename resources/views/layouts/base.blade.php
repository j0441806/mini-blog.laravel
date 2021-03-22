<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | mini-blog.laravel</title>
    <meta name="description" content="This site is a test site.">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="icon" href="images/favicon.png">
    </head>
    <body>
        <div id="wrapper">
            <header>
                <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-primary mb-5">
                    <a class="navbar-brand text-warning font-weight-bold mr-5" href="/account/signin"><i class="fab fa-laravel mr-1"></i>mini-blog.laraval</a>
                    <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @if (Auth::check())
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link text-white active" aria-current="page" href="/index"><i class="fas fa-comments mr-1"></i>Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/account"><i class="fas fa-user mr-1"></i>account</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/account/signout"><i class="fas fa-sign-out-alt mr-1"></i>logout</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/user/{{Auth::user()->id}}"><i class="fas fa-sign-in-alt mr-1"></i>{{Auth::user()->name}}さんでログインしています</a>
                            </li>
                        </ul>
                        @else
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/account/signin"><i class="fas fa-sign-in-alt mr-1"></i>login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="/account/signup"><i class="fas fa-user-plus mr-1"></i>register</a>
                            </li>
                        </ul>
                        @endif
                    </div>
                </nav>
            </header>

            <div id="wrap_content">
                <div id="head">
                    <main class="container">
                    <div style="height: 40px;"></div>
                        <div class="jumbotron mt-5">
                            <h1 class="display-4 mt-5">@yield('title')</h1>
                            @section('menubar')
                            <div class="additional_btn">
                                @show
                            </div>
                            <hr size="1" class="my-4">
                            @yield('description')
                        </div>
                    </main>
                </div>

                <div id="content">
                @yield('content')
                </div>

                @section('footer')
                <footer class="footer fixed-bottom mt-auto py-3 bg-secondary">
                    <div class="container">
                        <div class="text-right mr-3">
                            <i class="fab fa-twitter-square mr-3"></i>
                            <i class="fab fa-facebook-square mr-3"></i>
                            <span class="text-light"><i class="fas fa-copyright mr-1"></i>2021 j0441806.</span>
                        </div>
                    </div>
                </footer>
                @show
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/31168af8af.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
        <script>
        bsCustomFileInput.init();
        </script>
    </body>
</html>
