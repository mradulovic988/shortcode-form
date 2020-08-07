<?php
/**
 * User list page which will list all data from the database
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    UserListPage
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Templates;

use Inc\Base\Scf_Functions;

$function = new Scf_Functions();
?>

<div class="wrap">
    <h1 class="scf-wp-heading-inline"><?= __( 'Users List', 'shortcode-form' ) ?></h1>
    <table class="widefat fixed" cellspacing="0">
        <thead>
        <tr>
            <th id="columnname" class="manage-column column-columnname" scope="col"><?= __( 'No.', 'shortcode-form' ) ?></th>
            <th id="columnname" class="manage-column column-columnname" scope="col"><?= __( 'First Name', 'shortcode-form' ) ?></th>
            <th id="columnname" class="manage-column column-columnname" scope="col"><?= __( 'Last Name', 'shortcode-form' ) ?></th>
            <th id="columnname" class="manage-column column-columnname" scope="col"><?= __( 'Email', 'shortcode-form' ) ?></th>
            <th id="columnname" class="manage-column column-columnname" scope="col"><?= __( 'Subject', 'shortcode-form' ) ?></th>

        </tr>
        </thead>

        <tfoot>
        <tr>
            <th class="manage-column column-columnname" scope="col"><?= __( 'No.', 'shortcode-form' ) ?></th>
            <th class="manage-column column-columnname" scope="col"><?= __( 'First Name', 'shortcode-form' ) ?></th>
            <th class="manage-column column-columnname" scope="col"><?= __( 'Last Name', 'shortcode-form' ) ?></th>
            <th class="manage-column column-columnname" scope="col"><?= __( 'Email', 'shortcode-form' ) ?></th>
            <th class="manage-column column-columnname" scope="col"><?= __( 'Subject', 'shortcode-form' ) ?></th>

        </tr>
        </tfoot>

        <tbody>

        <?php

        /**
         * Function for listing all of the values from
         * the database except the message field
         *
         * @package collectData
         * @author Marko Radulovic <mradulovic988@gmail.com>
         */
        $function->collectData();
        ?>

        </tbody>
    </table>
</div>