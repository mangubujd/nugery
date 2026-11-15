<div class="lqd-pf-column <?php $this->get_grid_class() ?> col-sm-6 col-xs-12 masonry-item <?php $this->entry_term_classes() ?>">

	<article<?php echo liquid_helper()->html_attributes( $attributes ) ?>>
		<div class="lqd-pf-item-inner">

			<div class="lqd-pf-img mb-3 pos-rel border-radius-6 overflow-hidden">
				<figure>
					<?php $this->entry_thumbnail(); ?>
				</figure>
				<span class="lqd-pf-overlay-bg lqd-overlay d-flex align-items-center justify-content-center">
					<i class="lqd-icn-ess icon-md-arrow-forward"></i>
				</span>
			</div>

			<div class="lqd-pf-details">
				<?php $title_tag = isset( $title_tag ) ? $title_tag : 'h2'; ?>
				<?php the_title( sprintf('<%s class="lqd-pf-title mt-0 mb-1 h5">', $title_tag), sprintf('</%s>', $title_tag) ) ?>
				<?php $this->entry_cats() ?>

			</div>

			<?php $this->get_overlay_button(); ?>

		</div>
	</article>

</div>