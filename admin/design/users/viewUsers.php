<button class="btn btn-primary" data-toggle="modal" data-target="#modal">Add User</button>

 <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="container">
                        <form class="addInfo">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputUsername">username</label>
                                    <input type="text" name="username" value="" class="form-control" id="exampleInputUsername">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword">password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">email address</label>
                                <input type="email" name="email" value="" class="form-control" id="exampleInputEmail">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputAddress">address</label>
                                <input type="text" name="address" value="" class="form-control" id="exampleInputAddress">
                            </div>
                            <div class="form-row">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="0">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
    
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="1">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" placeholder="Insert">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        // if (isset($_SESSION['error_type'])) {
        // echo $_SESSION['error_type'];
        // unset($_SESSION['error_type']);
        // }
    ?>
<br>
<br>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Privliges</th>
            <th>Controls</th>
        </tr>
    </thead>
    <tbody class="userTable">
            <?php
            include_once "getUsers.php";
            ?>
    </tbody>
</table>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <form class="editInfo">
                    <input type="hidden" name="id" id="editUserId">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editUsername">Username</label>
                            <input type="text" name="username" class="form-control" id="editUsername" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="editPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email Address</label>
                        <input type="email" name="email" class="form-control" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="editAddress">Address</label>
                        <input type="text" name="address" class="form-control" id="editAddress" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Gender</label><br>
                            <input type="radio" name="gender" id="editGenderMale" value="0"> Male
                            <input type="radio" name="gender" id="editGenderFemale" value="1"> Female
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editPrivliges">Privileges</label>
                        <select name="priv" class="form-control" id="editPrivileges">
                            <?php
                                $queryPriv = "SELECT * FROM privliges";
                                $resultPriv = $conn->query($queryPriv);
                                foreach ($resultPriv as $priv) {
                                    echo "<option value='{$priv['id']}'>{$priv['priv_name']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>