<?php get_header(); ?>

<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-icon">
                    <div class="hero-icon-bg">
                        <i class="fas fa-wrench"></i>
                    </div>
                </div>
                <h1 class="hero-title">
                    🔧 FixeoPro.fr – Trouvez rapidement un expert pour vos réparations et dépannages
                </h1>
                <p class="hero-description">
                    FixeoPro.fr est la plateforme de référence pour toute personne à la recherche d'un professionnel de la
                    réparation ou du dépannage, près de chez elle. Notre mission est simple : vous trouver un expert qualifié,
                    rapidement, et en toute confiance.
                </p>
                <div class="hero-buttons">
                    <a href="<?php echo home_url('/poster-demande'); ?>" class="btn btn-secondary btn-lg">
                        Poster une demande gratuite
                    </a>
                    <a href="<?php echo home_url('/devenir-reparateur'); ?>" class="btn btn-outline btn-lg">
                        Devenir réparateur
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="section bg-white">
        <div class="container">
            <div class="text-center mb-8">
                <h2 class="section-title">✅ Une plateforme simple, rapide et efficace</h2>
                <p class="section-description">Notre service repose sur un fonctionnement clair</p>
            </div>
            <div class="grid grid-cols-3 max-w-4xl mx-auto">
                <div class="card text-center">
                    <div class="step-number step-1">1</div>
                    <h3 class="card-title">Décrivez votre panne</h3>
                    <p class="card-description">Vous décrivez votre panne ou votre besoin via un formulaire intuitif.</p>
                </div>
                <div class="card text-center">
                    <div class="step-number step-2">2</div>
                    <h3 class="card-title">Nous trouvons l'expert</h3>
                    <p class="card-description">Nous identifions pour vous les experts disponibles dans votre région.</p>
                </div>
                <div class="card text-center">
                    <div class="step-number step-3">3</div>
                    <h3 class="card-title">Mise en relation</h3>
                    <p class="card-description">
                        Vous recevez rapidement une mise en relation avec un professionnel de confiance.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why choose us -->
    <section class="section bg-gray-50">
        <div class="container">
            <div class="text-center mb-8">
                <h2 class="section-title">🔍 Pourquoi choisir FixeoPro.fr ?</h2>
            </div>
            <div class="grid grid-cols-4">
                <div class="card text-center">
                    <div class="card-icon">
                        <i class="fas fa-clock" style="color: var(--primary-color);"></i>
                    </div>
                    <h3 class="card-title">Intervention rapide</h3>
                    <p class="card-description">Trouvez un expert disponible immédiatement</p>
                </div>
                <div class="card text-center">
                    <div class="card-icon">
                        <i class="fas fa-shield-alt" style="color: var(--secondary-color);"></i>
                    </div>
                    <h3 class="card-title">Qualité garantie</h3>
                    <p class="card-description">Professionnels sélectionnés et évalués</p>
                </div>
                <div class="card text-center">
                    <div class="card-icon">
                        <i class="fas fa-map-marker-alt" style="color: var(--accent-color);"></i>
                    </div>
                    <h3 class="card-title">Proximité locale</h3>
                    <p class="card-description">Des experts près de chez vous</p>
                </div>
                <div class="card text-center">
                    <div class="card-icon">
                        <i class="fas fa-star" style="color: #eab308;"></i>
                    </div>
                    <h3 class="card-title">Transparence totale</h3>
                    <p class="card-description">Tarifs clairs, pas de frais cachés</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="section bg-white">
        <div class="container">
            <div class="text-center mb-8">
                <h2 class="section-title">🛠️ Tous les domaines de réparation couverts</h2>
                <p class="section-description">FixeoPro.fr couvre un large éventail de services</p>
            </div>
            <div class="grid grid-cols-4">
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'categorie_reparation',
                    'hide_empty' => false
                ));
                
                $icons = array(
                    'electromenager' => '🔌',
                    'informatique' => '💻',
                    'plomberie' => '🔧',
                    'electricite' => '⚡',
                    'chauffage' => '🔥',
                    'serrurerie' => '🔐',
                    'multimedia' => '📺',
                    'climatisation' => '❄️'
                );
                
                foreach ($categories as $category) :
                    $icon = isset($icons[$category->slug]) ? $icons[$category->slug] : '🔧';
                    $count = $category->count;
                ?>
                <div class="card text-center">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;"><?php echo $icon; ?></div>
                    <h3 class="card-title"><?php echo $category->name; ?></h3>
                    <p class="card-description"><?php echo $count; ?> expert<?php echo $count > 1 ? 's' : ''; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section" style="background: linear-gradient(135deg, var(--primary-color), #4f46e5); color: white;">
        <div class="container text-center">
            <h2 class="section-title" style="color: white;">FixeoPro.fr, c'est bien plus qu'un annuaire de réparateurs.</h2>
            <p class="section-description" style="color: rgba(255,255,255,0.9);">
                C'est une solution sur-mesure, pensée pour vous simplifier la vie, avec un seul objectif : vous trouver un
                expert pour vous, au moment où vous en avez besoin.
            </p>
            <div class="hero-buttons">
                <a href="<?php echo home_url('/poster-demande'); ?>" class="btn btn-lg" style="background: white; color: var(--primary-color);">
                    Faire une demande gratuite
                </a>
                <a href="<?php echo home_url('/devenir-reparateur'); ?>" class="btn btn-lg" style="border: 2px solid white; color: white; background: transparent;">
                    Rejoindre nos experts
                </a>
            </div>
            <p class="mt-6" style="color: rgba(255,255,255,0.8);">
                ➡️ Inscrivez-vous gratuitement ou faites une demande d'intervention dès maintenant sur www.fixeopro.fr
            </p>
        </div>
    </section>
</div>

<?php get_footer(); ?>
