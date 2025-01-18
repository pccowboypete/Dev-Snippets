add_action('woocommerce_variation_options', 'add_additional_variation_image_ids', 10, 3);
function add_additional_variation_image_ids($loop, $variation_data, $variation)
{
	$variation_id = $variation->ID;
	$variation_object = wc_get_product($variation_id);

	$attachment_ids = $variation_object->get_meta('additional_img_ids'); // Get Attachments Ids
	$attachment_ids = empty($attachment_ids) ? array(0 => '') : $attachment_ids;
	$count = count($attachment_ids);
	$placeholder = esc_url(wc_placeholder_img_src());

	$upload_img_txt = esc_html__('Upload an image', 'woocommerce');
	$remove_img_txt = esc_html__('Remove this image', 'woocommerce');
	$add_txt = esc_html__('Add', 'woocommerce');
	$remove_txt = esc_html__('Remove', 'woocommerce');

	echo '<div class="custom-uploads">
    <h4>' . __('Additional images:', 'woocommerce') . '</h4>';

	// Loop through each existing attachment image ID
	foreach ($attachment_ids as $index => $image_id) {
		// Add an Image field
		printf('<div class="image-box"><p class="form-row form-row-wide upload_image">
            <a href="#" class="upload_image_button tips %s" data-tip="%s" rel="%s"><img src="%s" />
            <input type="hidden" name="additional_img_ids-%s-%s" class="upload_image_id" value="%s" /></a>
            <p></div>',
			$image_id ? 'remove' : '',
			$image_id ? $remove_img_txt : $upload_img_txt,
			$variation_id,
			$image_id ? esc_url(wp_get_attachment_thumb_url($image_id)) : $placeholder,
			$loop,
			$index,
			$image_id
		);
	}
	// Add the buttons
	printf('<div class="buttons-box"><p>
        <button type="button" class="add-slot" data-loop="%d">%s</button>
        <button type="button" class="remove-slot" data-loop="%d"%s>%s</button>
        <input type="hidden" name="slot-index-%d" value="%s" /><input type="hidden" name="ph-img-%s" value="%s" /></a><p></div>',
		$loop,
		$add_txt,
		$loop,
		$count == 1 ? ' style="display:none;"' : '',
		$remove_txt,
		$loop,
		$count,
		$loop,
		$placeholder
	);
	echo '</div>';
}

add_action('woocommerce_admin_process_variation_object', 'save_additional_variation_image_ids', 10, 2);
function save_additional_variation_image_ids($variation, $i)
{
	if (isset($_POST["slot-index-{$i}"]) && $_POST["slot-index-{$i}"] > 1) {
		$attachment_ids = array(); // Initialize

		// Loop through each posted attachment Id for the current variation
		for ($k = 0; $k < $_POST["slot-index-{$i}"]; $k++) {
			if (isset($_POST["additional_img_ids-{$i}-{$k}"]) && !empty($_POST["additional_img_ids-{$i}-{$k}"])) {
				$attachment_ids[$k] = esc_attr($_POST["additional_img_ids-{$i}-{$k}"]); // Set it in the array
			}
		}
		if (!empty($attachment_ids)) {
			$variation->update_meta_data('additional_img_ids', $attachment_ids); // save
		}
	}
}

add_action('admin_footer', 'additional_variation_image_js');
function additional_variation_image_js()
{
	global $pagenow, $typenow;

	if (in_array($pagenow, array('post.php', 'post-new.php')) && $typenow === 'product'):
		?>
		<script>
			jQuery(function ($) {
				$('body').on('click', '.add-slot', function () {
					const parent = $(this).closest('.custom-uploads'),
						loop = $(this).data('loop');

					var lastImageBox = $(parent).find('.image-box:last'),
						hiddenInput = $('[name=slot-index-' + loop + ']'),
						index = parseInt(hiddenInput.val()),
						inputNameUpd = 'additional_img_ids-' + loop + '-' + index,
						inputPropsUpd = { 'name': inputNameUpd, 'value': null }
					placeholder = $('[name=ph-img-' + loop + ']').val(),
						clonedImgBox = lastImageBox.clone().insertBefore('.buttons-box'); // Insert a clone

					clonedImgBox.find('.upload_image_id').prop(inputPropsUpd);
					clonedImgBox.find('img').prop('src', placeholder);
					clonedImgBox.find('a').removeClass('remove');
					hiddenInput.val(index + 1);

					if (index == 1) {
						$(this).parent().find('.remove-slot').show();
					}
				}).on('click', '.remove-slot', function () {
					const parent = $(this).closest('.custom-uploads'),
						loop = $(this).data('loop');

					var lastImageBox = $(parent).find('.image-box:last'),
						hiddenInput = $('[name=slot-index-' + loop + ']'),
						index = parseInt(hiddenInput.val());

					lastImageBox.remove();
					hiddenInput.val(index - 1);

					if (index == 2) {
						$(this).hide();
					}
				});
			});
		</script>
		<?php
	endif;
}
