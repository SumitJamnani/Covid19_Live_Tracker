<div id="btncov-admin-container">
    <div class="grid-x grid-container grid-padding-y admin-settings">
        <div class="cell small-12">
			<div class="callout">
				<h2><?php echo esc_html__( 'Covid19 Datatable Graph & Widget Settings', 'btcorona' );?><span class="v"><?php echo esc_html(BT_CORONA_VER); ?></span></h2>
				<p><?php echo esc_html__( 'This plugin allows adding Covid19 outbreak live datatable, statistics, widgets, graph via shortcode to inform site visitors about changes in the situation about Coronavirus pandemic.', 'btcorona' );?></p>
				<p><a href="<?php echo BT_CORONA_PRO_LINK; ?>" target="_blank">**Get the Pro version and unlock the MAP for just $5</a> &nbsp; &nbsp; <a href="" target="_blank">View Map Demo</a></p>
			</div>
			<div class="tabs-content grid-x" data-tabs-content="setting-tabs">
				<div class="tabs-panel is-active" id="options" role="tabpanel" aria-labelledby="options-label">
					<!--<div class="notify"></div>-->
					<div class="grid-x display-required callout" style="opacity: 1; pointer-events: inherit;">
						<form method="post" enctype="multipart/form-data" action="options.php">
							<?php 
							settings_fields('btncov_options');
							do_settings_sections($true_page);
							?>
							<p class="submit">  
								<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
							</p>
						</form>
					</div>

				</div>
			</div>
		</div>
    </div>
</div>