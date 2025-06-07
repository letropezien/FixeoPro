<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Logo et description -->
            <div class="space-y-4">
                <a href="<?php echo home_url(); ?>" class="flex items-center space-x-2">
                    <div class="bg-blue-600 p-2 rounded-lg">
                        <i class="fas fa-wrench text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold">FixeoPro</span>
                </a>
                <p class="text-gray-300 text-sm">
                    La plateforme de référence pour trouver un professionnel de la réparation près de chez vous.
                </p>
                <div class="flex space-x-4">
                    <div class="flex items-center space-x-2 text-sm">
                        <i class="fas fa-phone"></i>
                        <span>01 23 45 67 89</span>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Services</h3>
                <ul class="space-y-2 text-sm">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'categorie_reparation',
                        'hide_empty' => false,
                        'number' => 6
                    ));
                    foreach ($categories as $category) :
                    ?>
                    <li>
                        <a href="<?php echo get_term_link($category); ?>" class="text-gray-300 hover:text-white">
                            <?php echo $category->name; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Entreprise -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Entreprise</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?php echo home_url('/a-propos'); ?>" class="text-gray-300 hover:text-white">À propos</a></li>
                    <li><a href="<?php echo home_url('/comment-ca-marche'); ?>" class="text-gray-300 hover:text-white">Comment ça marche</a></li>
                    <li><a href="<?php echo home_url('/devenir-reparateur'); ?>" class="text-gray-300 hover:text-white">Devenir réparateur</a></li>
                    <li><a href="<?php echo home_url('/contact'); ?>" class="text-gray-300 hover:text-white">Contact</a></li>
                    <li><a href="<?php echo home_url('/blog'); ?>" class="text-gray-300 hover:text-white">Blog</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="font-semibold text-lg mb-4">Support</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?php echo home_url('/aide'); ?>" class="text-gray-300 hover:text-white">Centre d'aide</a></li>
                    <li><a href="<?php echo home_url('/faq'); ?>" class="text-gray-300 hover:text-white">FAQ</a></li>
                    <li><a href="<?php echo home_url('/conditions'); ?>" class="text-gray-300 hover:text-white">Conditions d'utilisation</a></li>
                    <li><a href="<?php echo home_url('/confidentialite'); ?>" class="text-gray-300 hover:text-white">Politique de confidentialité</a></li>
                    <li><a href="<?php echo home_url('/mentions-legales'); ?>" class="text-gray-300 hover:text-white">Mentions légales</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">© <?php echo date('Y'); ?> FixeoPro.fr. Tous droits réservés.</p>
                <div class="flex items-center space-x-2 text-sm text-gray-400 mt-4 md:mt-0">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Service disponible dans toute la France</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
// Menu mobile
document.getElementById('mobile-menu-button').addEventListener('click', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
});
</script>

</body>
</html>
