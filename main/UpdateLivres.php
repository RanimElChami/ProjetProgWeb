<!DOCTYPE html>
    <head>
        <title>Update Livres</title>
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
            <h2>Mis à jour des livres</h2>
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
                            <th data-column-id="book_id" data-type="numeric">ID</th>
                            <th data-column-id="book_name">Nom Livre</th>
                            <th data-column-id="author">Auteur</th>
                            <th data-column-id="pub_date">Date de publication</th>
                            <th data-column-id="quant_available">Dispo</th>
                            <th data-column-id="price">Prix</th>
                            <th data-column-id="image" data-formatter="image" data-sortable="false" data-header-css-class="cbg-header-image">Image</th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
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
                    $('.modal-title').text("Ajouter un nouveau livre");
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
                    url: "../APIs/UpdateLivresAPIs/fetch.php",
                    formatters: {
                        "commands": function(column, row) {
                            return "<button type='button' class='btn btn-warning btn-xs update' data-row-id='"+row.book_id+"'>Update</button>" +
                            "<button type='button' class='btn btn-danger btn-xs delete' data-row-id='"+row.book_id+"'>Delete</button>";
                        },
                        "image": function(column, row) {
                            return "<image style='width:50%; height: auto; margin-left:auto; margin-right: auto; display:block;' src='./images/"+ row.image +"'>";
                        }
                    }
                });

                $(document).on('submit', '#product_form', function(event){
                    event.preventDefault();
                    var author = $('#author').val();
                    var book_name = $('#book_name').val();
                    var price = $('#price').val();
                    var pub_date = $('#pub_date').val();
                    var quant_available = $('#quant_available').val();
                    var image_id = $('#image_id').val();
                    var form_data = $(this).serialize();

                    if(author != '' && book_name != '' && price != '' && quant_available != '' && pub_date != '' && image_id != '') {
                        $.ajax({
                            url:"../APIs/UpdateLivresAPIs/insert.php",
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
                        var book_id = $(this).data("row-id");
                            $.ajax({
                                url:"../APIs/UpdateLivresAPIs/fetch_single.php",
                                method:"POST",
                                data:{book_id:book_id},
                                dataType:"json",
                                success:function(data) {
                                    $('#productModal').modal('show');
                                    $('#pub_date').val(data.pub_date);
                                    $('#book_name').val(data.book_name);
                                    $('#price').val(data.price);
                                    $('#author').val(data.author);
                                    $('#quant_available').val(data.quant_available);
                                    $('#image_id').val(data.image_id);
                                    $('.modal-title').text("Mofidier Livre");
                                    $('#book_id').val(book_id);
                                    $('#action').val("Edit");
                                    $('#operation').val("Edit");
                                }
                            });
                    });
                });

                $(document).on("loaded.rs.jquery.bootgrid", function(){
                    productTable.find(".delete").on("click", function(event) {
                        if(confirm("Êtes vous sûrs vous voulez supprimer ce livre?")) {
                            var book_id = $(this).data("row-id");
                            $.ajax({
                                url:"../APIs/UpdateLivresAPIs/delete.php",
                                method:"POST",
                                data:{book_id:book_id},
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
                <form method="post" id="product_form">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ajouter un nouveau produit</h4>
                </div>
                <div class="modal-body">
                    <label>Nom du livre</label>
                    <input type="text" name="book_name" id="book_name" class="form-control" />
                    <br />

                    <label>Quantité Disponible</label>
                    <input type="number" name="quant_available" id="quant_available" class="form-control" />
                    <br />

                    <label>Description</label>
                    <input type="text" name="author" id="author" class="form-control" />
                    <br />

                    <label>Date de publication</label>
                    <input type="date" name="pub_date" id="pub_date" class="form-control" />
                    <br />

                    <label>Prix du livre</label>
                    <input type="number" step="any" name="price" id="price" class="form-control" />
                    <br/>

                    <label>Image du livre</label>
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
                    <input type="hidden" name="book_id" id="book_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
