<?php 

/**
 * Blog page template
 * 
 * @package Aquila
 */

 get_header();
?>

<div id="primary">
    <main id="main" class="sit-main mt-5" role="main">
        <?php 
         if(have_posts()): ?>
            <div class="container">
                <?php 
                 if(is_home() && !is_front_page()) { ?>
                    <header class="mb-5">
                        <h1 class="page-title screen-reader-text">
                            <?php single_post_title(); ?>
                        </h1>
                    </header>
                 <?php };
                ?>
                <div class="row">
                <?php 

                $index = 0;
                $no_of_columns = 3;

                 while(have_posts()) {
                        the_post();
                    if($index % $no_of_columns === 0) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                 <?php } 
                 
                    get_template_part('/template-parts/content');

                    $index++;

                    if($index !== 0 && $index % $no_of_columns === 0) {?>
                        </div>
                   <?php }
                 }
                ?>
                </div>
            </div>
        <?php 
        else:

        get_template_part('/template-parts/content-none');
        
        endif;
        ?>
    </main>
</div>

<?php

get_footer();