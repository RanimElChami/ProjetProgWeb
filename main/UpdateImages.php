<?php session_start(); ?>
<!DOCTYPE html>
    <head>
        <title>Update Images</title>
        <?php include('layout/Header.php')?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script>
        <link rel="stylesheet" href="css/update-tables.css"/>
    </head>

    <body>
        <?php include('layout/Menu.php'); include("../APIs/include/dbConnection.php"); ?>

        <div class="banner">
            <h2>Mis à jour des images</h2>
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
                            <th data-column-id="image_id" data-type="numeric">ID</th>
                            <th data-column-id="image">Nom de l'image</th>
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

        <script type="text/javascript" language="javascript" >
            $(document).ready(function(){
                $('#add_button').click(function(){
                    $('#product_form')[0].reset();
                    $('.modal-title').text("Ajouter une image");
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
                    url: "../APIs/UpdateImagesAPIs/fetch.php",
                    formatters: {
                        "commands": function(column, row) {
                            return "<button type='button' class='btn btn-danger btn-xs delete image-btns' data-row-id='"+row.image_id+"'>Supprimer</button>";
                        },
                        "image": function(column, row) {
                            return "<image style='width:300px; height: auto; margin-left:auto; margin-right: auto; display:block;' src='./images/"+ row.image +"'>";
                        }
                    }
                });

                $(document).on("loaded.rs.jquery.bootgrid", function() {
                    productTable.find(".update").on("click", function(event) {
                        var image_id = $(this).data("row-id");
                            $.ajax({
                                url:"../APIs/UpdateImagesAPIs/fetch_single.php",
                                method:"POST",
                                data:{image_id:image_id},
                                dataType:"json",
                                success:function(data) {
                                    $('#productModal').modal('show');
                                    $('#image').val(data.image);
                                    $('#image_id').val(data.image_id);
                                    $('.modal-title').text("Mofidier Image");
                                    $('#action').val("Edit");
                                    $('#operation').val("Edit");
                                }
                            });
                    });
                });

                $(document).on("loaded.rs.jquery.bootgrid", function(){
                    productTable.find(".delete").on("click", function(event) {
                        if(confirm("Êtes vous sûrs vous voulez supprimer ce livre?")) {
                            var image_id = $(this).data("row-id");
                            $.ajax({
                                url:"../APIs/UpdateImagesAPIs/delete.php",
                                method:"POST",
                                data:{image_id:image_id},
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

        <div id="productModal" class="modal fade">
            <div class="modal-dialog">
                <form enctype="multipart/form-data" action="../APIs/UpdateImagesAPIs/insert.php" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ajouter une nouvelle image</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
                        <input type="file" name="image" id="image" />
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="upload" value="Envoyer" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
