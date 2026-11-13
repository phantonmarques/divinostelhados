<?php get_header(); ?>

<main class="main-content">
    <section id="introduction" aria-label="Introdução">
        <div class="introduction-image">
            <?php if (wp_is_mobile()) { ?>
                <img 
                    src="<?php echo get_template_directory_uri(); ?>/dist/images/header-banner-500.webp"
                    width="500"
                    height="335"
                    alt="Especialista em reforma e construção de telhados em Brasília"
                />
            <?php } else { ?>
                <img 
                    src="<?php echo get_template_directory_uri(); ?>/dist/images/header-banner.webp"
                    srcset="
                        <?php echo get_template_directory_uri(); ?>/dist/images/header-banner-768.webp 768w,
                        <?php echo get_template_directory_uri(); ?>/dist/images/header-banner-1200.webp 1200w,
                        <?php echo get_template_directory_uri(); ?>/dist/images/header-banner.webp 2000w
                    "
                    sizes="(max-width: 768px) 100vw, 1200px"
                    width="2000"
                    height="1335"
                    fetchpriority="high"
                    decoding="async"
                    alt="Especialista em reforma e construção de telhados em Brasília"
                    style="will-change: transform; content-visibility: auto;"
                />
            <?php } ?>
        </div>
        <div class="introduction-content">
            <h2 class="animate-fade-in-down">Atende Brasília e região</h2>
            <h1 class="animate-fade-in">Especialistas em reforma e construção de telhados</h1>
            <a class="btn-default" rel="noopener noreferrer" target="_blank" href="https://wa.me/5561999963646">
                Fale agora pelo WhatsApp
                <i class="fas fa-chevron-right"></i>
            </a>
    </section>
    <section class="services-types" aria-label="Tipos de serviços">
        <div class="container">
            <ul class="list">
                <li class="item <?php if (! wp_is_mobile()) { ?>animate-fade-in-left<?php } ?>">
                    <div>
                        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/services-types/residential-roof.webp" width="1" height="1" alt="Telhados Residenciais">
                    </div>
                    <div class="content">
                        <h3>Telhados residenciais</h3>
                        <p>Soluções em telhados residenciais para conforto e segurança da sua família.</p>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="300" height="46" viewBox="0 0 368 46">
                            <defs>
                            </defs>
                            <path d="M-0.000,43.000 C-0.000,43.000 108.297,13.000 168.229,20.000 C214.386,25.391 338.560,55.500 368.000,0.000 L368.000,43.000 L-0.000,46.000 " class="cls-1"></path>
                        </svg>
                    </div>
                </li>
                <li class="item <?php if (! wp_is_mobile()) { ?>animate-fade-in-right<?php } ?>">
                    <div>
                        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/services-types/comercial-roof.webp" width="1067" height="600" alt="Telhados Comerciais">
                    </div>
                    <div class="content">
                        <h3>Telhados comerciais</h3>
                        <p>Soluções duráveis para telhados comerciais com agilidade e preço justo.</p>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="300" height="46" viewBox="0 0 368 46">
                            <defs>
                            </defs>
                            <path d="M-0.000,43.000 C-0.000,43.000 108.297,13.000 168.229,20.000 C214.386,25.391 338.560,55.500 368.000,0.000 L368.000,43.000 L-0.000,46.000 " class="cls-1"></path>
                        </svg>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <section class="about" aria-label="Sobre nós">
        <div class="container">
            <div class="info">
                <h3 class="subtitle-default dark animate-fade-in-left">Quem somos</h3>
                <h2 class="title-default dark animate-fade-in-left">Estamos empenhados em oferecer serviços de qualidade</h2>
                <p>Há mais de 25 anos, ajudamos moradores e empresários de Brasília a protegerem seus imóveis com telhados bem feitos, seguros e sem dor de cabeça. Seja para construir, reformar ou resolver problemas como goteiras e infiltrações, nossa equipe está pronta para atender com rapidez e preço justo. Valorizamos o bom atendimento, o trabalho bem-feito e a confiança de cada cliente. Conte com quem entende de telhado e tem história para contar.</p>
            </div>
            <div class="gallery">
                <div class="item animate-fade-in">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/images/about/about-1.webp" width="602" height="800" alt="Sobre nossa empresa 1">
                </div>
                <div class="item animate-fade-in-right">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/images/about/about-2.webp" width="500" height="375" alt="Sobre nossa empresa 2">
                </div>
                <div class="item animate-fade-in-up">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/images/about/about-3.webp" width="850" height="466" alt="Sobre nossa empresa 3">
                </div>
            </div>
        </div>
    </section>

    <section class="services bg-dark" aria-label="Serviços">
        <div class="container">
            <h3 class="subtitle-default light animate-fade-in-left">O que nós fazemos</h3>
            <h2 class="title-default light animate-fade-in-left">Nós oferecemos qualidade em nossos serviços</h2>
            <ul class="services-list">
                <li class="item animate-fade-in">
                    <h4>Construção de telhados</h4>
                    <p>Construímos telhados duráveis e sob medida para casas e comércios em Brasília. Usamos materiais de qualidade, com agilidade, segurança e preço justo.</p>
                    <div class="item-icon">
                        <i class="flaticon-roof-4"></i>
                        <span>01</span>
                    </div>
                </li>
                <li class="item animate-fade-in">
                    <h4>Troca de telhado</h4>
                    <p>Trocamos telhados antigos ou danificados com rapidez, segurança e mínimo transtorno. Ideal para imóveis residenciais e comerciais em toda Brasília.</p>
                    <div class="item-icon">
                        <i class="flaticon-home"></i>
                        <span>02</span>
                    </div>
                </li>
                <li class="item animate-fade-in">
                    <h4>Manutenção preventiva</h4>
                    <p>Cuidamos do seu telhado antes que o problema apareça. Nossa manutenção preventiva protege seu imóvel, evita custos maiores e aumenta a durabilidade da estrutura.</p>
                    <div class="item-icon">
                        <i class="flaticon-roof-5"></i>
                        <span>03</span>
                    </div>
                </li>
                <li class="item animate-fade-in">
                    <h4>Telhados residenciais e comerciais</h4>
                    <p>Seja para sua casa ou empresa, entregamos telhados prontos para resistir ao tempo, evitar vazamentos e valorizar seu imóvel com eficiência e bom atendimento.</p>
                    <div class="item-icon">
                        <i class="flaticon-roof-2"></i>
                        <span>04</span>
                    </div>
                </li>
                <li class="item animate-fade-in">
                    <h4>Instalação de calhas e rufos</h4>
                    <p>Garantimos instalação correta de calhas e rufos, com materiais de qualidade e ótimo acabamento. Proteção eficiente contra chuva e vazamentos.</p>
                    <div class="item-icon">
                        <i class="flaticon-roof-6"></i>
                        <span>05</span>
                    </div>
                </li>
                <li class="item animate-fade-in">
                    <h4>Remoção de goteiras e vazamento de telhados</h4>
                    <p>Identificamos a origem do vazamento e resolvemos o problema na raiz. Garantia de serviço bem-feito e telhado protegido contra novas infiltrações.</p>
                    <div class="item-icon">
                        <i class="flaticon-roof-6"></i>
                        <span>06</span>
                    </div>
                </li>
            </ul>
            <a class="btn-default" rel="noopener noreferrer" target="_blank" href="https://wa.me/5561999963646">
                Saiba mais
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </section>

    <section class="reason" aria-label="Por que escolher a Divinos Telhados?">
        <div class="container">
            <div class="image-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/reason.webp" width="1000" height="750" alt="Porque escolher a Divinos Telhados?">
            </div>
            <div class="content">
                <div class="card">
                    <h3 class="subtitle-default dark animate-fade-in-left">Por que escolher a Divinos Telhados?</h3>
                    <h2 class="title-default dark animate-fade-in-left">Nós oferecemos qualidade em nossos serviços</h2>
                    <p class="animate-fade-in">Escolher a Divinos Telhados é garantir um serviço bem-feito, com materiais de qualidade, atendimento ágil e soluções duradouras. Atendemos Brasília com eficiência, sempre com foco na qualidade e na segurança do seu imóvel.</p>
                    <div class="image-wrapper animate-fade-in-right">
                        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/reason.webp" width="1000" height="750" alt="Porque escolher a Divinos Telhados?">
                    </div>
                    <ul>
                        <li class="animate-fade-in"><i class="fas fa-check"></i> Atendimento rápido e personalizado</li>
                        <li class="animate-fade-in"><i class="fas fa-check"></i> Mais de 25 anos de experiência</li>
                        <li class="animate-fade-in"><i class="fas fa-check"></i> Serviço com preço justo e competitivo</li>
                        <li class="animate-fade-in"><i class="fas fa-check"></i> Equipe especializada e de confiança</li>
                        <li class="animate-fade-in"><i class="fas fa-check"></i> Materiais de alta qualidade e durabilidade</li>
                        <li class="animate-fade-in"><i class="fas fa-check"></i> Compromisso com prazos e satisfação do cliente</li>

                    </ul>
                    <a class="btn-default" rel="noopener noreferrer" target="_blank" href="https://wa.me/5561999963646">
                        Quero saber mais
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="statistics" aria-label="Estatísticas">
        <div class="container">
            <h3 class="subtitle-default dark animate-fade-in-left">Números que falam por nós</h3>
            <h2 class="title-default dark animate-fade-in-left">Estamos empenhados em oferecer serviços de qualidade.</h2>
            <ul class="statistics-list">
                <li class="item animate-fade-in">
                    <i class="flaticon-roof-4"></i>
                    <h3>
                        <span class="counter" data-num="225" data-init="100" data-time="4000">225</span>
                        <span class="sufix">+</span>
                    </h3>
                    <p>Projetos concluídos</p>
                </li>
                <li class="item animate-fade-in">
                    <i class="flaticon-chill"></i>
                    <h3>
                        <span class="counter" data-num="170" data-init="100" data-time="4000">170</span>
                        <span class="sufix">+</span>
                    </h3>
                    <p>Clientes satisfeitos</p>
                </li>
                <li class="item animate-fade-in">
                    <i class="flaticon-roof-6"></i>
                    <h3>
                        <span class="counter" data-num="25" data-init="10" data-time="4000">25</span>
                        <span class="sufix">+</span>
                    </h3>
                    <p>Anos de experiência</p>
                </li>
                <li class="item animate-fade-in">
                    <i class="flaticon-roof-3"></i>
                    <h3>
                        <span class="counter" data-num="10" data-init="1" data-time="2000">10</span>
                        <span class="sufix">+</span>
                    </h3>
                    <p>Trabalhadores</p>
                </li>
    </section>

    <section class="contact" aria-label="Contato">
        <div class="container">
            <div class="content">
                <h3 class="subtitle-default dark animate-fade-in-left">Avaliações</h3>
                <h2 class="title-default dark animate-fade-in-left">O que dizem sobre nós?</h2>
                <div class="swiper-container animate-fade-in">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide card">
                                <blockquote>
                                    <p>Excelente trabalho! Agradeço pela dedicação e responsabilidade da equipe que atendeu prontamente as necessidades de reforma do telhado.</p>
                                </blockquote>
                                <span class="author">Brígida Dallora</span>
                                <span class="date">
                                    <span>07/2024</span> 
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <div class="swiper-slide card">
                                <blockquote>
                                    <p>Profissional super correto, serviço entregue no prazo do contrato e com muito capricho. Recomendo!</p>
                                </blockquote>
                                <span class="author">Luciana Valadares</span>
                                <span class="date">
                                    <span>09/2024</span> 
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <div class="swiper-slide card">
                                <blockquote>
                                    <p>Serviço de qualidade e excelência 👏👏👏</p>
                                </blockquote>
                                <span class="author">Vilma Mendes Lins</span>
                                <span class="date">
                                    <span>12/2024</span> 
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                            <div class="swiper-slide card">
                                <blockquote>
                                    <p>Telhado muito bem feito equipe responsável podem confiar</p>
                                </blockquote>
                                <span class="author">Rafael Batista</span>
                                <span class="date">
                                    <span>02/2024</span> 
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                            </div>
                        </div>
                        <div class="swiper-custom-button-prev"></div>
                        <div class="swiper-custom-button-next"></div>
                    </div>
                </div>
            </div>
            <div class="form-content">
                <h3 class="subtitle-default light animate-fade-in">Entre em contato</h3>
                <h2 class="title-default light animate-fade-in">Tire suas dúvidas</h2>

                <?php echo do_shortcode('[contact-form-7 id="f0e8534" title="Contato"]'); ?>
            </div>
        </div>
    </section>

    <section class="benefits" aria-label="Vantagens">
        <div class="container">
            <div class="card">
                <h2 class="title-default light">Vantagens</h2>
                <ul class="benefits-list">
                    <li class="item animate-fade-in-left">
                        <p>Garante proteção e valoriza com aparência robusta.</p>
                    </li>
                    <li class="item animate-fade-in-right">
                        <p>Platibandas feitas com estrutura de madeira reforçada.</p>
                    </li>
                    <li class="item animate-fade-in-left">
                        <p>Fachada que esconde o telhado com sustentação segura.</p>
                    </li>
                    <li class="item animate-fade-in-right">
                        <p>Previne goteiras, empenos e acabamento desalinhado.</p>
                    </li>
                </ul>
                <a class="btn-default" rel="noopener noreferrer" target="_blank" href="https://wa.me/5561999963646">
                    Solicite um orçamento
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </section>

    <?php 

        $query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 3
        ]);

        if ($query->have_posts()) { ?>
            <section class="blog" aria-label="Nosso ultimos posts do blog">
                <div class="container">
                    <h3>Quais são as novidades</h3>
                    <h2>Nossas últimas notícias</h2>
                    <ul class="blog-list">
                        <?php while ($query->have_posts()){ 
                            $query->the_post(); ?>
                            <li class="item">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="image-wrapper">
                                        <?php
                                            echo wp_get_attachment_image(get_post_thumbnail_id(), 'medium_large', false, [
                                                'loading' => 'eager',
                                                'sizes' => '(max-width: 600px) 100vw, 400px',
                                                'fetchpriority' => 'high',
                                            ]);
                                        ?>
                                    </div>
                                <?php } ?>
                                <div class="content animate-fade-in">
                                    <span>
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo date_i18n('j \d\e F, Y', strtotime(get_the_date('Y-m-d'))) ?>
                                    </span>
                                    <h4><?php the_title(); ?></h4>
                                    <p><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="blog-link">Leia mais</a>
                                </div>
                            </li>
                        <?php };
                        wp_reset_postdata(); ?>
                    </ul>
                    <a class="btn-default" rel="noopener noreferrer" href="/blog">
                        Leia mais
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </section>
        <?php } ?>            
</main>

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Divinos Telhados",
        "description": "Especialistas em construção, reforma e manutenção de telhados residenciais e comerciais. Mais de 25 anos de experiência em Brasília.",
        "url": "https://www.divinostelhados.com.br",
        "areaServed": {
            "@type": "Place",
            "name": "Brasília, DF"
        },
        "serviceType": [
            "Construção de telhados",
            "Troca de telhado",
            "Manutenção preventiva",
            "Instalação de calhas e rufos",
            "Remoção de goteiras",
            "Telhados residenciais",
            "Telhados comerciais"
        ],
        "telephone": "+5561999963646",
        "hasMap": "https://maps.app.goo.gl/8nRruRkGnu8kbZY86",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5.0",
            "reviewCount": "21"
        }
    }
</script>   

<?php get_footer(); ?>