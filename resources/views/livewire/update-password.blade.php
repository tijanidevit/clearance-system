<div class="auth-mai">
    <div class="auth-wrapper">
        <div class="auth-form">
            <div class="card my-5">
                <form class="card-body" wire:submit='updatePassword'>
                    <div>
                        <x-success-alert />
                    </div>
                    <div class="mb-3">
                        <input type="password" wire:model.blur='current_password' class="form-control" id="floatingInput" placeholder="Current password"/>
                        <x-error-message record='current_password' />
                    </div>
                    <div class="mb-3">
                        <input type="password" wire:model.blur='new_password' class="form-control" id="floatingInput1" placeholder="New password" />
                        <x-error-message record='new_password' />
                    </div>
                    <div class="mb-3">
                        <input type="password" wire:model.blur='new_password_confirmation' class="form-control" id="floatingInput1" placeholder="Confirm new password" />
                        <x-error-message record='new_password_confirmation' />
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Update password <x-loading /></button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
