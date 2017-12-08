<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form class="form-horizontal" action='/login' method="POST">
                <fieldset>
                    <div id="legend">
                        <legend class="">Login</legend>
                    </div>
                    <?php if (isset($viewVars['error'])) : ?>
                        <span class="warning"> <?= $viewVars['error'] ?></span>
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
                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-success">Login</button>
                            <a href="/register" class="btn btn-secondary">Register</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="col-lg-3"></div>

    </div>
</div>
