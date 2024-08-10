<div class="content-edit-user">
    <div class="container">
        <h1>Edit Profile <img src="./img/users/icons/edit.svg" alt="" style="filter: brightness(0);" width="40"></h1>
        <div class="card mx-1 py-2">
            <div class="card-body">
                <div class="row mx-1">
                    <div class="col col-lg-4">
                        <div class="">
                            <div class="img-parrent">
                                <div id="profile-image-container">
                                    <form class="form" action="" enctype="multipart/form-data" method="post" id="editImage">
                                        <input type="hidden" name="id" value="<?= $data['user']['id_tmuld'] ?>">
                                        <div class="upload">
                                            <a href="<?= BASEURL ?>/img/users/profile/<?= $data['user']['img_tmuld'] ?>"data-lightbox="image-<?= $data['user']['id_tmuld'] ?>">
                                            <img src="<?= BASEURL ?>/img/users/profile/<?= $data['user']['img_tmuld'] ?>" id="image"></a>
                                            <div class="rightRound" id="upload">
                                                <input type="file" name="fileImg" id="fileImg" accept=".jpg, .jpeg, .png">
                                                <i class="bi bi-image"></i>
                                            </div>

                                            <div class="leftRound" id="cancel" style="display: none;">
                                                <i class="bi bi-x-circle"></i>
                                            </div>
                                            <div class="leftRound" id="hapus" data-id="<?= $data['user']['id_tmuld'] ?>" style="display: block;">
                                                <i class="bi bi-trash3"></i>
                                            </div>
                                            <div class="rightRound" id="confirm" style="display: none;">
                                                <input type="submit">
                                                <i class="bi bi-check-lg"></i>
                                            </div>
                                        </div>
                                    </form>
                                    <h3 class="mt-4 text-center"><?= $data['user']['name'] ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-8">
                        <form action="<?= BASEURL ?>/user/edit" method="post" id="form_edit_profile_user">
                            <input type="hidden" name="id_edit_user" id="id_edit_user" value="<?= $data['user']['id_tmuld'] ?>">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="name_edit_user">Name </label>
                                    <input class="form-control" type="text" name="name_edit_user" id="name_edit_user" value="<?= $data['user']['name'] ?>">
                                </div>
                                <div class="form-group col">
                                    <label for="username_edit_user">Username </label>
                                    <input class="form-control" type="text" name="username_edit_user" id="username_edit_user" value="<?= $data['user']['username'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="no_hp_edit_user">Nomer Hp </label>
                                    <input class="form-control" type="number" name="no_hp_edit_user" id="no_hp_edit_user" value="<?= $data['user']['no_hp'] ?>">
                                </div>
                                <div class="form-group col">
                                    <label for="email">Email </label>
                                    <input class="form-control" type="email" name="email_edit_user" id="email_edit_user" value="<?= $data['user']['email'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="password_edit_user">Old Password </label>
                                    <input class="form-control" type="password" name="old_password_edit_user" id="old_password_edit_user">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="new-passowrd_edit_user">New Passowrd </label>
                                    <input class="form-control" type="password" name="new-passowrd_edit_user" id="new-passowrd_edit_user">
                                </div>
                                <div class="form-group col">
                                    <label for="conf-password_edit_user">Confirm Password </label>
                                    <input class="form-control" type="password" name="conf-password_edit_user" id="conf-password_edit_user">
                                </div>
                            </div>
                            <div class="button-edit">
                                <button class="btn-edit " type="submit">Kirim <i class="bi bi-send"></i></button>
                                <button class="btn-edit-1  mx-5" type="reset">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style media="screen">
    #profile-image-container {
        align-items: center;
        justify-content: center;
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
    }

    .upload {
        width: 150px;
        position: relative;
        /* margin: auto; */
        text-align: center;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    .upload img {
        border-radius: 50%;
        border: 5px solid #DCDCDC;
        box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        width: 220px;
        height: 220px;
        border-radius: 50%;
        cursor: pointer;
        object-fit: cover;
    }

    .upload .rightRound {
        position: absolute;
        bottom: 0;
        right: 0;
        background: var(--primary1);
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .upload .leftRound {
        position: absolute;
        bottom: 0;
        left: 0;
        background: var(--danger2);
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }

    .upload .bi {
        color: white;
    }

    .upload input {
        position: absolute;
        transform: scale(2);
        opacity: 0;
    }

    .upload input::-webkit-file-upload-button,
    .upload input[type=submit] {
        cursor: pointer;
    }
</style>