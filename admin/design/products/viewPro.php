<a class="btn btn-primary" href="?action=add">Add Product</a>
<br>
<br>
<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Sale</th>
            <th>Img</th>
            <th>Category</th>
            <th>Controls</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include "functions/connection.php";
            
            $selectProduct = "SELECT * FROM products";
            $queryProduct = $conn -> query($selectProduct);

            foreach ($queryProduct as $product) {

        ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['sale'] ?></td>
            <td>
                <?php
                $productId = $product['id'];

                $selectImgs = "SELECT * FROM images WHERE product_id = $productId";
                $result = $conn -> query($selectImgs);
                foreach ($result as $res){

                ?>
                <img style="width:50px" src="img/<?= $res['img'] ?>">

                <?php } ?>
            </td>

            <td><?php
                $cat_id = $product['category_id'];
                $selectCatName = "SELECT * FROM categories WHERE id = $cat_id";
                $queryCatName = $conn -> query($selectCatName);
                $catName = $queryCatName -> fetch_assoc();
                echo $catName['name'];
                ?>
            </td>
            <td>
                <a class="btn btn-primary" href="?action=edit&id=<?= $product['id'] ?>">Edit</a>
                <!-- <a class="btn btn-danger" href="functions/products/deletePro.php?id=<?= $product['id'] ?>">Delete</a> -->
                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#pro<?= $product['id'] ?>">
                    Delete
                </button>

                <!-- Modal -->
                <div class="modal fade" id="pro<?= $product['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Delete <?= $product['name'] ?> ..!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a type="button" class="btn btn-primary"
                                href="functions/products/deletePro.php?id=<?= $product['id'] ?>">Confirm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>