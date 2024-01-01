<section class="section dashboard">
      <div class="row">



        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                

                <div class="card-body">
                  <h5 class="card-title">Resources </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?=$total_resources?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

               

                <div class="card-body">
                  <h5 class="card-title">Forum Questions</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-question"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?=$total_forum?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">News</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?=$total_news?></h6>
                    

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->


            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card">

                

                <div class="card-body">
                  <h5 class="card-title">Hr Proffessionals & Executive Networks</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?=$total_users?></h6>
                     

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- News & Updates Traffic -->
          <div class="card">
            

            <div class="card-body pb-0">
              <h5 class="card-title">Subscription Plan</span></h5>

              <div class="news">


          
              
                <div class="post-item clearfix">
                <img src="<?=base_url($plan['image'])?>" alt="">
                  <h4><a href="#"><?=$plan['name']?></a></h4>
                  <p><?=$plan['description']?></p>

                    <?php if($subscription == null){ ?>
                      <a href="<?=base_url('home/pricing')?>">
                    <button class="text-white btn btn-primary">Subscribe</button></a>
                  <?php }else{ ?>
                    <span class="text-black btn btn-success"><i class="fa fa-check text-white"></i> Your current Plan</span>
                    <?php } ?>
                </div>

            

              </div><!-- End sidebar recent posts-->

            </div>
          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>
    </section>