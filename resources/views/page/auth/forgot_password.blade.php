<section class="min-vh-100 min-vw-100" style="background-color: #eee;">
    <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-4 mx-md-3">

                                <div class="text-center">
                                    <img src="{{asset('modules/gate-core/images/lotus.webp')}}"
                      style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-3 pb-1">Register to system</h4>
                                </div>

                                <form  wire:submit.prevent="DoWork()">
                                    <p>Please register to your account</p>

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="px-3 m-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    <div class="form-outline mb-2">
                                        <input type="email" id="formEmail" class="form-control"
                                            wire:model="email"
                                            placeholder="email address" />
                                        <label class="form-label" for="formEmail">Email address</label>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <input type="text" id="formYourName" class="form-control"
                                        wire:model="name"
                                            placeholder="Your name" />
                                        <label class="form-label" for="formYourName">Your name</label>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <input type="password" id="formPassword"
                                        wire:model="password"
                                        placeholder="password" class="form-control" />
                                        <label class="form-label" for="formPassword">Password</label>
                                    </div>

                                    <div class="text-center pt-1 mb-2 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                            type="submit">Register</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Do have an account?</p>
                                        <a href="{{route('core.login')}}" class="btn btn-outline-danger">Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center"
                            style="background: #fccb90;background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
              background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4 text-center">{{ get_option('page_message_register_title', 'Welcome to GateGem System') }}
                                </h4>
                                <p class="small mb-0">{{ get_option('page_message_register_content') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
