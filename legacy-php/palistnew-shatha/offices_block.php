<<<<<<< HEAD=======>>>>>>> origin/Ali
    <section id="centers">

        <?php $resp=db('pis_offices_8363',NULL,NULL);
        ?>
        <div>
            <div class="">
                <?php
                for($i=0;$i<count($resp);$i++){
                    
                    $x=explode(',',$resp[$i]['location']);
        ?>
                <<<<<<< HEAD <div id="map_<?=$resp[$i]['id']?>" class="c_map "
                    style="<?php if($i!=0){?> display: none;<?php }?>">

                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe title="PARC Locations" width="100%" height="470"
                                id="gmap_canvas"
                                src="https://maps.google.com/maps?q=<?=$x[0]?>,<?=$x[1]?>&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 470px;
                                width: 100%;
                            }

                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 470px;
                                width: 100%;
                            }
                            </style>
                        </div>
                    </div>

            </div>
            <?php }?>

        </div>

        </div>
    </section>
    =======
    <div id="map_<?=$resp[$i]['id']?>" class="c_map " style="<?php if($i!=0){?> display: none;<?php }?>">

        <div class="mapouter">
            <div class="gmap_canvas"><iframe title="PARC Locations" width="100%" height="470" id="gmap_canvas"
                    src="https://maps.google.com/maps?q=<?=$x[0]?>,<?=$x[1]?>&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                <style>
                .mapouter {
                    position: relative;
                    text-align: right;
                    height: 470px;
                    width: 100%;
                }

                .gmap_canvas {
                    overflow: hidden;
                    background: none !important;
                    height: 470px;
                    width: 100%;
                }
                </style>
            </div>
        </div>

    </div>
    <?php }?>

    </div>

    </div>
    </section>
    >>>>>>> origin/Ali