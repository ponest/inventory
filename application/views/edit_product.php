<div  class="main-contents" >
<div id="section">
    <form action="edit_form" class="form-style-4" method="post">
        <h1 style="font-size: 24px"><label>Edit Product</label></h1>
        <span><?= form_error("product_name");   ?></span>
        <label>
        <span>Product Name</span><input type="text" name="product_name" class="input-value" placeholder="Product Name" value="<?= $records[0]->Product_name?>" >
        </label>
        <span><?= form_error("buying_price");   ?></span>
        <label>
        <span>Buying Price</span><input type="text" name="buying_price" class="input-value" placeholder="Buying Price" value="<?= $records[0]->Buying_price ?>">
        </label>
        <span><?= form_error("selling_price");   ?></span>
        <label>
            <span>Selling Price</span><input type="text" name="selling_price" class="input-value" placeholder="Selling Price" value="<?= $records[0]->Selling_price?>">
        </label>
        <label><input type="submit" value="SUBMIT" class="submit"> </label>
    </form>
</div>
</div>