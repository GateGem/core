<section class="min-vh-100 min-vw-100" style="background-color: #eee;">
    <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-4 mx-md-3">

                                <div class="text-center">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                      style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-3 pb-1">Login to system</h4>
                                </div>

                                <form wire:submit.prevent="DoLogin()">
                                    <p>Please login to your account</p>

                                    <div class="form-outline mb-2">
                                        <input type="email" id="formUsername" class="form-control"
                                            wire:model.defer="username"
                                            placeholder="Phone number or email address" />
                                        <label class="form-label" for="formUsername">Username</label>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <input type="password" id="formPassword" class="form-control"
                                            placeholder="Password"
                                        wire:model.defer="password"
                                         />
                                        <label class="form-label" for="formPassword">Password</label>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col d-flex justify-content-center">
                                          <!-- Checkbox -->
                                          <div class="form-check">
                                            <input class="form-check-input" wire:model="isRememberMe" type="checkbox" value="1" id="formRemember" checked="">
                                            <label class="form-check-label" for="formRemember"> Remember me </label>
                                          </div>
                                        </div>
                    
                                        <div class="col">
                                            <a class="text-muted" href="#!">Forgot password?</a>
                                        </div>
                                      </div>
                                    <div class="text-center pt-1 mb-2 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                            wire:click="DoLogin()"
                                            type="submit">Login</button>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Don't have an account?</p>
                                        <a href="{{route('core.register')}}" class="btn btn-outline-danger">Create new</a>
                                    </div>

                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center"
                            style="background: #fccb90;background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
              background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4 text-center">{{ get_option('page_message_login_title', 'Welcome to lara system') }}
                                </h4>
                                <p class="small mb-0">{{ get_option('page_message_login_content') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
