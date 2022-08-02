<?php
?>
<header class="main-header">
    <nav class="navbar bg-white navbar-expand-xl bg-light p-0">
        <div class="container-xxl container container d-block">
             <?php
                get_template_part('page-templates/header/top-header-bar');

                $menu_header_Locations = get_nav_menu_locations();
                $header_menuID = $menu_header_Locations['primary'];

                if(is_nav_menu($header_menuID)) {
             ?>
            <div class="nav-bottom">
                <ul class="list-unstyled list-inline d-flex align-items-center ms-auto custom-devider d-block d-xl-none">
                    <?php $email_address = carbon_get_theme_option( 'email');
                    if(!empty($email_address)){
                    ?>
                    <li class="d-none d-sm-block">
                        <a href="mailto:<?php echo $email_address ; ?>"><i class="bi bi-envelope-fill cmn-icon"></i>
                            <span>
                                <?php
                                echo $email_address ;
                                ?>
                            </span>
                        </a>
                    </li>
                    <?php
                    }
                    $phone_number = carbon_get_theme_option( 'phone');
                    ?>
                    <?php if(!empty($phone_number)){ ?>
                    <li>
                        <a href="tel:<?php echo $phone_number ; ?>">
                            <i class="fa-solid fa-phone cmn-icon"></i><span>
                                <?php
                                echo $phone_number;
                                ?>
                            </span>
                        </a>
                    </li>
                    <?php
                     }
                     $spanish_speaking_phone_number = carbon_get_theme_option( 'spanish-speaking-phone-number');
                     if(!empty($spanish_speaking_phone_number)){
                    ?>
                    <li>
                        <a class="small-text-wrap" href="tel:<?php echo $spanish_speaking_phone_number; ?>">
                            <span>
                                <?php
                                echo $spanish_speaking_phone_number;
                                ?>
                            </span>
                            <span class="small-text">
                                <?php
                                echo $spanish_text = carbon_get_theme_option( 'spanish-text');
                                ?>
                            </span>
                        </a>
                    </li>
                     <?php } ?>
                </ul>
                <div class="collapse navbar-collapse" id="mainNavbarContent">
                    <ul class="navbar-nav justify-content-md-between flex-grow-1 mb-2 mb-xl-0">
                        <?php
                        $menu_active_class = __( 'active',THEME_TEXTDOMAIN  );;
                        $menu_non_active_class = __( 'non-active',THEME_TEXTDOMAIN  );;
                            // get object of wp nav menu from menu.
                            $menu_object = wp_get_nav_menu_object($header_menuID);
                            $array_menu = wp_get_nav_menu_items($menu_object->term_id);
                            // Get menu tree with menu children object
                            $menu_items = wp_get_mega_menu_tree($array_menu);
                            $get_main_items = wp_get_nav_menu_items($header_menuID);
                            _wp_menu_item_classes_by_context( $get_main_items );
                            $ancestor_array = array();
                            foreach($get_main_items as $item) {
                            if ($item->current_item_ancestor && !$item->current) {
                                $ancestor_array[] = $item->object_id;
                            }
                            elseif ($item->current){
                                $ancestor_array[] = $item->object_id;
                            }
                        }
                        // loop for parent menu depth 0
                            foreach ($menu_items as $menu_items_main) {
                            $main_items_url = $menu_items_main->url;
                            $main_items_ID = $menu_items_main->object_id;
                                 if($menu_items_main->children){    // Check if menu parent menu have children
                                     $active_class = in_array($main_items_ID,$ancestor_array) ? $menu_active_class : $menu_non_active_class ;

                                     if($menu_items_main->post_name == "services"){  // Check services menu dropdown
                                 ?>
                                <li class="nav-item dropdown dropdown-lg">
                                    <a class="nav-link dropdown-toggle <?php echo $active_class; ?>" href="<?php echo $main_items_url;  ?>" id="servicesDropdown" role="button"
                                       data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <?php echo $menu_items_main->title; ?>
                                    </a>
                                    <div class="dropdown-menu sub-menu-wrap bg-white w-100"
                                         aria-labelledby="servicesDropdown">
                                        <div class="container-xxl container text-center my-xl-5">
                                            <div class="row gx-0">
                                                <?php
                                                   foreach ($menu_items_main->children as $children) {// loop for parent depth 1 menu children
                                                        $main_childern_url = $children->url;
                                                       $active_class = in_array($children->object_id,$ancestor_array)? $menu_active_class : $menu_non_active_class ;


                                                       ?>
                                                <div class="col-xl-3">
                                                    <div class="dropdown dropdown-toggle-wrap">
                                                        <a class="dropdown-heading <?php echo $active_class; ?>" href="<?php echo $main_childern_url; ?>"><?php echo $children->title; ?></a>
                                                        <a href="#" class="nav-link dropdown-toggle"
                                                        id="materialFinancingDropdown" data-bs-auto-close="outside" role="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"></a>
                                                        <ul class="list-unstyled mt-xl-3 dropdown-menu d-xl-block"
                                                            aria-labelledby="materialFinancingDropdown">
                                                           <?php if($children->children){    // Check if children have sub children
                                                            foreach ($children->children as $sub_children) { // loop for children have sub children
                                                                $active_class = in_array($sub_children->object_id,$ancestor_array)? $menu_active_class : $menu_non_active_class ;

                                                                ?>
                                                            <li><a class="dropdown-item <?php echo $active_class; ?>" href="<?php echo $sub_children->url; ?>"><?php echo $sub_children->title; ?></a></li>
                                                            <?php
                                                              }
                                                            }
                                                           ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                     }else{
                                         // else For the menu who don't have large dropdown box

                                         ?>
                                         <li class="nav-item dropdown">
                                             <a class="nav-link dropdown-toggle <?php echo $active_class; ?> <?php echo $menu_items_main->object_id ?>" href="#" id="customDropdown-<?php echo $menu_items_main->object_id ?>" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                 <?php echo $menu_items_main->title; ?>
                                             </a>
                                             <ul class="dropdown-menu <?php echo $menu_items_main->object_id ?>" aria-labelledby="customDropdown-<?php echo $menu_items_main->object_id ?>">
                                                <?php foreach ($menu_items_main->children as $children) {

                                                    $active_class = in_array($children->object_id,$ancestor_array)? $menu_active_class : $menu_non_active_class ;

                                                    $main_childern_url = $children->url;
                                                    $active_class = in_array($children->object_id,$ancestor_array)? $menu_active_class : $menu_non_active_class ;
                                                    echo '<li><a class="dropdown-item js-active" href=' . $main_childern_url . '>' . $children->title . '</a></li>';

                                                }
                                                ?>
                                             </ul>
                                         </li>
                                             <?php
                                     }
                                 }
                                else{ // Main parent menu don't have children
                                    $active_class = in_array($menu_items_main->object_id,$ancestor_array)? $menu_active_class : $menu_non_active_class ;
                                    $main_childern_url = $menu_items_main->url;

                                    echo '<li class="nav-item">';
                                echo '<a class="nav-link '.$active_class.'" aria-current="page" href='.$main_items_url.'>'.$menu_items_main->title.'</a>';
                                echo '</li>';
                                }
                            }
                           ?>
                    </ul>
                </div>
            </div>
            <?php } ?>        
        </div>
    </nav>
</header>
<?php
               
