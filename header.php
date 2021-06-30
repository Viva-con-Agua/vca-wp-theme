<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>

		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">

        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#008fc3">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#008fc3">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>

    <?php
        $subHeaderLink = get_field('subHeaderLink', 'options');
        $subHeaderLinkIconUrl = get_field('subHeaderLinkIcon', 'options');

        get_template_part('template-parts/contactBar');
    ?>
	<header class="header">
        <div class="subHeader">
            <div class="d-flex justify-content-between justify-content-md-end">
                <div class="langSwitcher">
                    <?php
                    // #### Kurzzeitig auskommentiert bist Sprache vorhanden. ####
                    // html5blank_nav('lang-menu');
                    ?>
                </div>
                <?php if (isset($subHeaderLink) && is_array($subHeaderLink) && count($subHeaderLink) > 0) { ?>
                    <div class="link">
                        <a href="<?php echo $subHeaderLink['url']; ?>"><?php echo $subHeaderLink['title']; ?></a>
                        <?php if(isset($subHeaderLinkIconUrl) && !empty($subHeaderLinkIconUrl)) {
                            echo getPicture($subHeaderLinkIconUrl['ID'], 'small', 'lazy');
                        }; ?>
                    </div>
                <?php } ?>
            </div>
        </div>

		<div class="row">
			<div class="col">
				<div id="headBar">
                    <a href="<?php echo get_home_url(); ?>">
                        <div class="logo">
                            <img src="/wp-content/uploads/logo/vca_logo.png" alt="logo">
                        </div>
                    </a>

					<div id="navToggle">
						<div class="burger">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>

					<div class="navWrap">
						<nav id="mainnavCon" class="nav">
							<?php html5blank_nav('header-menu', new mainMenuWalker); ?>
						</nav>
					</div>

				</div>
			</div>
		</div>
        <?php /*
        // ##### Header Svg auskommentiert weil aktuell nicht mehr gewollt #####
        <svg id="headerSvg" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1471 65">
          <defs/>
          <defs>
            <filter id="headerSvgShadow" width="1471.1" height="64.9" x="0" y="0" filterUnits="userSpaceOnUse">
              <feOffset dy="3"/>
              <feGaussianBlur result="blur" stdDeviation="3"/>
              <feFlood flood-opacity=".2"/>
              <feComposite in2="blur" operator="in"/>
              <feComposite in="SourceGraphic"/>
            </filter>
          </defs>
          <g filter="url(#headerSvgShadow)">
            <path fill="#008fc3" d="M9 6s363 47 723 47 730-47 730-47z"/>
          </g>
        </svg>
        */ ?>
	</header>

	<div class="wrapper">

        <?php if (is_front_page()) {
            get_template_part('template-parts/frontpage/header');
        } else {
            get_template_part('template-parts/ownHeader');
        } ?>
