<div class="auth-main v1">
    <div class="auth-wrapper">
        <div class="auth-form">
            <div class="card my-5">
                <form class="card-body" wire:submit='login'>
                    <div class="text-center">
                        <img src="/assets/images/logo-dark.png" style="width: 100px" alt="images"
                            class="img-fluid mb-3" />
                        <h4 class="f-w-500 mb-1">Login</h4>
                    </div>
                    <div class="mb-3">
                        <input type="email" wire:model.blur='email' class="form-control" id="floatingInput" placeholder="Email Address" />
                        <x-error-message record='email' />
                    </div>
                    <div class="mb-3">
                        <input type="password" wire:model.blur='password' class="form-control" id="floatingInput1" placeholder="Password" />
                        <x-error-message record='password' />
                    </div>
                    <div class="d-flex mt-1 justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                                checked="" />
                            <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Login <x-loading /></button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
