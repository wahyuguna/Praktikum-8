<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Perpustakaan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/landingPage')?>/css/bootstrap.css" />
    <!-- main css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/landingPage')?>/css/style.css" />
  </head>

  <body style = "background: url(<?=base_url('assets/landingPage')?>/home-banner.jpg) no-repeat center center fixed;height: 100%;width: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
    <!--================ Start Home Banner Area =================-->
    <section >
      <div >
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="banner_content text-center" style="margin-top: 20%;">
                <h2 class="text-uppercase mt-4 mb-5">
                  Masuk Sebagai?
                </h2>
                <div>
                  <a href="<?php echo base_url('/Perpustakaan/petugas'); ?>" class="primary-btn2 mb-3 mb-sm-0">Petugas</a>
                  <a href="<?php echo base_url('/Perpustakaan/anggota'); ?>" class="primary-btn ml-sm-3 ml-0">Anggota</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ End Home Banner Area =================-->
  </body>
</html>
