<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );?>

<div class="columns">
	<div class="col-g">
		<?php if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif;
		the_content(); ?>
	</div>

	<div class="col-d">
		<table>
			<tbody>
				<?php 
				$caracteristiques = get_field('caracteristiques_du_produit');

				if(have_rows('caracteristiques_du_produit')):
					while(have_rows('caracteristiques_du_produit')): the_row('caracteristiques_du_produit');
						$grpCara = get_sub_field('caracteristiques');
						$titleGrp = get_sub_field('section_caracteristique');

						echo '<tr><td colspan="2"><h3>'.$titleGrp.'</h3></td></tr>';
						
						$i = 0;
						if($grpCara):
							foreach($grpCara as $sCara):
								$titleCara = $sCara['libelle'];
								$valueCara = $sCara['valeur'];?>

								<tr <?php echo ($i % 2 == 0) ? 'class="-gray"' : '';?>>
									<td><p><?php echo $titleCara;?></p></td>
									<td><p><?php echo $valueCara;?></p></td>
								</tr>
							<?php $i++;
							endforeach;
						endif;
					endwhile;
				endif;?>
			</tbody>
		</table>
	</div>
</div>