<?php 
    if (isset($_SESSION['idUser'])) {
        $btnLogout='style="display:block;"';
    }else{
        $btnLogout='style="display:none;"';
    }
?>
<!-- FOOTER -->
        <footer class="bg-yellow footer-one">
            <div class="row">
                <form method="POST" action="assets/php/proses_logout" <?=$btnLogout;?>>
                    <div class="col-lg-12" style="padding-right: 20px;" >
                        <button type="submit" class="btn btn-sm btn-logout-bordered pull-right">Logout</button>
                    </div>                    
                </form>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 p-b-0">
                        <h4><?=$Settings['nama'];?></h4>
                        <p align="justify"><?=$Settings['visi'];?>
                        </p>

                        <p class="text-light about-text" align="justify"><?=$Settings['tagline'];?></p>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <h5>Company</h5>
                        <ul class="list-unstyled">
                            <li><a href="#home">About Us</a></li>
                            <li><a href="#service">Services</a></li>
                            <li><a href="#store">Store</a></li>
                            <li><a href="#clients">Client</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-sm-6 p-b-0">
                        <h5>Support</h5>
                        <ul class="list-unstyled">
                            <li><a href="">Help &amp; Support</a></li>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Terms &amp; Conditions</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <div>
                            <h5>Contact us</h5>
                            <ul class="list-unstyled">
                                <li><strong class="font-secondary font-14">Address: </strong> <?=$Settings['alamat'];?></li>
                                <li><strong class="font-secondary font-14">Phone: </strong> <?=$Settings['nomor'];?></li>
                                <li><strong class="font-secondary font-14">Email:  </strong> <a href="mailto:<?=$Settings['email'];?>"><?=$Settings['email'];?></a></li>
                            </ul>
                            <img src="admin/assets/images/icon/logo.png" width="130" class="pull-right">
                        </div>
                    </div>

                </div> <!-- end row -->
            </div>
            <!-- end container -->

            <div class="footer-one-alt">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
                            <p class="m-b-0 font-13 copyright">Copyright CV Pabrik Kreativitas &copy; <?=date('Y');?> All Rights Reserved</p>
                        </div>
                        <div class="col-sm-7">
                            <ul class="list-inline footer-social-one m-b-0 pull-right">
                                <li><a href="<?=$Settings['facebook'];?>"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="<?=$Settings['twitter'];?>"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="<?=$Settings['instagram'];?>"><i class="ion-social-instagram"></i></a></li>
                                <li><a href="mailto:<?=$Settings['email'];?>"><i class="ion-email"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </footer>
        <!-- End Footer -->