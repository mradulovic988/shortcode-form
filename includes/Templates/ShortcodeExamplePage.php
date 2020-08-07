<?php
/**
 * Example page which will list all examples with shortcodes
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    ExamplePage
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Templates;
?>

<div class="wrap">
    <h1 class="scf-wp-heading-inline"><?= __( 'Shortcodes Example', 'shortcode-form' ) ?></h1>
    <table class="widefat fixed" cellspacing="0">
        <thead>
        <tr>
            <th id="columnname" class="manage-column column-columnname" scope="col"><?= __( 'Description', 'shortcode-form' ) ?></th>
            <th id="columnname" class="manage-column column-columnname" scope="col"><?= __( 'Shortcode', 'shortcode-form' ) ?></th>
            <th class="manage-column column-columnname" scope="col"><?= __( 'Shortcode for template file', 'shortcode-form' ) ?></th>

        </tr>
        </thead>

        <tfoot>
        <tr>
            <th class="manage-column column-columnname" scope="col"><?= __( 'Description', 'shortcode-form' ) ?></th>
            <th class="manage-column column-columnname" scope="col"><?= __( 'Shortcode', 'shortcode-form' ) ?></th>
            <th class="manage-column column-columnname" scope="col"><?= __( 'Shortcode for template file', 'shortcode-form' ) ?></th>

        </tr>
        </tfoot>
        <tbody>
        <tr class="alternate">
            <td class="column-columnname">
                <?= __( 'To show form anywhere on your website', 'shortcode-form' ) ?>
            </td>
            <td class="column-columnname">
                <input type="text" class="shortcodeExplain" onfocus="this.select();" readonly="readonly" value="[form_inquiry]">
            </td>
            <td class="column-columnname">
                <input type="text" class="shortcodeExplain" onfocus="this.select();" readonly="readonly" value="<?= '<?php echo do_shortcode( \'[form_inquiry]\' ); ?>'; ?>">
            </td>
        </tr>

        <tr class="alternate">
            <td class="column-columnname">
                <?= __( 'To list all of the users anywhere on the website', 'shortcode-form' ) ?>
            </td>
            <td class="column-columnname">
                <input type="text" class="shortcodeExplain" onfocus="this.select();" readonly="readonly" value="[form_user_list]">
            </td>
            <td class="column-columnname">
                <input type="text" class="shortcodeExplain" onfocus="this.select();" readonly="readonly" value="<?= '<?php echo do_shortcode( \'[form_user_list]\' ); ?>'; ?>">
            </td>
        </tr>

        </tbody>
    </table>

</div>