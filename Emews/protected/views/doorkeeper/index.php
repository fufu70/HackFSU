<?php
    $errorMessage = DoorKeeperController::getLoginError('password');
?>
<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>

<div class="content">
    <!-- Note usage of HTML5 'required' tag to prevent form submission without first filling in fields. -->
    <form class="form-signin" action="/" method="post">
        <h1>Xeres <br><small style="float: right;">Reservation Help Desk</small></h1><br>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="DoorKeeperForm[username]" id="DoorKeeperForm_username" type="text" class="form-control" placeholder="Username" autofocus required>
        <input name="DoorKeeperForm[password]" id="DoorKeeperForm_password" type="password" class="form-control" placeholder="Password" required>
        <input name="DoorKeeperForm[rememberMe]" id="DoorKeeperForm_rememberMe" value="1" type="checkbox">
        <label for="DoorKeeperForm_rememberMe">Remember me next time</label>
            
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="yt0">Sign in</button>
        <div class="alert alert-danger <?php if($errorMessage == null) echo 'hide'; ?>" style="margin-top: 20px">
            <b>Oh snap!</b> <?php echo $errorMessage ?>
        </div>
    </form> 
</div> <!-- /container -->
