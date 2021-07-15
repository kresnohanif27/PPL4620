<div class="sina-pro-wc-profil-action">
	<button class="sina-button sina-pro-wc-profil-submit" type="submit"><?php printf('%s', $data['filter_action_label']); ?></button>
	<a href="<?php global $wp; echo esc_url(home_url( $wp->request )); ?>" class="sina-pro-wc-profil-reset"><?php printf('%s', $data['filter_reset_label']); ?></a>
</div>