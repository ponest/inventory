 <div  class="main-contents" >

        <div id="choose_product" style="margin-top: -5px">
            <select id="choose" onchange=" get_selected_reg()">
                <option value="register">Register</option>
                <option value="reset">Reset Password</option>
            </select>
        </div>
        <div id="form_container">
            <form class="form-style-4" action="add_user" method="post">
                <h1> <label>REGISTER</label> </h1>
                <label for="field1">
                    <span>UserName</span><input type="text" name="username" value="<?=set_value('username')?>">
                </label>
                <label style="text-align: center; color: red" ><?= form_error('username');?></label>
                <label for="field2">
                    <span>Password</span><input type="password" name="password">
                </label>
                <label style="color: red; text-align: center"><?= form_error('password');?></label>
                <label for="field3">
                    <span>Re Enter Password</span><input type="password" name="confirm_password">
                </label>
                <label style="text-align: center; color: red"><?= form_error('confirm_password');?></label>
                <label>
                    <span>&nbsp;</span><input type="submit" value="Register"/>
                </label>
            </form>
            </div>

    </div>