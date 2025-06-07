<?php
/*
Template Name: Devenir réparateur
*/

get_header();
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Rejoignez le réseau FixeoPro</h1>
            <p class="text-lg text-gray-600 mb-6">
                Développez votre activité en rejoignant la première plateforme de mise en relation avec des clients
            </p>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-blue-900 mb-4">Offre de lancement : 29€/mois au lieu de 49€</h2>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        Accès illimité aux demandes
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        Profil professionnel complet
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        Support client dédié
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8 mb-8">
            <div class="bg-white border rounded-lg p-6 text-center shadow-sm">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-users text-4xl text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Clients qualifiés</h3>
                <p class="text-gray-600">Recevez des demandes de clients sérieux dans votre zone</p>
            </div>
            <div class="bg-white border rounded-lg p-6 text-center shadow-sm">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-chart-line text-4xl text-green-600"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Développez votre activité</h3>
                <p class="text-gray-600">Augmentez votre chiffre d'affaires avec de nouvelles missions</p>
            </div>
            <div class="bg-white border rounded-lg p-6 text-center shadow-sm">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-star text-4xl text-yellow-600"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Visibilité renforcée</h3>
                <p class="text-gray-600">Profitez de notre référencement pour être trouvé facilement</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Inscription professionnelle</h2>
                <p class="text-gray-600">
                    Remplissez ce formulaire pour rejoindre notre réseau de professionnels certifiés
                </p>
            </div>

            <form id="reparateur-form" class="space-y-6">
                <?php wp_nonce_field('fixeopro_nonce', 'nonce'); ?>
                
                <!-- Informations personnelles -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Informations personnelles</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom *</label>
                            <input type="text" id="prenom" name="prenom" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom *</label>
                            <input type="text" id="nom" name="nom" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone *</label>
                            <input type="tel" id="telephone" name="telephone" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Informations entreprise -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Informations entreprise</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="nom_entreprise" class="block text-sm font-medium text-gray-700">Nom de l'entreprise *</label>
                            <input type="text" id="nom_entreprise" name="nom_entreprise" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="siret" class="block text-sm font-medium text-gray-700">SIRET *</label>
                            <input type="text" id="siret" name="siret" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse *</label>
                            <input type="text" id="adresse" name="adresse" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="ville" class="block text-sm font-medium text-gray-700">Ville *</label>
                            <input type="text" id="ville" name="ville" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="code_postal" class="block text-sm font-medium text-gray-700">Code postal *</label>
                            <input type="text" id="code_postal" name="code_postal" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Compétences -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Vos compétences</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Catégories de réparation *</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'categorie_reparation',
                                    'hide_empty' => false
                                ));
                                foreach ($categories as $category) :
                                ?>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="categories[]" value="<?php echo $category->slug; ?>" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm"><?php echo $category->name; ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="experience" class="block text-sm font-medium text-gray-700">Années d'expérience *</label>
                            <select id="experience" name="experience" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez votre expérience</option>
                                <option value="0-2">Moins de 2 ans</option>
                                <option value="2-5">2 à 5 ans</option>
                                <option value="5-10">5 à 10 ans</option>
                                <option value="10+">Plus de 10 ans</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Présentation de votre activité *</label>
                            <textarea id="description" name="description" required rows="4"
                                      placeholder="Décrivez votre expertise, vos services, ce qui vous différencie..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Zone d'intervention -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Zone d'intervention</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="rayon_intervention" class="block text-sm font-medium text-gray-700">Rayon d'intervention *</label>
                            <select id="rayon_intervention" name="rayon_intervention" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez votre rayon</option>
                                <option value="10">10 km</option>
                                <option value="20">20 km</option>
                                <option value="30">30 km</option>
                                <option value="50">50 km</option>
                                <option value="100">100 km</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="villes_intervention" class="block text-sm font-medium text-gray-700">Villes principales d'intervention</label>
                            <input type="text" id="villes_intervention" name="villes_intervention" 
                                   placeholder="Ex: Paris, Boulogne, Neuilly..."
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Documents requis</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="kbis" class="block text-sm font-medium text-gray-700">Extrait K-bis *</label>
                            <input type="file" id="kbis" name="kbis" accept=".pdf,.jpg,.jpeg,.png" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="space-y-2">
                            <label for="assurance" class="block text-sm font-medium text-gray-700">Attestation d'assurance *</label>
                            <input type="file" id="assurance" name="assurance" accept=".pdf,.jpg,.jpeg,.png" required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="conditions" name="conditions" required 
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="conditions" class="text-sm text-gray-700">
                        J'accepte les conditions d'utilisation et je souhaite souscrire à l'abonnement FixeoPro (29€/mois) *
                    </label>
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg text-lg">
                    Finaliser mon inscription (29€/mois)
                </button>
            </form>
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-600">
                💳 Paiement sécurisé • 📞 Support client • 🔄 Résiliation possible à tout moment
            </p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
