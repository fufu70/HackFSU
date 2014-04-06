
<div id="content_frame" class="col-xs-12 col-sm-6">
    <div class="row">
        <h1>Settings</h1>
    </div>
    <div class="row">
        <form class="form-signin" action="/index.php/site/optionpassword" method="post">
              <div class="row">
                  <div class="col-xs-12 col-sm-6">
                      <h3>Change Password</h3>
                      <div class="form-group">
                          <label for="OptionForm_currentPassword" class="control-label">Current Password</label>
                          <input name= "OptionForm[currentPassword]" type="password" class="form-control" id="OptionForm_currentPassword" required>
                      </div>
                      <div class="form-group control-group">
                        <label for="OptionForm_newPasswordInputOne" class="control-label">New Password</label>
                        <input name="OptionForm[newPasswordInputOne]" type="password" class="form-control" id="OptionForm_newPasswordInputOne" required>
                      </div>
                      <div class="form-group control-group">
                        <label for="OptionForm_newPasswordInputTwo" class="control-label">Confirm Password</label>
                        <div class="controls">
                            <input name="OptionForm[newPasswordInputTwo]" type="password" class="form-control" id="OptionForm_newPasswordInputTwo"
                            data-validation-match-match="OptionForm[newPasswordInputOne]"
                            data-validation-match-message="Passwords do not match">
                            <p class="help-block"></p>
                        </div>
                      </div>
                  </div>
              </div>
              <div class="row col-xs-12">
                  <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
              </div>
        </form>
    </div>
</div>

<!-- javascript -->
<script type="text/javascript" src="<?php Yii::app()->request->baseUrl; ?>/js/site/option.js"></script>
