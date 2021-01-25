<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img width=64px height=64px src="{{asset('favicon.svg')}}" alt="GameUp"/>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="{{Route::currentRouteName() === 'home' ? 'nav-link active' : 'nav-link'}}"
                   href="{{route('home')}}">Home <span class="sr-only">(corrente)</span></a>
            </li>
            <li class="nav-item">
                <a class="{{Route::currentRouteName() === 'catalogo' ? 'nav-link active' : 'nav-link'}}"
                   href="{{route('catalogo')}}">Catalogo</a>
            </li>
            @if(Auth::user() && Auth::user()->ruolo === \App\Data\Utenza::ROLE_DEVELOPER)
                <li class="nav-item">
                    <a class="{{Route::currentRouteName() === 'avviaPubblicazioneVideogioco' ? 'nav-link active' : 'nav-link'}}"
                       href="{{route('avviaPubblicazioneVideogioco')}}">Pubblica il tuo videogioco</a>
                </li>
            @endif
        </ul>
    </div>
    @if(Auth::check())
        <img width=64px height=64px src="{{route('avatar')}}" alt="avatar">

        <div class="flex-column" id="navbarCollapse">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="{{route('visualizzaProfilo')}}">{{Auth::user()->username}}</a>
            </div>
            <div class="navbar-nav mt-0">
                <a class="nav-item nav-link" href="{{route('logout')}}">Logout</a>
            </div>
        </div>
    @else
        <form method="POST" action="{{route('login')}}" class="form-inline justify-content-end">
            @csrf
            <div class="w-100 form-row">
                <label style="display: inline-block;min-width: 100px" for="username">Username</label>
                <input id="username" class="form-control mr-sm-2" type="text" name="username" placeholder="Username"
                       aria-label="Login">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
                <a href="{{route('registrazione')}}" class="btn btn-outline-success my-2 my-sm-0" type="submit">Registrati
                    a GameUp</a>
                @if ($errors->any())
                    <p class="ml-5 alert-danger">Dati non corretti!</p>
                @endif

            </div>
            <div class="w-100 form-row">
                <label style="display: inline-block;min-width: 100px" for="password">Password</label>
                <input id="password" class="form-control mr-sm-2" type="password" placeholder="Password"
                       name="password" aria-label="Password">
                <a href="{{route('recuperoPassword')}}" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Ho
                    dimenticato la password</a>
            </div>
        </form>
    @endif
</nav>
