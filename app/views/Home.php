<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <?php include APPROOT . "/views/Components/header.php"; ?>
  <link rel="stylesheet" href="<?= URLROOT ?>/template/dist/css/stylebox.css">



</head>

<body class="hold-transition layout-top-nav">

  <!-- Navbar -->
  <?php include APPROOT . "/views/Components/NavBar.php"; ?>

  <!-- /.navbar -->


  <div class="wrapper" id="pubs">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header  mx-auto" style="width: 85%;">
        <div class="container-fluid">

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

              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <!--upload photo-->
              <div class="card">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">

                      <div class="post">
                        <form class="user-block" method="post" action="<?= URLROOT ?>Pub/addPub" enctype='multipart/form-data'>
                          <img class="img-circle img-bordered-sm " src="<?= URLROOT ?>/uploads/users/<?= $data["user"]["image_profil"] ?>" alt="""">
                          <span class="username">
                            <textarea class="form-control " row="5" placeholder="Type a comment" name="contenu"></textarea><br>
                            <div class="form-group">

                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="exampleInputFile" name="pub" onchange="showImage.call(this)">
                                  <label class="custom-file-label">Choose photo</label>
                                </div><br><br>
                                <input class="btn btn-primary btn-block" type="submit" value="Add" />
                              </div>
                            </div>

                          </span>

                        </form>
                        <div class="row">
                          <div class="col-sm-12">
                            <img class="img-fluid" id="image" src="<?= URLROOT ?>/template/dist/img/photo1.png" alt="Photo" style="display: none;">
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <!--/upload photo-->
              <!-- Post -->
              <?php foreach ($data["pubs"] as $pub) : ?>
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="active tab-pane" id="activity">

                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm " src="<?= URLROOT ?>/uploads/users/<?= $pub["image_profil"] ?>" alt="">
                            <span class="username">
                              <a href="#"><?=$pub["fullname"]?></a>
                              <a href="#" class="float-right btn-tool" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="#" class="dropdown-item">
                                  <!-- item -->
                                  <div class="media" id="addClass">
                                    <div class="media-body">
                                      <h3 class="dropdown-item-title">
                                        Delete
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
                                      <i class="fas fa-trash delete" style="cursor:pointer" data-id="<?= $comment["id_commentaire"] ?>"></i>
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
              <?php endforeach; ?>
              <!-- /.post -->
            </div>

            <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-3">
              <?php foreach($data["suggests"] as $suggest):?>
                <div class="card"  id="suggest<?=$suggest["id_utilisateur"]?>">
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane">

                          <!-- addf -->
                          <div class="nearby-user">
                            <div class="row">
                              <div class="text-center col-md-4 ">
                                <img class="profile-user-img img-fluid img-circle" src="<?= URLROOT ?>/uploads/users/<?=$suggest["image_profil"]?>"  style="width:108px;height:108px;">
                              </div>
                              <div class="col-md-7 col-sm-7">
                                <h5><a href="<?=URLROOT?>User/profile/<?=crypt_var($suggest["id_utilisateur"])?>" class="profile-link"><?=$suggest["fullname"]?></a></h5>
                                <p><?=$suggest["apropos"]?></p>
                                <p class="text-muted">500m away</p>
                              </div>
                              <a  class="btn btn-primary btn-block send" data-idr="<?=$suggest["id_utilisateur"]?>"><b>Add friend</b></a>
                            </div>
                          </div>
                          <!-- /.addf -->


                        </div>
                      </div>
                    </div>
                  </div>
                
                  <?php endforeach;?>
                </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <aside id="sidebar_secondary" class="tabbed_sidebar ng-scope chat_sidebar" style="  background-color:rgb(255, 255, 255);">

        <div class="popup-head bg-primary">
          <div class="popup-head-left pull-left ">
            <a>
              <img class="md-user-image" alt="Gurdeep Osahan (Web Designer)" src="https://bootdey.com/img/Content/avatar/avatar1.png">
              <h1>Gurdeep Osahan</h1>
            </a>
          </div>
          <div class="popup-head-right pull-right">
            <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button">
              <i class="fas fa-times"></i>
            </button>
          </div>

        </div>

        <div id="chat" class="chat_box_wrapper chat_box_small chat_box_active" style="opacity: 1; display: block; transform: translateX(0px); background-color:rgb(255, 255, 255);">
          <div class="chat_box touchscroll chat_box_colors_a">
            <div class="chat_message_wrapper ">
              <div class="chat_user_avatar">
                <a href="https://web.facebook.com/iamgurdeeposahan" target="_blank">
                  <img alt="Gurdeep Osahan (Web Designer)" title="Gurdeep Osahan (Web Designer)" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="md-user-image">
                </a>
              </div>
              <ul class="chat_message">
                <li>
                  <p> Ash ban lik real et paris </p>
                </li>
              </ul>
            </div>
            <div class="chat_message_wrapper chat_message_right">
              <div class="chat_user_avatar">
                <a href="https://web.facebook.com/iamgurdeeposahan" target="_blank">
                  <img alt="Gurdeep Osahan (Web Designer)" title="Gurdeep Osahan (Web Designer)" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="md-user-image">
                </a>
              </div>
              <ul class="chat_message">
                <li>
                  <p>
                    chi 4-0
                    <span class="chat_message_time">13:34</span>
                  </p>
                </li>
              </ul>
            </div>


          </div>
        </div>

        <div class="chat_submit_box">
          <div class="row">

            <input type="text" placeholder="Type a message" id="submit_message" name="submit_message" class="col-10">
            <span style="vertical-align: sub;" class="uk-input-group-addon">
              <button class="btn btn-primary">
                <i class="far fa-paper-plane"></i>
              </button>

            </span>

          </div>
        </div>
      </aside>

    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include APPROOT . "/views/Components/footer.php"; ?>

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <?php include APPROOT . "/views/Components/scripts.php"; ?>

  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>

</body>


</html>