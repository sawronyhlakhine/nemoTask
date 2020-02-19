<div class="row" style="margin-top:150px;">
    <div class="col s3"></div>
    <div class="col s6">
        <h4>Login <i class="tiny material-icons">beenhere</i> nemo Task</h4>
        <?=form_open('auth/login')?>
        <?= $this->session->flashdata('login_error') ?>
        <div class="row" style="margin-bottom: 0px;">
            <div class="input-field col s12" style="margin-bottom: 0px;">
                <input id="email" type="email" name="email" class="validate">
                <label for="email">Email</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="input-field col s12" style="margin-bottom: 0px;">
                <input id="password" type="password" name="password" class="validate">
                <label for="password">Password</label>
            </div>
        </div>
        <div class="row" style="margin-bottom: 0px;">
            <div class="col s12">
                <button type="submit" class="btn waves-effect waves-light blue-grey darken-3">Login
                    <i class="material-icons left">lock_open</i>
                </button>
                <a href="<?=base_url('auth/signup')?>" class="btn-flat waves-effect waves-green">Register
                    <i class="material-icons left">verified_user</i>
                </a>
            </div>
        </div>
        <?= form_close() ?>
        
    </div>
    <div class="col s3"></div>
</div>