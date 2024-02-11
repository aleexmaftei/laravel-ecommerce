<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{ route("home") }}" class="navbar-brand">{{ config("app.name", "eCommerce") }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest()
                        <li class="nav-item">
                            <a href="{{ route("user.login") }}" class="nav-link">Login</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route("user.create") }}" class="nav-link">Register</a>
                        </li>
                    @endguest

                    @auth("web")
                        <li class="nav-item dropdown">
                            <a class="btn nav-link icon-class"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="material-symbols-outlined">notifications</span>
                                <span
                                    class="badge bg-success badge-xs icon-number">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (auth()->user()->unreadNotifications)
                                    <li class="dropdown-item">
                                        <form method="POST" action="{{ route("notifications.mark_as_read") }}">
                                            @csrf
                                            @method('PUT')

                                            <button class="no-style-button" type="submit" href="{{ route("notifications.mark_as_read") }}">
                                                <span>Mark all as read</span>
                                            </button>
                                        </form>
                                    </li>
                                @endif
                            </ul>

                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn nav-link dropdown-toggle"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <span
                                    class="user-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li class="dropdown-item" href="{{ route("user.logout") }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </li>

                                <form id="logout-form" action="{{ route("user.logout") }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>

                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
