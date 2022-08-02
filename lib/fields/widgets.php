<?php
use Carbon_Fields\Block;
use Carbon_Fields\Widget;
use Carbon_Fields\Field;


class Contact_Us_Widget_office_locations extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {

        $this->setup( 'Contact_Us_Widget_office_locations', 'Contact Us Footer Office Locations', 'Display Contact us info in footer area.', array(
            Field::make( 'text', 'footer_office_locations_heading', __('Heading', THEME_TEXTDOMAIN))
        ) );
    }
    // Called when rendering the widget in the front-end
    function front_end( $args, $instance ) {
        $footer_address =  carbon_get_theme_option( 'office_locations');
        ?>

        <h2 class="text-green h3">
            <?php
            $footer_section_1_heading =  $instance['footer_office_locations_heading'];
            echo $footer_section_1_heading;
            ?>
        </h2>
        <?php
        foreach($footer_address as $address){
            ?>
            <div class="" style="display:none">
                <?php //print_r($address); ?>
            </div>
            <ul class="list-unstyled">
                <?php
                $contact_us_address =  $address['contact_us_address_theme_options'];
                $footer_map_link = 'https://www.google.com/maps/place/'.$contact_us_address.'/@'.$address['google_map_locations_theme_options']['value']. ','.$address['google_map_locations_theme_options']['zoom']. 'z';
                if(!empty($contact_us_address)):
                    ?>
                    <li>
                        <a href="<?php echo $footer_map_link ?>" target="_blank">

                            <i class="fa-solid fa-location-dot cmn-icon"></i><span class="d-inline-block"><?php echo $contact_us_address; ?></span>
                        </a>
                    </li>
                <?php endif;
                if(!empty($address['contact_us_contact_number_theme_options'])):
                    ?>
                    <li><a href="tel:<?php echo $phone_number = $address['contact_us_contact_number_theme_options']; ?>"><i class="fa-solid fa-phone cmn-icon"></i><span class="d-inline-block"><?php
                            $phone_number = $address['contact_us_contact_number_theme_options'];
                            echo $phone_number
                            ?></span>
                        </a>
                    </li>
                <?php endif;
                if(!empty($address['contact_us_email_theme_options'])):
                    ?>
                    <li>
                        <a href="mailto:<?php echo $address['contact_us_email_theme_options']; ?>"><i
                                    class="bi bi-envelope-fill cmn-icon"></i><span class="d-inline-block"><?php
                            $email_address = $address['contact_us_email_theme_options'];
                            echo $email_address;
                            ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php } ?>
        <?php
    }
}
add_action('widgets_init', function() {
    register_widget( 'Contact_Us_Widget_office_locations' );
});


Class footer_logo_Widget extends Widget {
    // Register widget function. Must have the same name as the class
    function __construct() {
        $this->setup( 'footer_logo_image', 'Footer Logo', 'Displays Footer Logo', array(
            Field::make( 'image', 'footer_logo_widgets', __('Add Footer Logo', THEME_TEXTDOMAIN))
        ) );
    }
    // Called when rendering the widget in the front-end
    function front_end( $args, $instance ) {
        ?>

            <a href="<?php echo get_bloginfo('url') ?>" class="site-logo">
                <?php
                $footer_logo =  $instance['footer_logo_widgets'];
                $footer_attached_images = get_media_url($footer_logo,'footer-logo');
                if(!empty($footer_logo)):
                    echo '<img class="img-fluid" src="'.$footer_attached_images.'" alt="Site Logo">';
                endif;
                ?>
            </a>

        <?php
    }
}
add_action('widgets_init', function() {
    register_widget( 'footer_logo_Widget' );
});
