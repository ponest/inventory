
<div id="existing_product_form">

    <form class="form-style-4" action="<?= base_url() ?>product1" method="post" id="existing_product">
        <input type="hidden" name="selected_product" id="selected_product" value="existing product" />
        <h1> <label>EXISTING PRODUCT FORM</label> </h1>
        <label for="field1">
            <span>Product Name</span><input type="text" name="product_name">
        </label>
        <label for="field2">
            <span>Amount Purchased</span><input type="text" name="amount" value="<?=  set_value('amount') ?>">
        </label>
        <label for="field3">
            <span>Buying Price</span><input type="text" name="buying_price" value="<?=  set_value('buying_price') ?>">
        </label>
        <label for="field4">
            <span>Selling Price</span><input type="text" name="selling_price" value="<?=  set_value('buying_price') ?>">
        </label>
        <label>
            <span>&nbsp;</span><input type="submit" value="Submit"/>
        </label>
    </form>

</div>
