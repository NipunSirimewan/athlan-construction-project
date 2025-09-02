<?php
    include_once "../commons/session.php";
    include_once "../model/order_model.php";

    $userrow=$_SESSION["user"];
    $orderObj=new Order();
    $supplierResult=$orderObj->getAllSuppliers();
    $materialResult=$orderObj->getAllMaterials();
    


?>

<html>
<head>
    <title>add order</title>
        <?php
            include_once "../includes/bootstrap_css_includes.php";
        ?>

        <script>
            function BtnAdd()
            {
                var v=$("#TRow").clone().appendTo("#TBody");
                $(v).find("input").val('');
                $(v).removeClass("d-none");
            }

            function BtnDel(v)
            {
                $(v).parent().parent().remove();
                GetTotal();
            }

            function Calc(v)
            {
                var index=$(v).parent().parent().index();

                var price=document.getElementsByName("price[]")[index].value;
                var qty=document.getElementsByName("qty[]")[index].value;
                
                var amount=price*qty;
                document.getElementsByName("amount[]")[index].value=amount;

               GetTotal(); 
            }

            function GetTotal()
            {
                var sum=0;
                var amounts=document.getElementsByName("amount[]");

                for (let index=0; index<amounts.length; index++)
                {
                    var amount=amounts[index].value;
                    sum=+(sum) + +(amount);
                }
                document.getElementById("total").value=sum;
            }
        </script>
</head>
<body>
    
    <div class="container">
        <?php $pageName=""?>
        <?php include_once "../includes/header_row_includes.php";?>
        <br>
        <div>
            <div class="col-md-3">
                <ul class="list-group">
                    <a href="add_order.php" class="list-group-item">
                        <span class="glyphicon glyphicon-plus"></span> &nbsp;
                        Add Order
                    </a>
                    <br>
                    <a href="view_orders.php" class="list-group-item">
                        <span class="glyphicon glyphicon-search"></span> &nbsp;
                        View Orders
                    </a>
                    <br>
                    <a href="order_report.php" class="list-group-item">
                        <span class="glyphicon glyphicon-book"></span> &nbsp;
                        Generate Order Reports
                    </a>
                    <br>
                    <br>
                    <br>
                    <a href="dashboard.php" class="list-group-item">
                        <span class="glyphicon glyphicon-home"></span> &nbsp;
                       Dashboard 
                    </a>
                </ul>
            </div>

            <form action="../controller/order_controller.php?status=add_order" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="msg"></div>

                        <?php if(isset($_GET["msg"])){
                            ?>
                        <div class="col-md-6 col-md-offset-3 alert alert-danger">
                            <?php echo base64_decode($_GET["msg"]); ?>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    
                <div style="margin-left:130px;">

                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Order Number</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <input type="text" class="form-control" name="number" id="number" placeholder="O00001">
                        </div>
                       
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    <div class="row">
                     <div class="col-md-3">
                            <label class="control-label">Supplier Name</label>
                        </div>
                        <div class="col-md-3" style="width:350px;">
                            <select name="supplier" id="supplier" class="form-control" required="required">
                                <option value=""></option>
                                <?php
                                    while($supplier_row=$supplierResult->fetch_assoc()){
                                ?>
                                <option value="<?php echo $supplier_row["supplier_id"];?>">
                                        <?php echo $supplier_row["supplier_name"];?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>


                     <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Order Date</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <br>
                    <br>

                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Material</th>
                                <th scope="col" class="text-end">Price (Rs)</th>
                                <th scope="col" class="text-end">Qty</th>
                                <th scope="col" class="text-end">Amount (Rs)</th>
                                <th scope="col" class="NoPrint">
                                    <button type="button" class="btn btn-sm btn-success" onclick="BtnAdd()">+</button>
                                </th>
                            </tr>
                        </thead>

                        <tbody id="TBody">
                            <tr id="TRow" class="d-none">
                                <td>
                                    <div class="col-md-3" style="width:200px;">
                                        <select name="material[]" id="material" class="form-control" required="required">
                                            <option value=""></option>
                                        <?php
                                            while($material_row=$materialResult->fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $material_row["material_id"];?>">
                                            <?php echo $material_row["material_type"];?>
                                            </option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td><input type="number" class="form-control text-end" name="price[]" id="price" onchange="Calc(this);"></td>
                                <td><input type="number" class="form-control text-end" name="qty[]" id="qty" onchange="Calc(this);"></td>
                                <td><input type="number" class="form-control text-end" name="amount[]" id="amount" readonly></td>
                                <td class="NoPrint"><button type="button" class="btn btn-sm btn-danger" onclick="BtnDel(this)">x</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="col-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Total (Rs)</span>
                            <input type="number" name="total" id="total" class="form-control text-end" readonly>
                        </div>
                    
                    </div>
                    <br>
                    <br>

                    <div class="row">
                        <div class="col-md-12">&nbsp;</div>
                    </div>

                    <div class="row">
                        <div class="col-md-offset-1 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"style="margin-left:125px;"/>
                            <input type="reset" class="btn btn-danger" value="Reset" style="margin-left:5px;"/>
                        </div>            
                    </div>

                </div>

                </div>
            </form>
        </div>
    </div>

    <div>&nbsp;</div>

</body>
    <script src="../js/jquery-3.7.1.js"></script>
    <script src="../js/ordervalidation.js"></script>

    

</html>