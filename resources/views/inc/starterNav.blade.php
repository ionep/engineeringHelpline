<nav class='navbar' id='startnav'>
    <div class='container'>
        
        <div class="navbar-header">
            <!-- brand text -->
            <a class="navbar-brand" href="{{ url('/') }}">Welcome Engineers</a>
        </div>
        
        <!-- right parts -->
        <div class='nav navbar-nav navbar-right'>
            <form class='form-inline' method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class='form-row'>
                    <div class="col form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        
                    </div>

                    <div class="col form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group col">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                </div>

                <!-- show error message if incorrect credentials -->
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <div class='form-row'>
                    <div class='col-md-1'></div>
                    <div class="col-md-4 form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <a id='forgotPw' class="btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</nav>