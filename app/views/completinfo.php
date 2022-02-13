<!DOCTYPE html>
<html lang="en">

<head>
    <?php include APPROOT . "/views/Components/header.php"; ?>
    <!-- BS Stepper -->
    <link rel="stylesheet" href="<?=URLROOT?>template/plugins/bs-stepper/css/bs-stepper.min.css">
</head>

<body class="hold-transition layout-top-nav">

    <!-- Navbar -->
    <?php include APPROOT . "/views/Components/NavBar.php"; ?>
    <!-- /.navbar -->
    <div class="wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header  mx-auto" style="width: 85%;">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h6>Complete your personal information</h6>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class=" card card-primary card-outline " style="width: 50%; margin-left: 350px;">

            <div class="card card-default">
                <div class="card-body p-0">
                    <div  class="bs-stepper"  >
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#logins-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                    id="logins-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Personnal informations</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                    id="information-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Upload picture</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form action="<?=URLROOT?>User/uploadData" method="post"enctype="multipart/form-data" style="padding-left: 20px;">
                               
                            <!-- your steps content here -->
                            <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bio</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter your bio" name="bio">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputtext1">Age</label>
                                    <input type="Date" class="form-control" id="exampleInputtext1"
                                        placeholder="Enter your age " name="age">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputtext1">gender </label>
                                    <input type="text" class="form-control" id="exampleInputtext1"
                                        placeholder="Enter your gender " name="gender">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputtext1">Education</label>
                                    <input type="text" class="form-control" id="exampleInputtext1"
                                        placeholder="Enter informations about your education " name="education">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Location</label>
                                    <input type="text" class="form-control" id="exampleInputtext1"
                                        placeholder="Enter your location" name="location">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Skills</label>
                                    <input type="text" class="form-control" id="exampleInputtext1"
                                        placeholder="Add your skills" name="skills">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Notes</label>
                                    <input type="text" class="form-control" id="exampleInputtext1"
                                        placeholder="Add notes" name="notes">
                                </div>

                                <input type="button" class="btn btn-primary" onclick="stepper.next()" value="Next">
                            </div>
                            <div id="information-part" class="content" role="tabpanel"
                                aria-labelledby="information-part-trigger">
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="post">
                                        <span class="username">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="exampleInputFile" name="profile"
                                                            onchange="showImage.call(this)">
                                                        <label class="custom-file-label">Choose photo</label>
                                                    </div><br>

                                                </div>
                                            </div>
                                        </span>
                                        </form>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img class="img-fluid" id="image"
                                                    src="<?= URLROOT ?>/template/dist/img/photo1.png" alt="Photo"
                                                    style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <input type="button" class="btn btn-primary" onclick="stepper.previous()" value="Previous">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                               
                                
                            </div>
                        </div>
                   </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>


    <?php include APPROOT . "/views/Components/footer.php"; ?>

  
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <?php include APPROOT . "/views/Components/scripts.php"; ?>
    <!-- BS-Stepper -->
    <script src="<?=URLROOT?>template/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script>
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })
    </script>
    <script>
    $(function() {
        bsCustomFileInput.init();
    });
    </script>
    <script>
    function showImage() {
        if (this.files && this.files[0]) {
            var obj = new FileReader();
            obj.onload = function(data) {
                var image = document.getElementById("image");
                image.src = data.target.result;
                image.style.display = "block";
                image.style.height = "250px";
            }
            obj.readAsDataURL(this.files[0])
        }
    }
    </script>
</body>

</html>