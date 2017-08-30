 <div  class="main-contents">
     <div class="row">
         <div class="col-md-6">
             <h2>View Product List</h2>
         </div>
         <div class="col-md-6">
             <a href="add_products"><button class="btn btn-info btn-sm pull-right add-product" ><i class="fa fa-lg fa-plus-circle"></i> Add Product</button></a>
         </div>
     </div>    <hr class="hr-product"/>
    <div class="row">
        <table class="table table-bordered table-responsive table-condensed" id="myData">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Amount</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>Product Name</th>
                <th>Amount</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </tfoot>


            <?php
            if(count($records) > 0){
                foreach ($records as $row): ?>
                    <tbody>
                    <tr>
                        <td><?=  $row->Product_name  ?></td>
                        <td><?=  $row->Amount ?></td>
                        <td><?= $row->Buying_price ?></td>
                        <td><?= $row->Selling_price ?></td>
                        <form action='edit' method='GET'>
                            <input type='hidden' name='id' value='<?php echo $row->Id ;  ?>'>
                            <td><button class="btn btn-sm btn-info" type='submit'><i class="fa fa-lg fa-edit"></i> Edit</button></td>
                        </form>
                        <form action='delete' method='GET'>
                            <input type='hidden' name='id' value='<?php echo $row->Id ;  ?>'>
                            <td><button type='submit' class="btn btn-sm btn-info"><i class="fa fa-lg fa-trash-o"></i> Delete</button></td>
                        </form>
                    </tr>
                    </tbody>

                <?php  endforeach; } ?>
        </table>

    </div>

</div>

