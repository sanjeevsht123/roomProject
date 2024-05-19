<?php

require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Panel-Users</title>

    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Users</h3>

                <!--user  Settings-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                         

                        <div class="text-end mb-4">
                            <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search...">
                        </div>
                
                        <div class="table-responsive" >
                            <table class="table table-hover border" style="min: width 1300px;">
                                <thead class="">
                                    <tr class="text-light bg-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone no.</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>  
                                        <th scope="col">Action</th> 
                                    </tr>
                                </thead>
                                <tbody id="users-data">
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!--user  Settings-->
            </div>
        </div>
    </div>


    <!--Add Room Modal -->
    <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >Add Features</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Name</label>
                                <input type="text" name="name"  class="form-control" required>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Area</label>
                                <input type="number" min="1" name="area"  class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Price</label>
                                <input type="number" min="1" name="price" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label">Quantity</label>
                                <input type="number" min="1" name="quantity"  class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label fw-bold">Adult(Max.)</label>
                                <input type="number" min="1" name="adult" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label  class="form-label fw-bold">Children</label>
                                <input type="number" min="1" name="children"  class="form-control" required>
                            </div>
                            <div class="col-12 md-3">
                                <label  class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res=selectAll('feature');
                                    while($opt=mysqli_fetch_assoc($res)){
                                        echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='features' value='$opt[id]' class='form-control-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 md-3">
                                <label  class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res=selectAll('facilities');
                                    while($opt=mysqli_fetch_assoc($res)){
                                        echo"
                                            <div class='col-md-3 mb-1'>
                                                <label>
                                                    <input type='checkbox' name='facilities' value='$opt[id]' class='form-control-input shadow-none'>
                                                    $opt[name]
                                                </label>
                                            </div>
                                        ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label  class="form-label fw-bold">Description</label>
                                <textarea name="desc"  class="form-control shadow-none" required rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancle</button>
                        <button type="submit"  class="btn custom-bg text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    <!-- Add Room Modal -->



    <?php require('inc/scripts.php'); ?>

  <script src="scripts/users.js"></script>

</body>
</html>