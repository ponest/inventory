<section class="form_type_2">
    <form class="form-style-4" action="add_user" method="post" id="reg">
        <h1> <label>REGISTER</label> </h1>
        <label for="field1">
            <span>UserName</span><input type="text" name="username" value="<?=set_value('username')?>">
        </label>
        <label style="text-align: center;color: red"><?= form_error('username');?></label>
        <label for="field2">
            <span>Password</span><input type="password" name="password">
        </label>
        <label style="text-align: center;color: red"><?= form_error('password');?></label>
        <label for="field3">
            <span>Re Enter Password</span><input type="password" name="confirm_password">
        </label>
        <label style="text-align: center;color: red"><?= form_error('confirm_password');?></label>
        <label>
            <span>&nbsp;</span><input type="button" value="Register" onclick="save_reg('reg')" />
        </label>

    </form>
</section>
