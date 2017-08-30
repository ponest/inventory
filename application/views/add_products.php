
        <div  class="main-contents" >
            <div id="choose_product" style="margin-top: -5px">
                <select id="choose" onchange="get_selected_form()" name="select_sales">
                    <option value="new product">New Product</option>
                    <option value="existing product" >Existing Product</option>
                    </select>
                </div>

            <div id="form_container" class="section">
                <div id="new_product_form">
                    <div id="form_dispay">
                        <form action="product" class="form-style-4" method="post" id="new_product">
                            <input type="hidden" name="selected_product" id="selected_product" value="new product"/>
                            <label><h1 style="font-size: 20px; text-align: center; margin-bottom: 30px">NEW PRODUCT FORM</h1></label>
                            <label>
                                <span>Choose Category</span>
                                <select name="product_categories">
                                    <option value="Addo">Addo Products</option>
                                    <option value="Cosmetics">Cosmetics Products</option>
                                </select>
                            </label>

                            <label for="field1" >
                                <span>Product Name</span><input type="text" name="product_name" value="<?=  set_value('product_name') ?>" >
                            </label>
                            <label for="field3">
                                <span>Buying Price</span><input type="text" name="buying_price" value="<?=  set_value('buying_price') ?>">
                            </label>
                            <label for="field4">
                                <span>Selling Price</span><input type="text" name="selling_price" value="<?=  set_value('selling_price') ?>">
                            </label>
                            <label for="field2">
                                <span>Amount Purchased</span><input type="text" name="amount" value="<?=  set_value('amount') ?>">
                            </label>
                            <label>
                                <span>&nbsp;</span><input type="submit" value="Submit"/>
                            </label>
                        </form>
                    </div>
                </div>
            </div>

        </div>