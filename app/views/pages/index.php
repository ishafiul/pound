<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php';
?>
        <div class="grid_1">
            <div class="col-md-3 banner_left">
                <img src="<?php echo URLROOT; ?>/images/pic1.png" class="img-responsive" alt=""/>
                <div class="banner_desc">
                    <h1>Slim Fit Men </h1>
                    <h2>Roundcheck T-Shirt</h2>
                    <h5>$125
                        <small>Only</small>
                    </h5>
                    <a href="#" class="btn1 btn4 btn-1 btn1-1b">Add To Cart</a>
                </div>
            </div>
            <div class="col-md-9 banner_right">
                <!-- FlexSlider -->
                <section class="slider">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                            foreach ($data['slider'] as $slider){
                            ?>
                            <li><img src="<?php echo URLROOT.'/img/slider/'.$slider->img; ?>" alt=""/></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </section>
                <!-- FlexSlider -->
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="content">
            <div class="content_box">
                <ul class="grid_2">
                    <a href="single.html"><li><img src="<?php echo URLROOT; ?>/images/pic2.png" class="img-responsive" alt=""/>
                            <span class="btn5">$120</span>
                            <p>Bikroy Tshirt - Roundneck</p>
                        </li></a>
                    <a href="single.html"><li><img src="<?php echo URLROOT; ?>/images/pic3.png" class="img-responsive" alt=""/>
                            <span class="btn5">$340</span>
                            <p>Park Tshirt - Partygrandd</p>
                        </li></a>
                    <a href="single.html"><li><img src="<?php echo URLROOT; ?>/images/pic4.png" class="img-responsive" alt=""/>
                            <span class="btn5">$250</span>
                            <p>Gray Tshirt Roundneckdd</p>
                        </li></a>
                    <a href="single.html"><li><img src="<?php echo URLROOT; ?>/images/pic5.png" class="img-responsive" alt=""/>
                            <span class="btn5">$378</span>
                            <p>Marivo Tshirt - Roundneck</p>
                        </li></a>
                    <a href="single.html"><li class="last1"><img src="<?php echo URLROOT; ?>/images/pic6.png" class="img-responsive" alt=""/>
                            <span class="btn5">$428</span>
                            <p>Strict TshirtSoft, Pure Cotton</p>
                        </li></a>
                    <div class="clearfix"> </div>
                </ul>
                <div class="grid_3">
                    <div class="col-md-6 box_2">
                        <div class="section_group">
                            <div class="col_1_of_2 span_1_of_2">
                                <img src="<?php echo URLROOT.'/img/'.$data['info'][0]->featurImg1; ?>" class="img-responsive" alt=""/>
                            </div>
                            <div class="col_1_of_2 span_1_of_2">
                                <img src="<?php echo URLROOT.'/img/'.$data['info'][0]->featurImg2; ?>" class="img-responsive" alt=""/>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box_3">
                            <div class="col_1_of_2 span_1_of_2 span_3">
                                <h3>Paul Slim Fit Men
                                    Roundneck
                                    T-Shirt</h3>
                                <h4>$156</h4>
                                <p>Offer Available till Sunday 12 Nov 2014.</p>
                                <a href="#" class="btn1 btn6 btn-1 btn1-1b">Add To Cart</a>
                            </div>
                            <div class="col_1_of_2 span_1_of_2 span_4">
                                <div class="span_5">
                                    <img src="<?php echo URLROOT; ?>/images/pic9.png" class="img-responsive" alt=""/>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <?php require APPROOT . '/views/inc/footer.php'; ?>
            </div>
        </div>
        <link href="<?php echo URLROOT; ?>/css/flexslider.css" rel='stylesheet' type='text/css' />
        <script defer src="<?php echo URLROOT; ?>/js/jquery.flexslider.js"></script>
        <script type="text/javascript">
            $(function(){
                SyntaxHighlighter.all();
            });
            $(window).load(function(){
                $('.flexslider').flexslider({
                    animation: "slide",
                    start: function(slider){
                        $('body').removeClass('loading');
                    }
                });
            });
        </script>

