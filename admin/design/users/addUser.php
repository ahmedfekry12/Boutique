<form action="functions/users/insertUser.php" method="post">
    <div class="form-group">
        <label for="exampleInputEmail">username</label>
        <input type="text" name="username" value="" class="form-control" id="exampleInputEmail">
    </div>
    <?php
        // if (isset($_SESSION['name-error'])) {
        //     echo $_SESSION['name-error'];
        //     unset($_SESSION['name-error']);
        // }
    ?>
    <div class="form-group">
        <label for="exampleInputEmail">password</label>
        <input type="password" name="password" class="form-control" id="exampleInputEmail">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail">email address</label>
        <input type="email" name="email" value="" class="form-control" id="exampleInputEmail">
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="0">
        <label class="form-check-label" for="inlineRadio1">Male</label>
    </div>
    
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="1">
        <label class="form-check-label" for="inlineRadio2">Female</label>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail">address</label>
        <input type="text" name="address" value="" class="form-control" id="exampleInputEmail">
    </div>
    <br>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Privliges</label>
        <select name="priv" class="form-control" id="exampleFormControlSelect1">
            
        <?php

            include "functions/connection.php";

            $queryPriv = "SELECT * FROM privliges";
            $resultPriv = $conn->query($queryPriv);

            foreach ($resultPriv as $newPriv){

            ?>
            <option value="<?= $newPriv['id'] ?>"><?= $newPriv['priv_name'] ?></option>
                
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>