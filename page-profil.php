<?php
/*
Template Name: Profil utilisateur
*/

// Vérifier si l'utilisateur est connecté
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

$current_user = wp_get_current_user();
get_header();
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Mon profil</h1>
            <p class="text-gray-600">Gérez vos informations personnelles et suivez vos demandes</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm border">
            <!-- Tabs -->
            <div class="border-b">
                <nav class="flex space-x-8 px-6">
                    <button class="tab-button py-4 px-1 border-b-2 border-blue-500 text-blue-600 font-medium" data-tab="profil">
                        Profil
                    </button>
                    <button class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="demandes">
                        Mes demandes
                    </button>
                    <button class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700" data-tab="parametres">
                        Paramètres
                    </button>
                </nav>
            </div>

            <!-- Tab Content: Profil -->
            <div id="tab-profil" class="tab-content p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-2xl text-gray-600"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold"><?php echo $current_user->display_name; ?></h2>
                            <p class="text-gray-600 flex items-center mt-2">
                                <i class="fas fa-calendar mr-2"></i>
                                Membre depuis <?php echo date('F Y', strtotime($current_user->user_registered)); ?>
                            </p>
                        </div>
                    </div>
                    <button id="edit-profile-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Modifier
                    </button>
                </div>

                <form id="profile-form" class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                            <input type="text" id="first_name" name="first_name" 
                                   value="<?php echo esc_attr($current_user->first_name); ?>" disabled
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="last_name" name="last_name" 
                                   value="<?php echo esc_attr($current_user->last_name); ?>" disabled
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="user_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-envelope text-gray-500"></i>
                                <input type="email" id="user_email" name="user_email" 
                                       value="<?php echo esc_attr($current_user->user_email); ?>" disabled
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-phone text-gray-500"></i>
                                <input type="tel" id="telephone" name="telephone" 
                                       value="<?php echo esc_attr(get_user_meta($current_user->ID, 'telephone', true)); ?>" disabled
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">À propos de moi</label>
                        <textarea id="description" name="description" rows="3" disabled
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo esc_textarea(get_user_meta($current_user->ID, 'description', true)); ?></textarea>
                    </div>

                    <button type="submit" id="save-profile-btn" class="hidden bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Sauvegarder
                    </button>
                </form>
            </div>

            <!-- Tab Content: Demandes -->
            <div id="tab-demandes" class="tab-content p-6 hidden">
                <h3 class="text-xl font-semibold mb-4">Mes demandes de réparation</h3>
                <p class="text-gray-600 mb-6">Suivez l'état de vos demandes et consultez l'historique</p>

                <?php
                $demandes = get_posts(array(
                    'post_type' => 'demande',
                    'meta_query' => array(
                        array(
                            'key' => 'email_client',
                            'value' => $current_user->user_email,
                            'compare' => '='
                        )
                    ),
                    'posts_per_page' => -1
                ));

                if ($demandes) :
                    foreach ($demandes as $demande) :
                        $statut = get_post_meta($demande->ID, 'statut_demande', true) ?: 'en_attente';
                        $urgence = get_post_meta($demande->ID, 'urgence', true);
                        $budget = get_post_meta($demande->ID, 'budget', true);
                        
                        $statut_colors = array(
                            'en_attente' => 'bg-yellow-100 text-yellow-800',
                            'en_cours' => 'bg-blue-100 text-blue-800',
                            'termine' => 'bg-green-100 text-green-800'
                        );
                        $statut_color = $statut_colors[$statut] ?? 'bg-gray-100 text-gray-800';
                ?>
                <div class="border rounded-lg p-4 mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-semibold text-lg"><?php echo esc_html($demande->post_title); ?></h4>
                        <span class="px-2 py-1 rounded-full text-xs font-medium <?php echo $statut_color; ?>">
                            <?php echo ucfirst(str_replace('_', ' ', $statut)); ?>
                        </span>
                    </div>
                    <div class="grid md:grid-cols-4 gap-2 text-sm text-gray-600 mb-3">
                        <div>
                            <span class="font-medium">Date:</span> <?php echo get_the_date('d/m/Y', $demande->ID); ?>
                        </div>
                        <?php if ($urgence) : ?>
                        <div>
                            <span class="font-medium">Urgence:</span> <?php echo ucfirst($urgence); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($budget) : ?>
                        <div>
                            <span class="font-medium">Budget:</span> <?php echo $budget; ?>€
                        </div>
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-700 mb-3"><?php echo wp_trim_words($demande->post_content, 20); ?></p>
                    <div class="flex space-x-2">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-1 px-3 rounded">
                            Voir détails
                        </button>
                        <?php if ($statut === 'termine') : ?>
                        <button class="border border-yellow-600 text-yellow-600 hover:bg-yellow-50 text-sm font-bold py-1 px-3 rounded">
                            <i class="fas fa-star mr-1"></i>Évaluer
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php 
                    endforeach;
                else :
                ?>
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">Vous n'avez pas encore fait de demande</p>
                    <a href="<?php echo home_url('/poster-demande'); ?>" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Poster ma première demande
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tab Content: Paramètres -->
            <div id="tab-parametres" class="tab-content p-6 hidden">
                <h3 class="text-xl font-semibold mb-4 flex items-center">
                    <i class="fas fa-cog mr-2"></i>Paramètres du compte
                </h3>
                <p class="text-gray-600 mb-6">Gérez vos préférences et paramètres de confidentialité</p>

                <div class="space-y-6">
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Notifications</h4>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Notifications par email</p>
                                    <p class="text-sm text-gray-600">Recevoir les mises à jour par email</p>
                                </div>
                                <input type="checkbox" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium">Notifications SMS</p>
                                    <p class="text-sm text-gray-600">Recevoir les alertes importantes par SMS</p>
                                </div>
                                <input type="checkbox" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold mb-4">Sécurité</h4>
                        <div class="space-y-3">
                            <button class="w-full text-left border border-gray-300 rounded-md px-4 py-2 hover:bg-gray-50">
                                Changer le mot de passe
                            </button>
                            <button class="w-full text-left border border-gray-300 rounded-md px-4 py-2 hover:bg-gray-50">
                                Télécharger mes données
                            </button>
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <h4 class="text-lg font-semibold mb-4 text-red-600">Zone de danger</h4>
                        <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Supprimer mon compte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Gestion des onglets
document.querySelectorAll('.tab-button').forEach(button => {
    button.addEventListener('click', function() {
        const tabName = this.dataset.tab;
        
        // Masquer tous les contenus d'onglets
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Réinitialiser tous les boutons d'onglets
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-blue-500', 'text-blue-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        
        // Activer l'onglet sélectionné
        this.classList.remove('border-transparent', 'text-gray-500');
        this.classList.add('border-blue-500', 'text-blue-600');
        
        // Afficher le contenu de l'onglet
        document.getElementById('tab-' + tabName).classList.remove('hidden');
    });
});

// Gestion de l'édition du profil
document.getElementById('edit-profile-btn').addEventListener('click', function() {
    const inputs = document.querySelectorAll('#profile-form input, #profile-form textarea');
    const saveBtn = document.getElementById('save-profile-btn');
    
    if (this.textContent === 'Modifier') {
        inputs.forEach(input => {
            if (input.id !== 'user_email') { // L'email ne peut pas être modifié
                input.disabled = false;
            }
        });
        this.textContent = 'Annuler';
        this.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        this.classList.add('bg-gray-600', 'hover:bg-gray-700');
        saveBtn.classList.remove('hidden');
    } else {
        inputs.forEach(input => input.disabled = true);
        this.textContent = 'Modifier';
        this.classList.remove('bg-gray-600', 'hover:bg-gray-700');
        this.classList.add('bg-blue-600', 'hover:bg-blue-700');
        saveBtn.classList.add('hidden');
    }
});

// Sauvegarde du profil
document.getElementById('profile-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('action', 'update_user_profile');
    formData.append('nonce', '<?php echo wp_create_nonce('fixeopro_nonce'); ?>');
    
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Profil mis à jour avec succès !');
            location.reload();
        } else {
            alert('Erreur lors de la mise à jour du profil.');
        }
    });
});
</script>

<?php get_footer(); ?>
