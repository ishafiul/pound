
        <div class="header_top">
            <div class="col-sm-9 h_menu4">
                <ul class="megamenu skyblue">
                    <li class="active grid"><a class="color8" href="index.html">New</a></li>
                    <?php
                    foreach ($data['primary_cat'] as $primary){
                    ?>
                    <li><a class="color1" href="#"><?php echo $primary->name?></a><div class="megapanel">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            <?php

                                            $i = 0;
                                            $count=[];
                                            foreach ($data['child'] as $child){

                                                if ( $child->parentsof == $primary->id){

                                                    $count[$i] = [
                                                        'name'=>$child->name,
                                                        'id'=>$child->id
                                                    ];
                                                    $i++;
                                                }

                                            }
                                            if($i>1){
                                                $mid = calculate_median($count);
                                                for($i=0;$i<$mid;$i++){
                                                    ?>
                                                    <li><a href="men.html"><?php  echo $count[$i]['name'];?></a></li>
                                                    <?php
                                                }
                                            }
                                            elseif ($i == 0){

                                            }
                                            else{
                                            ?>
                                            <li><a href="men.html"><?php  echo $count[0]['name'];?></a></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            <?php

                                            $icount = 0;
                                            $count=[];
                                            foreach ($data['child'] as $child){

                                                if ( $child->parentsof == $primary->id){

                                                    $count[$icount] = [
                                                        'name'=>$child->name,
                                                        'id'=>$child->id
                                                    ];
                                                    $icount++;
                                                }

                                            }
                                            $mid = calculate_median($count);
                                            if($i>1){
                                            for($i=3;$i<$icount;$i++){
                                                ?>
                                                <li><a href="men.html"><?php  echo $count[$i]['name'];?></a></li>
                                                <?php
                                            }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col1">
                                    <div class="h_nav">
                                        <h4>Popular Brands</h4>
                                        <ul>
                                            <?php
                                            foreach ($data['brands'] as $brand){
                                                if ($brand->category_id == $primary->id){
                                                    ?>
                                                    <li><a href="men.html"><?php echo $brand->name?></a></li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                    <li><a class="color4" href="404.html">Accessories</a></li>
                    <li><a class="color6" href="<?php echo URLROOT; ?>/pages/contact">Conact</a></li>
                </ul>
            </div>
            <div class="col-sm-3 header-top-right">
                <div class="drop_buttons">
                    <select class="drop-down ">
                        <option value="1">Dollar</option>
                        <option value="2">Euro</option>
                    </select>
                    <select class="drop-down drop-down-in">
                        <option value="1">English</option>
                        <option value="2">French</option>
                        <option value="3">German</option>
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="register-info">
                    <ul>
                        <li><a href="login.html">Login</a></li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="header_bootm">
            <div class="col-sm-4 span_1">
                <div class="logo">
                    <a href="<?php echo URLROOT; ?>/index"><img src="<?php echo URLROOT.'/public/img/'.$data['info'][0]->logo; ?>" alt=""/></a>
                </div>
            </div>
            <div class="col-sm-8 row_2">
                <div class="header_bottom_right">
                    <div class="search">
                        <input type="text" value="Your email address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your email address';}">
                        <input type="submit" value="">
                    </div>
                    <ul class="bag">
                        <a href="cart.html"><i class="bag_left"> </i></a>
                        <a href="cart.html"><li class="bag_right"><p>205.00 $</p> </li></a>
                        <div class="clearfix"> </div>
                    </ul>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

