<div class="row" style="margin-top:150px;">
    <div class="col s3"></div>
    <div class="col s6">
        <h4>Register <i class="tiny material-icons">beenhere</i> nemo Task</h4>
        <?= form_open('auth/register') ?>
        <?= $this->session->flashdata('reg_error') ?>
        <div class="row" style="margin-bottom: 0px;">
            <div class="input-field col s12" style="margin-bottom: 0px;">
                <input id="username" type="text" name="username" class="validate" data-length="100">
                <label for="username">User Name</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 0px;">
            <div class="input-field col s12" style="margin-bottom: 0px;">
                <input id="email" type="email" name="email" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="input-field col s6" style="margin-bottom: 0px;">
                <input id="password" type="password" name="password" class="validate">
                <label for="password">Password</label>
            </div>
            <div class="input-field col s6" style="margin-bottom: 0px;">
                <input id="confirm_password" type="password" name="confirm_password" class="validate">
                <label for="confirm_password">Confirm Password</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn waves-effect waves-light blue-grey darken-3">Register
                    <i class="material-icons left">lock_open</i>
                </button>
                <a href="<?=base_url('auth')?>" class="btn-flat waves-effect waves-green">Back To Login
                    <i class="material-icons left">arrow_back</i> 
                </a>
            </div>
        </div>
        <?= form_close() ?>
        
    </div>
    <div class="col s3"></div>
</div>