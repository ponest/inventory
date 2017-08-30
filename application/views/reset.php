
<form class="form-style-4" action="<?= base_url() ?>reset_password" method="post" id="reset">
    <h1><label>RESET PASSWORD FORM</label></h1>
    <label for="field1">
        <span>UserName</span> <input type="text" name="username"value="<?=  set_value('username')  ?>" />
    </label>
    <label style="text-align: center; color: red"><?= form_error('username');  ?></label>
    <label for="field2">
        <span>Previous Password</span><input type="text" name="previous_password" />
    </label>
    <label style="text-align: center; color: red"><?= form_error('previous_password');  ?></label>
    <label for="field3">
        <span>New Password</span><input type="password" name="password"/>
    </label>
    <label style="text-align: center; color: red"><?= form_error('password');  ?></label>
    <label for="field4">
        <span>Confirm Password</span><input type="password" name="confirm_password"/>
    </label>
    <label style="text-align: center; color: red"><?= form_error('confirm_password');  ?></label>

    <label>
        <span>&nbsp;</span><input type="button" value="Submit" onclick="save_reg('reset')"/>
    </label>
    <div id="error"><label><?= $status; ?></label></div>
</form>