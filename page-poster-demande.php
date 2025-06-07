<?php
/*
Template Name: Poster une demande
*/

get_header();
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Poster une demande de réparation</h1>
            <p class="text-lg text-gray-600">
                Décrivez votre problème et trouvez rapidement un expert près de chez vous
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Informations de contact</h2>
                <p class="text-gray-600">
                    Ces informations nous permettront de vous mettre en relation avec les bons professionnels
                </p>
            </div>

            <form id="demande-form" class="space-y-6">
                <?php wp_nonce_field('fixeopro_nonce', 'nonce'); ?>
                
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
                </div>

                <div class="grid md:grid-cols-2 gap-4">
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

                <div class="grid md:grid-cols-3 gap-4">
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
                    <div class="space-y-2">
                        <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                        <input type="text" id="adresse" name="adresse" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Détails de la réparation</h3>

                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div class="space-y-2">
                            <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie *</label>
                            <select id="categorie" name="categorie" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez une catégorie</option>
                                <?php
                                $categories = get_terms(array(
                                    'taxonomy' => 'categorie_reparation',
                                    'hide_empty' => false
                                ));
                                foreach ($categories as $category) :
                                ?>
                                <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="urgence" class="block text-sm font-medium text-gray-700">Niveau d'urgence *</label>
                            <select id="urgence" name="urgence" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Sélectionnez l'urgence</option>
                                <option value="urgent">Urgent (dans les 24h)</option>
                                <option value="rapide">Rapide (dans les 3 jours)</option>
                                <option value="normal">Normal (dans la semaine)</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2 mb-4">
                        <label for="titre" class="block text-sm font-medium text-gray-700">Titre de votre demande *</label>
                        <input type="text" id="titre" name="titre" required 
                               placeholder="Ex: Lave-linge qui ne vidange plus"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="space-y-2 mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description détaillée *</label>
                        <textarea id="description" name="description" required rows="4"
                                  placeholder="Décrivez précisément le problème, les symptômes, ce qui s'est passé..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="space-y-2 mb-4">
                        <label for="budget" class="block text-sm font-medium text-gray-700">Budget approximatif</label>
                        <select id="budget" name="budget" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionnez votre budget</option>
                            <option value="0-50">Moins de 50€</option>
                            <option value="50-100">50€ - 100€</option>
                            <option value="100-200">100€ - 200€</option>
                            <option value="200-500">200€ - 500€</option>
                            <option value="500+">Plus de 500€</option>
                        </select>
                    </div>

                    <div class="space-y-2 mb-6">
                        <label for="photos" class="block text-sm font-medium text-gray-700">Photos (optionnel)</label>
                        <input type="file" id="photos" name="photos[]" multiple accept="image/*" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500">
                            Ajoutez des photos pour aider les professionnels à mieux comprendre le problème
                        </p>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="conditions" name="conditions" required 
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="conditions" class="text-sm text-gray-700">
                        J'accepte les conditions d'utilisation et la politique de confidentialité *
                    </label>
                </div>

                <button type="submit" 
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg text-lg">
                    Envoyer ma demande gratuitement
                </button>
            </form>
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-600">
                🔒 Vos données sont protégées et ne seront partagées qu'avec les professionnels sélectionnés
            </p>
        </div>
    </div>
</div>

<script>
document.getElementById('demande-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('action', 'submit_demande');
    
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.data.message);
            this.reset();
        } else {
            alert(data.data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Une erreur est survenue. Veuillez réessayer.');
    });
});
</script>

<?php get_footer(); ?>
