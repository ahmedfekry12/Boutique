<?php
include_once "functions/connection.php";


$query = "SELECT * FROM users";
$result = $conn->query($query);

foreach ($result as $user) {
    ?>
    <tr id='userInfo_<?= $user['id'] ?>'>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['address'] ?></td>
            <td><?= $user['gender'] == 0 ? 'Male' : 'Female'?></td>
            <td>
                <?php
                    $userId = $user['priv'];
                    $privQuery = "SELECT * FROM privliges WHERE id = $userId";
                    $privResult = $conn->query($privQuery);
                    $priv = $privResult->fetch_assoc();
                    echo $priv['priv_name'];
                ?>
            </td>
            <td>
                <button class='btn btn-primary editUser' data-id='<?= $user['id'] ?>' data-username='<?= $user['username'] ?>' data-email='<?= $user['email'] ?>' data-address='<?= $user['address'] ?>' data-gender='<?= $user['gender'] ?>' data-priv='<?= $user['priv'] ?>' data-toggle='modal' data-target="#editModal">Edit</button>
                <button type='submit' data-toggle='modal' data-target="#modal<?= $user['id'] ?>" class='btn btn-danger' data-id='<?= $user['id'] ?>'>Delete</button>
                
                <!-- Modal -->
                <div class="modal fade" id="modal<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                Are You Sure You Want To Delete <?= $user['username'] ?> ..!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger deleteUser" data-id="<?= $user['id'] ?>">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <?php
            }
        ?>
