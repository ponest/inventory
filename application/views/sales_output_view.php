
            <div  class="main-contents">
                    <div class="row">
                        <div class="col-md-4">
                           <form class="navbar-form navbar-left" method="post" action="<?= base_url() ?>specified_date">
                               <div class="form-group form-group-sm">
                                   <input type="date" name="specified_date" class="form-control" placeholder="Search Date">
                                   <button type="submit" class="btn btn-info btn-sm search-btn"  name="submit"><i class="fa fa-search"></i> Search</button>
                               </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                        <form  class="navbar-form navbar-right" action="<?= base_url() ?>interval_date" method="POST" >
                            <div class="form-group form-group-sm">
                                <input type="date" name="date1" class="form-control" placeholder="Starting Date">
                                <input type="date" name="date2" class="form-control" placeholder="End Date">
                                <button type="submit" class="btn btn-sm btn-info search-btn"  name="submit"><i class="fa fa-search"></i> Search</button>
                            </div>
                            </form>
                        </div>
                    </div>
                <hr/>
                <div class="row">

                    <div id="choose_product" >
                        <form action="<?= base_url() ?>category_sales_output" method="post">
                            <select id="choose" name="select_sales" onchange="this.form.submit()" >
                                <option value="0">Choose Category</option>
                                <option value="All Categories"  <?php echo (isset($_POST['select_sales']) && $_POST['select_sales'] == 'All Categories')?'selected="selected"':''; ?>>All Categories</option>
                                <option value="Addo" <?php echo (isset($_POST['select_sales']) && $_POST['select_sales'] == 'Addo')?'selected="selected"':''; ?>>Addo Products</option>
                                <option value="Cosmetics" <?php echo (isset($_POST['select_sales']) && $_POST['select_sales'] == 'Cosmetics')?'selected="selected"':''; ?>>Cosmetics Products</option>
                            </select>
                            <form>
                    </div>
                </div>

                <section class="myTable">

                    <table class="table table-responsive table-bordered table-hover table-condensed myTable"  id="myData">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Amount</th>
                            <th>profit</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>

                         <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Amount</th>
                            <th>profit</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>


                        <?php
                        if(count($record) > 0){
                        foreach ($record as $row):?>
                        <tbody>
                        <tr>
                            <td><?= date("d/m/Y",$row->Date)  ?></td>
                            <td><?=  $row->Product_name  ?></td>
                            <td><?= $row->Amount_sold ?></td>
                            <td><?= $row->actual_profit  ?></td>
                            <form action='<?= base_url() ?>edit_sales' method='GET'>
                                <input type='hidden' name='id' value='<?php echo $row->Id ;  ?>'>
                                <td> <button class="btn btn-info btn-sm" type='submit'><i class="fa fa-edit"></i>&nbsp; Edit</button></td>
                            </form>
                            <form action='<?= base_url() ?>delete_sales' method='GET'>
                                <input type='hidden' name='id' value='<?php echo $row->Id ;  ?>'>
                                <td><i class=""></i><button class="btn btn-info btn-sm" type='submit'><i class="fa fa-trash-o"></i>&nbsp; Delete</button></td>
                            </form>
                        </tr>


                        <?php  endforeach;}  ?>
                        <tr>
                            <td colspan='5' >Total Profit</td>
                            <td ><?= $total[0]->actual_profit;  ?></td>
                        </tr>
                        </tbody>
                    </table>

                </section>

                   <marquee> <div id="cheker" style="font-family: Cambria;font-size:20px;padding-top: 5px "><?php foreach ($check as $row)
                                                    {
                                                        $result = $row->Amount;
                                                        if($result<5){echo strtoupper($row->Product_name)." "."Is about To end Please order another Product"."<br>";}
                                                    }

                    ?></div></marquee>

            </div>

