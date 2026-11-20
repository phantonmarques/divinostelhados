<?php get_header(); ?>

<main class="blog-post" aria-label="Conteúdo do post">
    <?php if (have_posts()) {
            while (have_posts()) { 
                
                the_post(); ?>

                <?php
                    $thumbnail_id = get_post_thumbnail_id();
                    $thumbnail = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'large', false, [
                        'alt' => get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: get_the_title(),
                        'class' => 'animate-fade-in-down',
                        'loading' => 'eager',
                        'fetchpriority' => 'high',
                    ]) : '';

                    if ($thumbnail) { ?>
                        <section class="banner-highlight" id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-label="Imagem do post">
                            <div class="image-wrapper"><?php echo $thumbnail; ?></div>
                        </section>
                    <?php } ?>
           
                <article class="container" aria-label="<?php the_title(); ?>">
                    <div class="header">
                        <h1 class="title-default dark animate-fade-in"><?php the_title(); ?></h1>
                        <?php  
                            $categories = get_the_category();

                            if ( ! empty( $categories ) ) {
                                foreach ( $categories as $cat ) {
                                    if ( $cat->slug !== 'uncategorized' ) {
                                        echo '<h2 class="category animate-fade-in-left">' . esc_html( $cat->name ) . '</h2>';
                                        break;
                                    }
                                }
                            }
                        ?>
                        <?php
                            $date = new DateTime(get_the_date('Y-m-d'));
                            $formatter = new IntlDateFormatter('pt_BR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                        ?>
                        <small class="date animate-fade-in-right"><?= $formatter->format($date) ?></small>
                    </div>
                    <div class="content animate-fade-in-up">
                        <?php the_content(); ?>
                    </div>
                    <div class="footer animate-fade-in-left">
                        <h3 class="title-share">Está gostando do conteúdo? Compartilhe</h3>
                        <ul class="social-list">
                            <?php 
                                $url = urlencode(get_permalink()); 
                                $title = urlencode(get_the_title()); 
                            ?> 
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $url ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-facebook icon"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://api.whatsapp.com/send?text=Olha que interessante esse conteúdo que encontrei: <?= $title ?>%0A<?= $url ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fab fa-whatsapp icon"></i>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:?subject=<?= $title ?>&body=Oi!%0AOlha que interessante esse conteúdo que encontrei: <?= $url ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fas fa-envelope icon"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </article>
        <?php }
    } else {
        echo '<h1 class="title-default dark animate-fade-in-up">Post não encontrado.</h1>';
    } ?>
</main>

<?php get_footer(); ?>
