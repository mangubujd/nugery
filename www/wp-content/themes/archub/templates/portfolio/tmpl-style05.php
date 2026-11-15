<div class="carousel-item col-xs-12 col-sm-6 col-md-4 <?php $this->entry_term_classes() ?>">

	<div class="carousel-item-inner">
		<div class="carousel-item-content">

			<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
				<div class="lqd-pf-item-inner lqd-overlay d-flex align-items-end">

					<div class="lqd-pf-img overflow-hidden lqd-overlay">
						<?php $this->entry_thumbnail(); ?>
						<span class="lqd-pf-overlay-bg lqd-overlay"></span>
					</div>

					<div class="lqd-pf-details w-100 ps-4 pe-4 pos-rel">
						<?php $title_tag = isset( $title_tag ) ? $title_tag : 'h2'; ?>
						<?php the_title( sprintf('<%s class="lqd-pf-title m-0 h5">', $title_tag), sprintf('</%s>', $title_tag) ) ?>
						<?php $this->entry_cats() ?>
					</div>

					<?php $this->get_overlay_button(); ?>

				</div>
			</article>

		</div>
	</div>

</div>