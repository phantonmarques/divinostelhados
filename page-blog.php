<?php get_header(); ?>

<main class="blog-page">
  <section id="filters" class="container">
    <div class="header animate-fade-in">
        <h1 class="title-default dark"><?php the_title(); ?></h1>
        <?php if (have_posts()) { ?>
          <h2>Confira nossos últimos posts</h2>
        <?php } ?>
    </div>
    <div id="categories" class="animate-fade-in-left">
      <button class="category-button active" data-id="all">Todos</button>
      <?php
        $cats = get_categories();
        foreach ($cats as $cat) {
          echo '<button class="category-button" data-id="' . esc_attr($cat->term_id) . '">' . esc_html($cat->name) . '</button>';
        }
      ?>
    </div>
    <input type="text" id="search" class="animate-fade-in-up" placeholder="Pesquisar..." />
  </section>

  <article id="posts-container" class="container"></article>
  <div id="loading" style="display:none;">Carregando...</div>
</main>

<script src="<?php echo get_template_directory_uri(); ?>/dist/js/blog.min.js" defer></script>

<?php get_footer(); ?>