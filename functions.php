<?php
// Sécurité WordPress
if (!defined('ABSPATH')) {
    exit;
}

// Configuration du thème
function fixeopro_setup() {
    // Support des fonctionnalités WordPress
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Menus
    register_nav_menus(array(
        'primary' => 'Menu principal',
        'footer' => 'Menu footer'
    ));
    
    // Tailles d'images personnalisées
    add_image_size('reparateur-avatar', 200, 200, true);
    add_image_size('reparateur-gallery', 400, 300, true);
}
add_action('after_setup_theme', 'fixeopro_setup');

// Chargement des styles et scripts
function fixeopro_scripts() {
    // Tailwind CSS via CDN avec configuration
    wp_enqueue_style('tailwind', 'https://cdn.tailwindcss.com', array(), '3.3.0');
    
    // Font Awesome pour les icônes
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Style personnalisé du thème
    wp_enqueue_style('fixeopro-style', get_template_directory_uri() . '/assets/css/style.css', array('tailwind'), '1.0.0');
    
    // Scripts JavaScript
    wp_enqueue_script('fixeopro-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localisation pour AJAX
    wp_localize_script('fixeopro-js', 'fixeopro_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('fixeopro_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'fixeopro_scripts');

// Custom Post Types
function fixeopro_custom_post_types() {
    // Post Type: Demandes
    register_post_type('demande', array(
        'labels' => array(
            'name' => 'Demandes',
            'singular_name' => 'Demande',
            'add_new' => 'Ajouter une demande',
            'add_new_item' => 'Ajouter une nouvelle demande',
            'edit_item' => 'Modifier la demande',
            'new_item' => 'Nouvelle demande',
            'view_item' => 'Voir la demande',
            'search_items' => 'Rechercher des demandes',
            'not_found' => 'Aucune demande trouvée',
            'not_found_in_trash' => 'Aucune demande dans la corbeille'
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-hammer',
        'has_archive' => false
    ));
    
    // Post Type: Profils Réparateurs
    register_post_type('reparateur', array(
        'labels' => array(
            'name' => 'Réparateurs',
            'singular_name' => 'Réparateur',
            'add_new' => 'Ajouter un réparateur',
            'add_new_item' => 'Ajouter un nouveau réparateur',
            'edit_item' => 'Modifier le réparateur',
            'new_item' => 'Nouveau réparateur',
            'view_item' => 'Voir le réparateur',
            'search_items' => 'Rechercher des réparateurs',
            'not_found' => 'Aucun réparateur trouvé',
            'not_found_in_trash' => 'Aucun réparateur dans la corbeille'
        ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-businessman',
        'has_archive' => true,
        'rewrite' => array('slug' => 'reparateurs')
    ));
}
add_action('init', 'fixeopro_custom_post_types');

// Taxonomies personnalisées
function fixeopro_custom_taxonomies() {
    // Taxonomie: Catégories de réparation
    register_taxonomy('categorie_reparation', array('demande', 'reparateur'), array(
        'labels' => array(
            'name' => 'Catégories de réparation',
            'singular_name' => 'Catégorie de réparation',
            'search_items' => 'Rechercher des catégories',
            'all_items' => 'Toutes les catégories',
            'edit_item' => 'Modifier la catégorie',
            'update_item' => 'Mettre à jour la catégorie',
            'add_new_item' => 'Ajouter une nouvelle catégorie',
            'new_item_name' => 'Nom de la nouvelle catégorie',
            'menu_name' => 'Catégories'
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'categorie')
    ));
    
    // Taxonomie: Villes
    register_taxonomy('ville', array('demande', 'reparateur'), array(
        'labels' => array(
            'name' => 'Villes',
            'singular_name' => 'Ville',
            'search_items' => 'Rechercher des villes',
            'all_items' => 'Toutes les villes',
            'edit_item' => 'Modifier la ville',
            'update_item' => 'Mettre à jour la ville',
            'add_new_item' => 'Ajouter une nouvelle ville',
            'new_item_name' => 'Nom de la nouvelle ville',
            'menu_name' => 'Villes'
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'ville')
    ));
}
add_action('init', 'fixeopro_custom_taxonomies');

// Rôles utilisateurs personnalisés
function fixeopro_add_user_roles() {
    // Rôle Client
    add_role('client_fixeopro', 'Client FixeoPro', array(
        'read' => true,
        'edit_posts' => false,
        'delete_posts' => false
    ));
    
    // Rôle Réparateur
    add_role('reparateur_fixeopro', 'Réparateur FixeoPro', array(
        'read' => true,
        'edit_posts' => false,
        'delete_posts' => false,
        'access_demandes' => true
    ));
}
add_action('init', 'fixeopro_add_user_roles');

// Création des tables personnalisées
function fixeopro_create_tables() {
    global $wpdb;
    
    $charset_collate = $wpdb->get_charset_collate();
    
    // Table des abonnements réparateurs
    $table_abonnements = $wpdb->prefix . 'fixeopro_abonnements';
    $sql_abonnements = "CREATE TABLE $table_abonnements (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        plan varchar(50) NOT NULL DEFAULT 'basic',
        statut varchar(20) NOT NULL DEFAULT 'actif',
        date_debut datetime DEFAULT CURRENT_TIMESTAMP,
        date_fin datetime NULL,
        montant decimal(10,2) NOT NULL DEFAULT 29.00,
        stripe_subscription_id varchar(255) NULL,
        PRIMARY KEY (id),
        KEY user_id (user_id)
    ) $charset_collate;";
    
    // Table des notifications
    $table_notifications = $wpdb->prefix . 'fixeopro_notifications';
    $sql_notifications = "CREATE TABLE $table_notifications (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        type varchar(50) NOT NULL,
        titre varchar(255) NOT NULL,
        message text NOT NULL,
        lu tinyint(1) NOT NULL DEFAULT 0,
        date_creation datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY user_id (user_id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_abonnements);
    dbDelta($sql_notifications);
}
register_activation_hook(__FILE__, 'fixeopro_create_tables');

// AJAX pour traitement des formulaires
function fixeopro_handle_demande_submission() {
    check_ajax_referer('fixeopro_nonce', 'nonce');
    
    $nom = sanitize_text_field($_POST['nom']);
    $prenom = sanitize_text_field($_POST['prenom']);
    $email = sanitize_email($_POST['email']);
    $telephone = sanitize_text_field($_POST['telephone']);
    $ville = sanitize_text_field($_POST['ville']);
    $code_postal = sanitize_text_field($_POST['code_postal']);
    $categorie = sanitize_text_field($_POST['categorie']);
    $titre = sanitize_text_field($_POST['titre']);
    $description = sanitize_textarea_field($_POST['description']);
    $urgence = sanitize_text_field($_POST['urgence']);
    $budget = sanitize_text_field($_POST['budget']);
    
    // Créer la demande
    $demande_data = array(
        'post_title' => $titre,
        'post_content' => $description,
        'post_type' => 'demande',
        'post_status' => 'publish',
        'meta_input' => array(
            'nom_client' => $nom,
            'prenom_client' => $prenom,
            'email_client' => $email,
            'telephone_client' => $telephone,
            'ville_client' => $ville,
            'code_postal_client' => $code_postal,
            'urgence' => $urgence,
            'budget' => $budget,
            'statut_demande' => 'en_attente'
        )
    );
    
    $demande_id = wp_insert_post($demande_data);
    
    if ($demande_id) {
        // Assigner la catégorie
        wp_set_object_terms($demande_id, $categorie, 'categorie_reparation');
        wp_set_object_terms($demande_id, $ville, 'ville');
        
        // Envoyer email de confirmation
        fixeopro_send_confirmation_email($email, $nom, $prenom, $titre);
        
        wp_send_json_success(array('message' => 'Votre demande a été envoyée avec succès !'));
    } else {
        wp_send_json_error(array('message' => 'Erreur lors de l\'envoi de la demande.'));
    }
}
add_action('wp_ajax_submit_demande', 'fixeopro_handle_demande_submission');
add_action('wp_ajax_nopriv_submit_demande', 'fixeopro_handle_demande_submission');

// Fonction d'envoi d'email
function fixeopro_send_confirmation_email($email, $nom, $prenom, $titre) {
    $subject = 'Confirmation de votre demande - FixeoPro';
    $message = "
    Bonjour $prenom $nom,
    
    Votre demande '$titre' a bien été reçue.
    
    Nous vous mettrons en relation avec un professionnel dans les plus brefs délais.
    
    Cordialement,
    L'équipe FixeoPro
    ";
    
    wp_mail($email, $subject, $message);
}

// Vérifier si l'utilisateur a un abonnement actif
function fixeopro_user_has_active_subscription($user_id) {
    global $wpdb;
    
    $table_abonnements = $wpdb->prefix . 'fixeopro_abonnements';
    $result = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_abonnements WHERE user_id = %d AND statut = 'actif' AND (date_fin IS NULL OR date_fin > NOW())",
        $user_id
    ));
    
    return !empty($result);
}

// Masquer les données clients pour les réparateurs sans abonnement
function fixeopro_mask_client_data($data, $user_id) {
    if (!fixeopro_user_has_active_subscription($user_id)) {
        return array(
            'nom' => 'XXX',
            'prenom' => 'XXX',
            'email' => 'xxx@xxx.com',
            'telephone' => 'XX XX XX XX XX'
        );
    }
    return $data;
}

// Shortcode pour afficher les demandes
function fixeopro_demandes_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 10,
        'categorie' => '',
        'ville' => ''
    ), $atts);
    
    $args = array(
        'post_type' => 'demande',
        'posts_per_page' => $atts['limit'],
        'post_status' => 'publish'
    );
    
    if (!empty($atts['categorie'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie_reparation',
            'field' => 'slug',
            'terms' => $atts['categorie']
        );
    }
    
    if (!empty($atts['ville'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'ville',
            'field' => 'slug',
            'terms' => $atts['ville']
        );
    }
    
    $demandes = new WP_Query($args);
    
    ob_start();
    if ($demandes->have_posts()) {
        echo '<div class="grid gap-6">';
        while ($demandes->have_posts()) {
            $demandes->the_post();
            get_template_part('template-parts/demande-card');
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p class="text-gray-500">Aucune demande trouvée.</p>';
    }
    
    return ob_get_clean();
}
add_shortcode('fixeopro_demandes', 'fixeopro_demandes_shortcode');

// Redirection après connexion selon le rôle
function fixeopro_login_redirect($redirect_to, $request, $user) {
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('reparateur_fixeopro', $user->roles)) {
            return home_url('/profil-pro/');
        } elseif (in_array('client_fixeopro', $user->roles)) {
            return home_url('/profil/');
        }
    }
    return $redirect_to;
}
add_filter('login_redirect', 'fixeopro_login_redirect', 10, 3);

// Ajouter les catégories par défaut
function fixeopro_add_default_categories() {
    $categories = array(
        'electromenager' => 'Électroménager',
        'informatique' => 'Informatique',
        'plomberie' => 'Plomberie',
        'electricite' => 'Électricité',
        'chauffage' => 'Chauffage',
        'serrurerie' => 'Serrurerie',
        'multimedia' => 'Multimédia',
        'climatisation' => 'Climatisation'
    );
    
    foreach ($categories as $slug => $name) {
        if (!term_exists($slug, 'categorie_reparation')) {
            wp_insert_term($name, 'categorie_reparation', array('slug' => $slug));
        }
    }
}
add_action('after_switch_theme', 'fixeopro_add_default_categories');
?>
