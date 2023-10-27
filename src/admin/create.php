<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        use Src\Config\Head; 
        Head::tags();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/admin/css/general.css">
    <title>Photofolio</title>
</head>
<body>
    <?php include "src/admin/template/sidebar/index.html"; ?>

    <main>
        <div class="container home">
            <div class="col-12 justify-content-left">
                <div class="col-10 mr-auto py-4 ml-4">
                    <h3 class="mt-4">Create ARTS</h3>

                    <div>
                        <div class="row create-main">
                            <div class="col-12 col-lg-6">
                                <div id="message"></div>

                                <label for="file" class="label-for-image">
                                    <img src="../src/assets/img/gallery.svg" alt="" id="image"><br>
                                    <div class="btn btn-info">Select file</div>
                                </label>
                                <input type="file" name="file" id="file" class="file" onchange="selectImage(this)" accept="image/*">
                            </div>
                            <div class="col-12 col-lg-6 mt-3">
                                <div class="col-9">
                                    <input type="text" placeholder="Art name" class="form-control form" id="name">
                                    <br>
                                    <input type="text" placeholder="Price in ETH" class="form-control form" id="price">
                                    <br>
                                    <input type="text" placeholder="Username" class="form-control form" id="username">
                                    <br>
                                    <button class="btn btn-primary" onclick="create(this)">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../src/admin/js/general.js"></script>
</html>