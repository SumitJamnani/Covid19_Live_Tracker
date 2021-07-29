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
									
					<?php $data = get_option('braintumcCC');?>
					<div id="id01" class="modal grid-x display-required callout" style="opacity: 1; pointer-events: inherit;">
						<div class="small-6">
							<div class="small-12 cell">
								<h3><?php esc_html_e('Widget Shortcode', 'btcorona'); ?></h3>
							</div>
							<div class="small-12 cell"><?php _e('<b>land:</b> NorthAmerica / SouthAmerica / Africa / Asia / Europe / Oceania', 'btcorona'); ?>.</div>
							<div class="small-12 cell">
								<h4><?php esc_html_e('Countries:', 'btcorona'); ?></h4>
							</div>
							<div class="small-12 cell">
								<select name="covid_country">
									<option value=""><?php esc_html_e('All Countries - Worldwide Statistics', 'btcorona'); ?></option>
									<?php
									foreach ($data as $item) {
										echo '<option value="'.esc_attr($item->country).'">'.esc_html($item->country).'</option>';
									}
									?>
								</select>
							</div>
							<p id="covidsh" class="covid_shortcode"><?php esc_html_e('[BTCORONA-WIDGET title_widget="Worldwide" land="" confirmed_title="Cases" deaths_title="Deaths" recovered_title="Recovered"]', 'btcorona'); ?></p>
						</div>
						<div class="small-6">
							<div class="small-12 cell">
								<h3><?php esc_html_e('Widget Shortcode: Full format', 'btcorona'); ?></h3>
							</div>
							<div class="small-12 cell"><?php _e('<b>land:</b> NorthAmerica / SouthAmerica / Africa / Asia / Europe / Oceania', 'btcorona'); ?>.</div>
							<div class="small-12 cell">
								<h4><?php esc_html_e('Countries:', 'btcorona'); ?></h4>
							</div>
							<div class="small-12 cell">
								<select name="covid_country_full">
									<option value=""><?php esc_html_e('All Countries - Worldwide Statistics', 'btcorona'); ?></option>
									<?php
									foreach ($data as $item) {
										echo '<option value="'.$item->country.'">'.$item->country.'</option>';
									}
									?>
								</select>
							</div>
							<p id="covidsh-full" class="covid_shortcode"><?php esc_html_e('[BTCORONA-WIDGET title_widget="Worldwide" format="full" land="" confirmed_title="Cases" deaths_title="Deaths" recovered_title="Recovered" active_title="Active" today_cases="24h" today_deaths="24h"]', 'btcorona'); ?></p>
						</div>
					</div>

					<div class="grid-x display-required callout" style="opacity: 1; pointer-events: inherit;background: #e3d607;">
						<div class="small-12 cell">
							<h3><?php esc_html_e('Map of Countries', 'btcorona'); ?> <span style="color:red">(**for Pro Version only**)</span></h3>
							<p><a href="<?php echo BT_CORONA_PRO_LINK; ?>" target="_blank">**Get the Pro version and unlock the MAP for just $5</a></p>
						</div>
						<div class="small-12 cell"><?php _e('<b>Color:</b> red / blue / orange', 'btcorona'); ?></div>
						<div class="small-12 cell">
							<div id="covid19">
								<p id="covidsh" class="covid_shortcode"><?php esc_html_e('[BTCORONA color="red" confirmed_title="Cases" deaths_title="Deaths" recovered_title="Recovered"]', 'btcorona'); ?></p>
							</div>
						</div>
					</div>

					<div class="grid-x display-required callout" style="opacity: 1; pointer-events: inherit;background: #e3d607;">
						<div class="small-12 cell">
							<h3><?php esc_html_e('Map of the USA', 'btcorona'); ?> <span style="color:red">(**for Pro Version only**)</span></h3>
							<p><a href="<?php echo BT_CORONA_PRO_LINK; ?>" target="_blank">**Get the Pro version and unlock the MAP for just $5</a></p>
						</div>
						<div class="small-12 cell"><?php _e('<b>Color:</b> red / blue / orange', 'btcorona'); ?></div>
						<div class="small-12 cell">
							<div id="covid19">
								<p id="covidsh" class="covid_shortcode"><?php esc_html_e('[BTCORONA-MAPUS color="red" confirmed_title="Confirmed" deaths_title="Deaths" active_title="Active"]', 'btcorona'); ?></p>
							</div>
						</div>
					</div>

					<div class="grid-x display-required callout" style="opacity: 1; pointer-events: inherit;">
						<div class="small-12 cell">
							<h3><?php esc_html_e('List of Countries', 'btcorona'); ?></h3>
						</div>
						<div class="small-12 cell"><small><?php _e('Paste this shortcode into <b>Posts or Pages</b>.', 'btcorona'); ?></small></div>			
						<div class="small-12 cell">
							<div id="covid19">
								<p id="covidsh" class="covid_shortcode"><?php esc_html_e('[BTCORONA-ROLL title_widget="Worldwide" total_title="Total" country_title="Country" confirmed_title="Cases" deaths_title="Deaths" recovered_title="Recovered"]', 'btcorona'); ?></p>
							</div>
						</div>
					</div>

					<div class="grid-x display-required callout" style="opacity: 1; pointer-events: inherit;">
						<div class="small-12 cell">
							<h3><?php esc_html_e('Graph', 'btcorona'); ?></h3>
						</div>
						<div class="small-12 cell"><small><?php _e('Paste this shortcode into <b>Posts or Pages</b>.', 'btcorona'); ?></small></div>			
						<div class="small-12 cell">
							<h4><?php esc_html_e('Countries:', 'btcorona'); ?></h4>
						</div>
						<div class="small-12 cell">
							<select name="covid_country_graph">
								<option value=""><?php esc_html_e('All Countries - Worldwide Statistics', 'btcorona'); ?></option>
								<?php
								foreach ($data as $item) {
									echo '<option value="'.$item->country.'">'.$item->country.'</option>';
								}
								?>
							</select>
						</div>
						<p id="covidsh-graph" class="covid_shortcode"><?php _e('[BTCORONA-GRAPH title="World History Chart" confirmed_title="Confirmed" deaths_title="Deaths" recovered_title="Recovered"]', 'btcorona'); ?></p>
					</div>

					<div class="grid-x display-required callout" style="opacity: 1; pointer-events: inherit;">
						<div class="small-12 cell">
							<h3><?php esc_html_e('Table of Countries', 'btcorona'); ?></h3>
						</div>
						<div class="small-12 cell"><?php _e('<b>rows:</b> 10 / 20 / 50 / 100 (number of countries)', 'btcorona'); ?>.</div>
						<div class="small-12 cell"><?php _e('<b>search:</b> "Search by Country" in your language', 'btcorona'); ?>.</div>
						<div class="small-12 cell"><?php _e('<b>land:</b> NorthAmerica / SouthAmerica / Africa / Asia / Europe / Oceania', 'btcorona'); ?>.</div>
						<div class="small-12 cell">
							<div id="covid19">
								<p id="covidsh" class="covid_shortcode"><?php esc_html_e('[BTCORONA-SHEET country_title="Country" land="" rows="20" search="Search by Country..." confirmed_title="Cases" today_cases="24h" deaths_title="Deaths" today_deaths="24h" recovered_title="Recovered" active_title="Active"]', 'btcorona'); ?></p>
							</div>
						</div>
					</div>

					<div class="grid-x display-required callout" style="opacity: 1; pointer-events: inherit;">
						<div class="small-12 cell">
							<h3><?php esc_html_e('Data Ticker', 'btcorona'); ?></h3>
						</div>
						<div class="small-12 cell"><small><?php _e('Paste this shortcode into <b>Sidebar Text widget</b>.', 'btcorona'); ?></small></div>
						<div class="small-12 cell"><?php _e('Use <b>style="horizontal"</b> for Horizontal style.', 'btcorona'); ?></div>
						<div class="small-12 cell">
							<h4><?php esc_html_e('Countries:', 'btcorona'); ?></h4>
						</div>
						<div class="small-12 cell">
							<select name="covid_country_ticker">
								<option value=""><?php esc_html_e('All Countries - Worldwide Statistics', 'btcorona'); ?></option>
								<?php
								foreach ($data as $item) {
									echo '<option value="'.$item->country.'">'.$item->country.'</option>';
								}
								?>
							</select>
						</div>
						<p id="covidsh-ticker" class="covid_shortcode"><?php _e('[BTCORONA-TICKER ticker_title="World" style="vertical" confirmed_title="Confirmed" deaths_title="Deaths" recovered_title="Recovered"]', 'btcorona'); ?></p>
					</div>

					<div class="grid-x display-required callout" style="opacity: 1; pointer-events: inherit;">
						<div class="small-12 cell">
							<h3><?php esc_html_e('Inline Text data', 'btcorona'); ?></h3>
						</div>
						<div class="small-12 cell"><small><?php _e('Paste this shortcode into <b>text</b>.', 'btcorona'); ?></small></div>			
						<div class="small-12 cell">
							<h4><?php esc_html_e('Countries:', 'btcorona'); ?></h4>
						</div>
						<div class="small-12 cell">
							<select name="covid_country_line">
								<option value=""><?php esc_html_e('All Countries - Worldwide Statistics', 'btcorona'); ?></option>
								<?php
								foreach ($data as $item) {
									echo '<option value="'.$item->country.'">'.$item->country.'</option>';
								}
								?>
							</select>
						</div>
						<p id="covidsh-line" class="covid_shortcode"><?php _e('[BTCORONA-LINE confirmed_title="cases" deaths_title="deaths" recovered_title="recovered"]', 'btcorona'); ?></p>
					</div>

					<div class="display-required callout primary" style="opacity: 1; pointer-events: inherit;">
						<div class="small-12 cell">
							<h3><?php esc_html_e('What do the terms mean?', 'btcorona'); ?></h3>
						</div>
						<p><b><?php esc_html_e('Confirmed', 'btcorona'); ?></b> — <?php esc_html_e('The number of confirmed (recorded) cases', 'btcorona'); ?>.</p>
						<p><b><?php esc_html_e('Active', 'btcorona'); ?></b> — <?php esc_html_e('The number of confirmed cases that are still infected (Active = Confirmed - Deaths - Recovered)', 'btcorona'); ?>.</p>
						<p><b><?php esc_html_e('Deaths', 'btcorona'); ?></b> — <?php esc_html_e('The number of confirmed cases that have died', 'btcorona'); ?>.</p>
						<p><b><?php esc_html_e('Recovered', 'btcorona'); ?></b> — <?php esc_html_e('The number of confirmed cases that have recovered', 'btcorona'); ?>.</p>
						<hr>
						<div class="small-12 cell">
							<h3><?php esc_html_e('What do the columns in the table mean?', 'btcorona'); ?></h3>
						</div>
						<p><b><?php esc_html_e('24h', 'btcorona'); ?></b> — <?php esc_html_e('The amount of new data in last 24 hours', 'btcorona'); ?>.</p>
						<p><b><?php esc_html_e('%', 'btcorona'); ?></b> — <?php esc_html_e('Percentage of Deaths or Recovered or Active in Confirmed Cases', 'btcorona'); ?>.</p>
						<p><b><?php esc_html_e('-', 'btcorona'); ?></b> — <?php esc_html_e('If there is no such data or 0, returns the empty string', 'btcorona'); ?>.</p>
						<hr>
						<div class="small-12 cell">
							<h3><?php esc_html_e('Data Sources', 'btcorona'); ?></h3>
						</div>
						<p><?php esc_html_e('WHO, CDC, ECDC, NHC, JHU CSSE, DXY & QQ', 'btcorona'); ?>.</p>
					</div>

				</div>
			</div>
		</div>
    </div>
</div>