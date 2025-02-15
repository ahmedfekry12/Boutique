<?php
include_once "functions/connection.php";

$id = $_GET['id'];

$selectPro = "SELECT * FROM products WHERE id = $id";
$queryPro = $conn -> query($selectPro);
$row = $queryPro -> fetch_assoc();

?>
<form action="functions/products/updatePro.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="form-group">
        <label for="exampleInputEmail">name</label>
        <input type="text" name="name" value="<?= $row['name'] ?>" class="form-control" id="exampleInputEmail">
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail">price</label>
        <input type="text" name="price" value="<?= $row['price'] ?>" class="form-control" id="exampleInputEmail">
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail">sale</label>
        <input type="text" name="sale" value="<?= $row['sale'] ?>" class="form-control" id="exampleInputEmail">
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail">images</label>
        <input type="file" name="images[]" value="" class="form-control" id="exampleInputEmail">
    </div>

   <div class="form-group">
        <label for="exampleInputEmail">description</label>
        <textarea name="description" class="form-control" value=""  id="exampleFormControlTextarea1" rows="3"><?= $row['description'] ?></textarea>
    </div>

    <br>

    <div class="form-group">
        <label for="exampleFormControlSelect1">category</label>
        <select name="category" class="form-control" id="exampleFormControlSelect1">
            <?php
                include_once "functions/connection.php";

                $select = "SELECT * FROM categories";
                $query = $conn -> query($select);
                foreach ($query as $cat) {
                    ?>
                <option value="<?= $cat['id']; ?>" <?= $row['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                <?= $cat['name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>