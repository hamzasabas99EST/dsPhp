<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <?php include APPROOT . "/views/Components/header.php"; ?>
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include APPROOT . "/views/Components/NavBar.php"; ?>

    <!-- /.navbar -->




    <!-- Main content -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header  mx-auto" style="width: 85%;">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Profile</h1>
            </div>
            <div class="col-sm-6">

              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User Profile</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content  mx-auto" style="width: 85%;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="<?= URLROOT ?>/uploads/users/<?= $data["user"]["image_profil"] ?>" style="width:128px;height:128px;">
                  </div>

                  <h3 class="profile-username text-center" id="fullname"><?= $data["user"]["fullname"] ?></h3>

                  <p class="text-muted text-center"><?= $data["user"]["apropos"] ?></p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>invitations</b> <a class="float-right"><?= $data["statistique"]["invitations"] ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>likes</b> <a class="float-right"><?= $data["statistique"]["likes"] ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>Nombre of pubs</b> <a class="float-right"><?= $data["user"]["pubs"] ?></a>
                    </li>
                    <li class="list-group-item">
                      <b>friends</b> <a class="float-right"><?= $data["statistique"]["friends"] ?></a>
                    </li>
                  </ul>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- About Me Box -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <strong><i class="fa-regular fa-calendar-days"></i> Age</strong>

                  <p class="text-muted">
                    <?= yearsBetween($data["user"]["Date_naissance"]) ?> old
                  </p>

                  <hr>
                  <strong><i class="fa-regular fa-venus-mars"></i> Gender</strong>

                  <p class="text-muted">
                    <?= $data["user"]["Sexe"] ?>
                  </p>

                  <hr>
                  <strong><i class="fas fa-book mr-1"></i> Education</strong>

                  <p class="text-muted">
                    <?= $data["user"]["education"] ?>
                  </p>

                  <hr>

                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                  <p class="text-muted"><?= $data["user"]["location"] ?></p>

                  <hr>

                  <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                  <p class="text-muted">
                    <?= $data["user"]["skills"] ?>
                  </p>

                  <hr>

                  <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                  <p class="text-muted"><?= $data["user"]["notes"] ?></p>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-7">

              <!-- Post -->
              <?php if(count($data["pubs"])!=0){ foreach ($data["pubs"] as $pub) : ?>
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">

                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm " src="<?= URLROOT ?>/uploads/users/<?= $pub["image_profil"] ?>" alt="">
                            <span class="username">
                              <a href="#"><?= $pub["fullname"] ?></a>
                              <a href="#" class="float-right btn-tool" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="#" class="dropdown-item">
                                  <!-- item -->
                                  <div class="media" id="addClass">
                                    <div class="media-body">
                                      <h3 class="dropdown-item-title">
                                        Brad Diesel
                                      </h3>
                                    </div>
                                  </div>
                                  <!-- /item -->
                                </a>
                              </div>
                            </span>
                            <span class="description"><?= convertDateToFormat($pub["Date_ajout"]) ?></span>
                          </div>
                          <!-- /.user-block -->
                          <div class="row ">
                          <p><?=$pub["contenu_text"]?></p>
                           <div class="col-sm-12">
                             <?php if(in_array(substr($pub["image"],-3),$data["ext"])){?>
                                <img class="img-fluid" src="<?= URLROOT ?>uploads/pubs/<?= $pub["image"] ?>" alt="Photo" style="width:100%; height:500px">
                            <?php }else {?>
                                <video style="width:100%" height="500" controls>
                                    <source src="<?= URLROOT ?>uploads/pubs/<?= $pub["image"] ?>"  type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                  Your browser does not support the video tag.
                                  </video>
                              <?php }?>
                              </div>
                           
                            <!-- /.col -->

                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                          <p class="likes" id="<?= $pub["id_publication"] ?>" style="cursor:pointer">
                            <i class="far fa-thumbs-up mr-1"></i> <span><?= $pub["likes"] ?></span>

                          </p>
                          <div class="card-footer card-comments" id="comment_div<?= $pub["id_publication"] ?>">
                            <?php foreach ($data["comments"] as $comment) :
                              if ($comment["id_publication"] == $pub["id_publication"]) {

                            ?>
                                <div class="card-comment" id="<?= $comment["id_commentaire"] ?>">
                                  <!-- "" -->
                                  <img class="img-circle img-sm" src="<?= URLROOT ?>uploads/users/<?= $comment["image_profil"] ?>" alt="""">

                                  <div class="comment-text">
                                    <span class="username">
                                      <?= $comment["fullname"] ?>

                                      <span class="text-muted float-right"><?= convertDateToFormat($comment["date_commentaire"]) ?> 
                                        <?php if($comment["id_utilisateur"]==$data["user"]["id_utilisateur"]):?>
                                          <i class="fas fa-trash delete" style="cursor:pointer" data-id="<?= $comment["id_commentaire"] ?>">
                                          </i>
                                        <?php endif;?>
                                      </span>
                                    </span><!-- /.username -->
                                    <?= $comment["contenu"] ?>
                                  </div>
                                  <!-- /.comment-text -->
                                </div>
                            <?php }
                            endforeach; ?>
                            <!-- /.card-comment -->
                            <!-- /.card-comment -->
                          </div>
                          <!-- /.card-footer -->
                          <div class="card-footer">
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <img class="img-fluid img-circle img-sm" src="<?= URLROOT ?>/uploads/users/<?= $data["user"]["image_profil"] ?>" id="<? ?>" alt="Alt Text">
                            <div class="img-push">
                              <input type="text" class="form-control form-control-sm comments " data-id="<?= $pub["id_publication"] ?>" data-img="<?= $data["user"]["image_profil"] ?>" placeholder="Press enter to post comment" name="contenu" id="contenu">
                            </div>

                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; }?>
                 
              <!-- /.post -->
            </div>

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->





    <!-- Main Footer -->
    <?php include APPROOT . "/views/Components/footer.php"; ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <?php include APPROOT . "/views/Components/scripts.php"; ?>

</body>

</html>