 <style>
    .wshipping-content-block {
       background-color: #fafafa;
    }

    .news-sect {
       height: 400px;
       overflow: scroll;
    }
 </style>

 <!-- Breadcroumbs start -->
 <div class="wshipping-content-block wshipping-breadcroumb inner-bg-1">
    <div class="container">
       <div class="row">
          <div class="col-12 col-lg-7">
             <h1>News & Events </h1>
             <a href="<?= base_url() ?>" title="Home">Home </a> / News & Events
          </div>
          <div class="col-12 col-lg-5 text-right"></div>
       </div>
    </div>
 </div>
 <!-- Breadcroumbs end -->
 <!-- News &amp; Testimonials Start -->
 <div class="wshipping-content-block news-testimonial-block">
    <div class="container wow fadeInUp">
       <div class="row">
          <!-- Latest News Start -->
          <div class="col-12 col-lg-5">
             <h3 class="heading3-border text-uppercase">Latest News </h3>
             <div class="news-sect">
                <?php $descriptionLength = 100;
                  foreach ($newsList as $key => $news) { ?>
                   <div class="latest-news-section mt0 ">
                      <a href="#" data-toggle="modal" data-target="#myModal_<?=$key?>">
                         <div class="news-date">
                            <?= date('d', strtotime($news->date)) ?> <span><?= date('M', strtotime($news->date)) ?> </span>
                         </div>
                         <h4><?= $news->title ?></h4>
                         <!-- <div class="news-post-by">By  <span>Admin </span></div> -->
                         <p><?= substr(strip_tags($news->description), 0, $descriptionLength) ?> <?= (strlen(strip_tags($news->description)) > $descriptionLength) ? '...' : '' ?> </p>
                      </a>
                      <div class="modal fade" id="myModal_<?=$key?>">
                         <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                               <!-- Modal Header -->
                               <div class="modal-header">
                                  <h4 class="modal-title"><?= $news->title ?> &nbsp;<small><?=printFormatedDate($news->date)?></small></h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                               </div>

                               <!-- Modal body -->
                               <div class="modal-body">
                                  
                                  <div class="col-md-12">
                                    <?php if($news->image){?>
                                    <div class="image-wrapper float-left pr-3">
                                       <img src="<?=base_url('uploads/news/'.$news->image)?>" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                    <?php }?>
                                       <div class="text-justify p-3">
                                      <?=$news->description?>
                                       </div>
                                 </div>
                               </div>

                               <!-- Modal footer -->
                               <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                               </div>

                            </div>
                         </div>
                      </div>
                   </div>


                <?php } ?>

                <?php if (empty($newsList)) { ?>
                   <div class="latest-news-section mt0 wow fadeInUp">
                      <p>No data available</p>
                   </div>
                <?php } ?>
             </div>
          </div>
          <!-- Latest News End -->

          <!-- Testimonial start -->
          <?php if (!empty($newsList)) { ?>


             <div class="col-12 col-lg-7 home-testimonial">
                <h3 class="heading3-border text-uppercase">Testimonial </h3>

                <div class="testimonial">
                   <?php $descriptionLength = 200;
                     foreach ($testimonialList as $key=>$testimonial) { ?>
                      <div class="testimonial-item">
                         <!-- <a href="#" data-toggle="modal" data-target="#testimonialModel_<?=$key?>"> -->
                         <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-5">
                               <div class="testimonial-img-bg" style="background-image:url(<?= base_url('uploads/news/'.$testimonial->image) ?>);"></div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-7">
                               <div class="testimonial-content">
                                  <p><?= substr(strip_tags($testimonial->description), 0, $descriptionLength) ?> <?= (strlen(strip_tags($testimonial->description)) > $descriptionLength) ? '...<a href="#" class="text-primary" data-toggle="modal" data-target="#testimonialModel_'.$key.'">View More</a>' : '' ?> </p>
                                 </div>
                                 


                            </div>
                           </div>
                        <!-- </a> -->
                         
                      </div>

                      

                   <?php } ?>


                </div>
               <?php foreach ($testimonialList as $key=>$testimonial) { ?>
                <!-- start:model -->
                <div class="modal fade" id="testimonialModel_<?=$key?>">
                         <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                               <!-- Modal Header -->
                               <div class="modal-header">
                                  <h4 class="modal-title"><?= $testimonial->title ?> &nbsp;<small><?=printFormatedDate($testimonial->created_at)?></small></h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                               </div>

                               <!-- Modal body -->
                               <div class="modal-body">
                                  
                                  <div class="col-md-12">
                                    <?php if($testimonial->image){?>
                                    <div class="image-wrapper float-left pr-3">
                                       <img src="<?=base_url('uploads/news/'.$testimonial->image)?>" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                    <?php }?>
                                       <div class="text-justify p-3">
                                      <?=$testimonial->description?>
                                       </div>
                                 </div>
                               </div>

                               <!-- Modal footer -->
                               <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                               </div>

                            </div>
                         </div>
                      </div>
                                 <!-- end:model -->
                                 <?php } ?>

             </div>
          <?php } ?>
          <!-- Testimonial end -->
       </div>
    </div>
 </div>
 <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open modal
  </button> -->
 <!-- The Modal -->

 <!-- News & Testimonials End -->

 <!-- Our client start -->
 <div class="wshipping-content-block client-block pt10">
    <div class="container">
       <div class="row">
          <!-- <div class="col-12"><h3 class="heading3-border text-uppercase"><a href="<?php echo base_url('our-clients'); ?>" style="text-decoration: none;">Our Valuable Clients</a></h3></div>
         <div class="our-client">
           <div class="client-item"><img src="<?php echo base_url('assets/frontend/images/client-1.jpg'); ?>" alt="" /></div>
           <div class="client-item"><img src="<?php echo base_url('assets/frontend/images/client-2.jpg'); ?>" alt="" /></div>
           <div class="client-item"><img src="<?php echo base_url('assets/frontend/images/client-3.jpg'); ?>" alt="" /></div>
           <div class="client-item"><img src="<?php echo base_url('assets/frontend/images/client-4.jpg'); ?>" alt="" /></div>
           <div class="client-item"><img src="<?php echo base_url('assets/frontend/images/client-5.jpg'); ?>" alt="" /></div>
           <div class="client-item"><img src="<?php echo base_url('assets/frontend/images/client-6.jpg'); ?>" alt="" /></div>
           <div class="client-item"><img src="<?php echo base_url('assets/frontend/images/client-1.jpg'); ?>" alt="" /></div>
           <div class="client-item"><img src="<?php echo base_url('assets/frontend/images/client-2.jpg'); ?>" alt="" /></div>
         </div> -->
       </div>
    </div>
 </div>
 <!-- Our client end -->