<div class="covid19-roll <?php echo $all_options['cov_theme'];?> <?php if(isset($all_options['cov_rtl']) && $all_options['cov_rtl']==!$checked) echo 'rtl_enable'; ?>" >
    <div class="covid19-title-big"><?php echo esc_html(isset($params['title_widget']) ? $params['title_widget'] : ''); ?></div>
    <ul class="covid19-roll2">
        <li class="covid19-country aiByXc">
            <div class="covid19-country-stats covid19-head">					
                <div class="covid19-col covid19-countrycol">
                    <div class="covid19-label"><?php echo esc_html($params['country_title']); ?></div>
                </div>
                <div class="covid19-col covid19-confirmed">
                    <div class="covid19-label"><?php echo esc_html($params['confirmed_title']); ?></div>
                </div>
                <div class="covid19-col covid19-deaths">
                    <div class="covid19-label"><?php echo esc_html($params['deaths_title']); ?></div>
                </div>
                <div class="covid19-col covid19-recovered">
                    <div class="covid19-label"><?php echo esc_html($params['recovered_title']); ?></div>
                </div>
            </div>
        </li>
    <?php foreach ($data as $key => $value) : ?>
        <li class="covid19-country">
            <div class="covid19-country-stats">
                <div class="covid19-col covid19-countrycol">
                    <?php if (isset($value->countryInfo->flag)) : ?>
                        <span class="country_flag" style="background:url(<?php echo esc_html($value->countryInfo->flag); ?>) center no-repeat;background-size:cover;"></span>
                    <?php endif; ?>
                    <?php echo esc_html($value->country); ?>
                </div>
                <div class="covid19-col covid19-confirmed">
                    <div class="covid19-value"><?php echo number_format_i18n($value->cases); ?></div>
                </div>
                <div class="covid19-col covid19-deaths">
                    <div class="covid19-value"><?php echo number_format_i18n($value->deaths); ?></div>
                </div>
                <div class="covid19-col covid19-recovered">
                    <div class="covid19-value">
                    <?php if (isset($value->recovered) && $value->recovered <= 0) {
                        echo '-';
                        } else {
                        echo number_format_i18n($value->recovered);
                        } ?>
                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
    <div class="covid19-country covid19-total">
        <div class="covid19-country-stats">
            <div class="covid19-col covid19-totalcol"><?php esc_html_e($params['total_title']); ?></div>
            <div class="covid19-col covid19-confirmed">
                <div class="covid19-value"><?php echo number_format_i18n($dataAll->cases); ?></div>
            </div>
            <div class="covid19-col covid19-deaths">
                <div class="covid19-value"><?php echo number_format_i18n($dataAll->deaths); ?></div>
            </div>
            <div class="covid19-col covid19-recovered">
                <div class="covid19-value"><?php echo number_format_i18n($dataAll->recovered); ?></div>
            </div>
        </div>
    </div>
</div>