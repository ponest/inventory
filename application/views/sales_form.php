 <div  class="main-contents" >
                <div id="choose_product">
                    <select id="choose" onchange="get_selected_sales()" name="select">
                        <option value="addo">ADDO</option>
                        <option value="cosmetics">COSMETICS</option>
                    </select>
                </div>
                <div id="sell_display" >
                    <form class="form-style-4" action="Addo_sales_action" method="post" id="addo">
                       <h1> <label>ADDO SALES FORM</label> </h1>
                        <label for="field1">
                            <span>Product Name</span><input type="text" name="product_name">
                        </label>
                        <label for="field2">
                            <span>Quantity Sold</span><input type="text" name="quantity_sold">
                        </label>
                        <label>
                            <span>&nbsp;</span><input type="submit" value="Submit" />
                        </label>
                    </form>
                </div>

            </div>
