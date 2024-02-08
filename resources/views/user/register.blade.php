@extends("layout.layout")
@vite("resources/sass/user.scss")

@section("body-content")
    <div class="container register-page d-flex justify-content-center">
        <div class="panel-register">
            <div class="panel-title d-flex justify-content-center">
                <h2 class="title">Hello!</h2>
            </div>

            <p class="d-flex justify-content-center info-text">Please complete the form below to register</p>
            <hr />

            <div class="panel-body d-flex">
                <form method="POST" action="{{ route("user.store") }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="w-100">
                            <span>Email</span>
                            <input class="form-control" type="email" name="email" value="{{ old("email") }}"/>
                        </label>

                        @error("email")
                        <div class="alert alert-danger">
                            {{ $errors->first("email") }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="w-100">
                            <span>Password</span>
                            <input class="form-control" type="password" name="password" value="{{ old("password") }}"/>
                        </label>

                        @error("password")
                        <div class="alert alert-danger">
                            {{ $errors->first("password") }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <label for="first_name">
                                    <span>First name</span>
                                    <input class="form-control" type="text" name="first_name" value="{{ old("first_name") }}"/>
                                </label>

                                @error("first_name")
                                <div class="alert alert-danger">
                                    {{ $errors->first("first_name") }}
                                </div>
                                @enderror
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <label for="last_name">
                                    <span>Last name</span>
                                    <input class="form-control" type="text" name="last_name" value="{{ old("last_name") }}"/>
                                </label>

                                @error("last_name")
                                <div class="alert alert-danger">
                                    {{ $errors->first("last_name") }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="form-group d-flex justify-content-center align-items-center">
                        <input type="submit" value="Register" class="btn btn-primary" />
                        <a href="#" class="ml-5 text-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
