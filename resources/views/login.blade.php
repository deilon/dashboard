@include('head')

<div id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="p-5">
                    <h2 class="mb-3">Login</h2>
                    @if ($errors->has('error_login'))
                        <div class="p-3 my-3 bg-danger text-white">
                            {{ $errors->first('error_login') }}
                        </div>
                    @endif
                    <form method="POST" action="{{url('login')}}">
                        @csrf
                        <div class="mb-3">
                          <label for="email" class="form-label">Email address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email address" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')