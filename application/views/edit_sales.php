
<div  class="main-contents" >
    <div id="section">
        <form action="edit_sales_form" class="form-style-4" method="post">
            <h1><label for="editProduct">Edit Product</label></h1>
            <span><?= form_error("product_name");   ?></span>
            <label>
                <span>Product Name</span><input type="text" name="product_name" class="input-value" placeholder="Product Name" value="<?= $records[0]->Product_name?>" >
            </label>
            <span><?= form_error("amount");   ?></span>
            <label>
               <span>Amount</span> <input type="text" name="amount" class="input-value" placeholder="Amount Sold" value="<?= $records[0]->Amount_sold?>">
            </label>
            <label>
                <button type="submit" value="SUBMIT" class="submit"></button>
            </label>
        </form>
    </div>
</div>