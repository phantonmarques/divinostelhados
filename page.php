<?php get_header(); ?>

<main class="page" aria-label="Conteúdo da página">
    <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                <article class="container" aria-label="<?php the_title(); ?>">
                    <div class="header animate-fade-in">
                        <h1 class="title-default dark"><?php the_title(); ?></h1>
                    </div>

                    <div class="content animate-fade-in-up">
                        <?php the_content(); ?>
                    </div>
                </article>
        <?php }
    } else {
        echo '<h1 class="title-default dark animate-fade-in">Página não encontrada.</h1>';
    } ?>
</main>

<?php get_footer(); ?>