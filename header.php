<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <div class="container">
        <div class="header-content">
            <!-- Logo -->
            <a href="<?php echo home_url(); ?>" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-wrench"></i>
                </div>
                <span class="logo-text">FixeoPro</span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="nav-desktop">
                <a href="<?php echo home_url('/categories'); ?>" class="nav-link">Catégories</a>
                <a href="<?php echo home_url('/comment-ca-marche'); ?>" class="nav-link">Comment ça marche</a>
                <a href="<?php echo home_url('/a-propos'); ?>" class="nav-link">À propos</a>
                <a href="<?php echo home_url('/contact'); ?>" class="nav-link">Contact</a>
            </nav>

            <!-- Action Buttons -->
            <div class="nav-desktop">
                <?php if (!is_user_logged_in()) : ?>
                    <a href="<?php echo home_url('/poster-demande'); ?>" class="btn btn-secondary">
                        Poster une demande
                    </a>
                    <a href="<?php echo home_url('/devenir-reparateur'); ?>" class="btn btn-outline">
                        Devenir réparateur
                    </a>
                    <a href="<?php echo wp_login_url(); ?>" class="nav-link">
                        Connexion
                    </a>
                <?php else : ?>
                    <?php
                    $current_user = wp_get_current_user();
                    $user_roles = $current_user->roles;
                    ?>
                    <div class="relative group">
                        <button class="flex items-center space-x-2 nav-link">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <span><?php echo $current_user->display_name; ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 hidden group-hover:block border">
                            <a href="<?php echo home_url('/profil'); ?>" class="block px-4 py-2 text-sm nav-link">
                                <i class="fas fa-user mr-2"></i>Mon profil
                            </a>
                            <?php if (in_array('reparateur_fixeopro', $user_roles)) : ?>
                                <a href="<?php echo home_url('/profil-pro'); ?>" class="block px-4 py-2 text-sm nav-link">
                                    <i class="fas fa-wrench mr-2"></i>Profil professionnel
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo home_url('/parametres'); ?>" class="block px-4 py-2 text-sm nav-link">
                                <i class="fas fa-cog mr-2"></i>Paramètres
                            </a>
                            <a href="<?php echo wp_logout_url(home_url()); ?>" class="block px-4 py-2 text-sm nav-link">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-button" id="mobile-menu-button">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <div class="space-y-4">
                <a href="<?php echo home_url('/categories'); ?>" class="block nav-link">Catégories</a>
                <a href="<?php echo home_url('/comment-ca-marche'); ?>" class="block nav-link">Comment ça marche</a>
                <a href="<?php echo home_url('/a-propos'); ?>" class="block nav-link">À propos</a>
                <a href="<?php echo home_url('/contact'); ?>" class="block nav-link">Contact</a>
                <div class="space-y-2 pt-4">
                    <a href="<?php echo home_url('/poster-demande'); ?>" class="btn btn-secondary w-full">
                        Poster une demande
                    </a>
                    <a href="<?php echo home_url('/devenir-reparateur'); ?>" class="btn btn-outline w-full">
                        Devenir réparateur
                    </a>
                    <?php if (!is_user_logged_in()) : ?>
                        <a href="<?php echo wp_login_url(); ?>" class="btn w-full text-center">
                            Connexion
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
