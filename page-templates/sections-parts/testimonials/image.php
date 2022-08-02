<?php

$testimonial = $args['testimonial'] ?? null;

?>

<?php if ( $testimonial && $testimonial instanceof \Harbinger_Marketing\Testimonials\Source\SelfHosted\Testimonial ) : ?>

    <div class="text-start">
        <div class="custom-cards bg-white testimonial-card">
            <img src="<?= $testimonial->sourceString() ?>" alt="Testimonial image">
        </div>
    </div>

<?php endif ?>