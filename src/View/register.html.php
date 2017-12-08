<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form class="form-horizontal" action='/register' method="POST">
                <fieldset>
                    <div id="legend">
                        <legend class="">Register</legend>
                    </div>
                    <?php if (isset($viewVars['error'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <strong><?= $viewVars['error'] ?></strong>
                        </div>
                    <?php endif;?>
                    <?php if (isset($viewVars['success'])) : ?>
                        <div class="alert alert-success" role="alert">
                            <strong><?= $viewVars['success'] ?></strong>
                        </div>
                    <?php endif;?>
                    <div class="control-group">
                        <!-- Username -->
                        <label class="control-label"  for="username">Username</label>
                        <div class="controls">
                            <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="re_password">Retype Password</label>
                        <div class="controls">
                            <input type="password" id="re_password" name="re_password" placeholder="" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-success">Register</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-lg-3"></div>

    </div>
</div>
