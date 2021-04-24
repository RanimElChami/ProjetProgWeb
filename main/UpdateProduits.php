<?php include('../APIs/GetAllCategories.php'); session_start(); ?>
<!DOCTYPE html>
    <head>
        <title>Update Produits</title>
        <?php include('layout/Header.php')?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script>
        <link rel="stylesheet" href="css/update-tables.css"/>
    </head>

    <body>
        <?php include('layout/Menu.php'); ?>

        <div class="banner">
            <h2>Mis à jour des produits</h2>
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="10vw" viewBox="0 0 1280 140" preserveAspectRatio="none">
                <g fill="#ffffff">
                    <path d="M1280 3.4C1050.59 18 1019.4 84.89 734.42 84.89c-320 0-320-84.3-640-84.3C59.4.59 28.2 1.6 0 3.4V140h1280z" fill-opacity=".3"/>
                    <path d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V140H0z" fill-opacity=".5"/>
                    <path d="M1280 51.76c-201 12.49-242.43 53.4-513.58 53.4-320 0-320-57-640-57-48.85.01-90.21 1.35-126.42 3.6V140h1280z"/>
                </g>
            </svg>
        </div>

        <section>
            <div class="box">
                <div align="right">
                    <button type="button" id="add_button" data-toggle="modal" data-target="#productModal" class="btn btn-dark">Add</button>
                </div>
                <div class="table-responsive">
                    <table id="product_data" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th data-column-id="product_id" data-type="numeric">ID</th>
                            <th data-column-id="product_name">Nom Produit</th>
                            <th data-column-id="category_name">Catégorie</th>
                            <th data-column-id="description">Description</th>
                            <th data-column-id="quant_available">Disponibilité</th>
                            <th data-column-id="price">Prix</th>
                            <th data-column-id="image" data-formatter="image" data-sortable="false" data-header-css-class="cbg-header-image">Image</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false">Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>

        <?php include('layout/Footer.php'); ?>

        <?php include('layout/BodyLinks.php'); ?>


        <div id="productModal" class="modal fade">
            <div class="modal-dialog">
                <form method="post" id="product_form">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ajouter un nouveau produit</h4>
                    </div>
                    <div class="modal-body">
                        <label>Nom du produit</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" />
                        <br />

                        <label>Quantité Disponible</label>
                        <input type="number" name="quant_available" id="quant_available" class="form-control" />
                        <br />

                        <label>Description</label>
                        <input type="text" name="description" id="description" class="form-control" />
                        <br />

                        <label>Prix du produit</label>
                        <input type="number" step="any" name="price" id="price" class="form-control" />
                        <br/>

                        <label>Choisir une catégorie</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Choisir une catégorie</option>
                            <?php echo $output; ?>
                        </select>
                        <br />

                        <label>Image du produit</label>
                        <select id="image_id" class="form-control" required name="image_id">
                            <option>Image</option>
                                <?php
                                    $query = "SELECT * FROM images";
                                    $result = mysqli_query($conn, $query);

                                    while($row = mysqli_fetch_array($result)){
                                        echo '<option value="'.$row["image_id"].'"'.'>'.$row["image"].'</option>';
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="product_id" id="product_id" />
                        <input type="hidden" name="operation" id="operation" />
                        <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    </div>
                </form>
            </div>
        </div>

        <script type="text/javascript" language="javascript" >
            $(document).ready(function(){
                $('#add_button').click(function(){
                    $('#product_form')[0].reset();
                    $('.modal-title').text("Ajouter un nouveau produit");
                    $('#action').val("Add");
                    $('#operation').val("Add");
                });

                var productTable = $('#product_data').bootgrid({
                    ajax: true,
                    rowSelect: true,
                    post: function() {
                        return{
                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                        };
                    },
                    url: "../APIs/UpdateProduitsAPIs/fetch.php",
                    formatters: {
                        "commands": function(column, row) {
                            return "<button type='button' class='btn btn-warning btn-xs update' data-row-id='"+row.product_id+"'>Modifier</button>" +
                            "<button type='button' class='btn btn-danger btn-xs delete' data-row-id='"+row.product_id+"'>Supprimer</button>";
                        },
                        "image": function(column, row) {
                            return "<image style='width:150px; height: auto; margin-left:auto; margin-right: auto; display:block;' src='./images/"+ row.image +"'>";
                        }
                    }
                });

                $(document).on('submit', '#product_form', function(event){
                    event.preventDefault();
                    var category_id = $('#category_id').val();
                    var product_name = $('#product_name').val();
                    var price = $('#price').val();
                    var description = $('#description').val();
                    var quant_available = $('#quant_available').val();
                    var image_id = $('#image_id').val();

                    var form_data = $(this).serialize();
                    if(category_id != '' && product_name != '' && price != '' && quant_available != '' && description != '' && image_id != '' && quant_available>0) {
                        $.ajax({
                            url:"../APIs/UpdateProduitsAPIs/insert.php",
                            method:"POST",
                            data:form_data,
                            success:function(data) {
                                alert(data);
                                $('#product_form')[0].reset();
                                $('#productModal').modal('hide');
                                $('#product_data').bootgrid('reload');
                            }
                        });
                    } else {
                        alert("All Fields are Required");
                    }
                });

                $(document).on("loaded.rs.jquery.bootgrid", function() {
                    productTable.find(".update").on("click", function(event) {
                        var product_id = $(this).data("row-id");
                            $.ajax({
                                url:"../APIs/UpdateProduitsAPIs/fetch_single.php",
                                method:"POST",
                                data:{product_id:product_id},
                                dataType:"json",
                                success:function(data) {
                                    $('#productModal').modal('show');
                                    $('#category_id').val(data.category_id);
                                    $('#product_name').val(data.product_name);
                                    $('#price').val(data.price);
                                    $('#description').val(data.description);
                                    $('#quant_available').val(data.quant_available);
                                    $('#image_id').val(data.image_id);
                                    $('.modal-title').text("Edit Product");
                                    $('#product_id').val(product_id);
                                    $('#action').val("Edit");
                                    $('#operation').val("Edit");
                                }
                            });
                    });
                });

                $(document).on("loaded.rs.jquery.bootgrid", function(){
                    productTable.find(".delete").on("click", function(event) {
                        if(confirm("Êtes vous sûrs vous voulez supprimer ce produit?")) {
                            var product_id = $(this).data("row-id");
                            $.ajax({
                                url:"../APIs/UpdateProduitsAPIs/delete.php",
                                method:"POST",
                                data:{product_id:product_id},
                                success:function(data) {
                                alert(data);
                                    $('#product_data').bootgrid('reload');
                                }
                            })
                        }
                        else {
                            return false;
                        }
                    });
                });
            });
        </script>
    </body>
</html>