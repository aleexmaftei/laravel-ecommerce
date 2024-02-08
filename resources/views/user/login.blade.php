@extends("layout.layout")
@vite("resources/sass/user.scss")

@section("body-content")
    <div class="container register-page d-flex justify-content-center">
        <div class="panel-register">
            <div class="panel-title d-flex justify-content-center">
                <h2 class="title">Login</h2>
            </div>

            <p class="d-flex justify-content-center info-text">Please complete the form below to login</p>
            <hr/>

            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route("user.login") }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="w-100">
                            <span>Email</span>
                            <input class="form-control" type="email" name="email" value="{{ old("email") }}"/>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="password" class="w-100">
                            <span>Password</span>
                            <input class="form-control" type="password" name="password" value="{{ old("password") }}"/>
                        </label>
                    </div>

                    <hr/>

                    <div class="form-group d-flex justify-content-center align-items-center">
                        <input type="submit" value="Login" class="btn btn-primary"/>
                        <a href="{{ route("user.create") }}" class="btn btn-secondary">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
