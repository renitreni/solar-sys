<div>
    <div class="vh-100 d-flex align-items-center pb-8">
        <div class="w-100">
            <div class="row justify-content-center">
                <div class="col-11 col-md-3">
                    <div class="form-signin">
                        <form wire:submit="login">
                            <img class="mb-4" src="{{ route('get-company-logo') }}" alt="" height="180">

                            <h1 class="h3 mb-3 fw-normal">Please Sign In</h1>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" wire:model="email"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>

                                @error('email')
                                    <div class="text-start text-danger ps-2">{{ $message }}</div>
                                @enderror

                                @if ($errorMessage)
                                    <div class="text-start text-danger ps-2">{{ $errorMessage }}</div>
                                @endif
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" wire:model="password"
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                    <div class="text-start text-danger ps-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div>

                            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

                            <p class="mt-5 mb-3 text-muted">© 2024</p>
                        </form>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
