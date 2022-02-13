 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
   <div class="container">


     <div class="collapse navbar-collapse order-3" id="navbarCollapse">
       <!-- Left navbar links -->
       <ul class="navbar-nav">
         <li class="nav-item">
           <a href="<?=URLROOT?>User/" class="nav-link">Home</a>
         </li>
         <li class="nav-item">
           <a href="<?=URLROOT?>User/profile" class="nav-link">Profil</a>
         </li>
       </ul>

       <!-- SEARCH FORM -->
       <form class="form ml-12 ml-md-12">
         <div class="autocomplemnt" style="position: relative; display:inline-block; width:300px;">
           <div class="input-group input-group-sm">
             <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" id="search">
             <div class="input-group-append">
               <button class="btn btn-navbar" type="submit">
                 <i class="fas fa-search"></i>
               </button>
             </div>
           </div>
           <div class="autocomplete-items" style="display:none ;padding:10px; background:white;position: absolute;border: 1px solid #d4d4d4;border-bottom: none;border-top: none;z-index: 1;top: 100%;left: 0;right: 0;">

           </div>

         </div>


       </form>
     </div>

     <!-- Right navbar links -->
     <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
       <!-- Messages Dropdown Menu -->
       <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
           <i class="fas fa-comments"></i>
           <span class="badge badge-danger navbar-badge">3</span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
           <a href="#" class="dropdown-item">
             <!-- Message Start -->
             <div class="media" id="addClass">
               <img src="<?= URLROOT ?>/template/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
               <div class="media-body">
                 <h3 class="dropdown-item-title">
                   Brad Diesel
                   <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                 </h3>
                 <p class="text-sm">Call me whenever you can...</p>
                 <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
               </div>
             </div>
             <!-- Message End -->
           </a>
           <div class="dropdown-divider"></div>
           <a href="#" class="dropdown-item">
             <!-- Message Start -->
             <div class="media">
               <img src="<?= URLROOT ?>/template/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
               <div class="media-body">
                 <h3 class="dropdown-item-title">
                   John Pierce
                   <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                 </h3>
                 <p class="text-sm">I got your message bro</p>
                 <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
               </div>
             </div>
             <!-- Message End -->
           </a>
           <div class="dropdown-divider"></div>
           <a href="#" class="dropdown-item">
             <!-- Message Start -->
             <div class="media">
               <img src="<?= URLROOT ?>/template/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
               <div class="media-body">
                 <h3 class="dropdown-item-title">
                   Nora Silvester
                   <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                 </h3>
                 <p class="text-sm">The subject goes here</p>
                 <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
               </div>
             </div>
             <!-- Message End -->
           </a>
           <div class="dropdown-divider"></div>
           <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
         </div>
       </li>
       <!-- Notifications Dropdown Menu -->
       <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
           <i class="far fa-bell"></i>
           <span class="badge badge-warning navbar-badge"><?=$data["statistique"]["invitations"]?></span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
           <span class="dropdown-header"><?=$data["statistique"]["invitations"]?> Notifications</span>
           <?php foreach($data["mes_invs"] as $inv):?>
            <div class="media" id="inv<?=$inv["id_invitation"]?>" style="padding:15px">
                <img src="<?= URLROOT ?>/uploads/users/<?=$inv["image_profil"]?>" alt="User Avatar" class="img-size-50 img-circle mr-3" width="20px">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?=$inv["fullname"]?>
                    <?php if(empty($inv["status"])){?>
                    <span class="float-right text-sm text-danger decisions" data-id="<?=$inv["id_invitation"]?>" data-status="0"><i class="fas fa-ban" style="padding-right:5px ;"></i></span>
                    <span class="float-right text-sm text-success decisions" data-id="<?=$inv["id_invitation"]?>" data-status="1"><i class="fas fa-check" style="padding-right:5px ;"></i></span>
                      <?php } else if($inv["status"]==1) echo "<span class='float-right text-sm text-success'>accepté</span>"; else echo "<span class='float-right text-sm text-danger'>regeté</span>" ?>
                      
                  </h3>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?=convertDateToFormat($inv["Date_invitation"])?></p>
                </div>
              </div>
            <?php endforeach; ?>
           <div class="dropdown-divider"></div>
           <div class="dropdown-divider"></div>
           <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
         </div>
       </li>
       <li class="nav-item">
         <a href="<?=URLROOT?>/User/logout" class="nav-link">
         <i class="fas fa-sign-out-alt"></i>  
         </a>
      </li>


     </ul>
   </div>
 </nav>
 <!-- /.navbar -->