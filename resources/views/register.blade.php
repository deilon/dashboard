@include('head')

<div id="register">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="p-5">
                    <h2 class="mb-3">Create an account</h2>
                    <form>
                        <div class="row mb-3">
                            <div class="col">
                              <label for="firstname" class="form-label">First name</label>
                              <input type="text" class="form-control" id="firstname" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col">
                              <label for="lastname" class="form-label">Last name</label>
                              <input type="text" class="form-control" id="lastname" placeholder="Last name" aria-label="Last name">
                            </div>
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email address</label>
                          <input type="email" class="form-control" id="email" placeholder="Email address" aria-describedby="emailHelp">
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="mb-3">
                          <label for="password2" class="form-label">Repeat Password</label>
                          <input type="password" class="form-control" id="password2" placeholder="Repeat password">
                        </div>
                        <button type="submit" class="btn btn-success">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')