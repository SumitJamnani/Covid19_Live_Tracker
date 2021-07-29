<div class="covid19-ticker covid19-ticker-style-<?php echo esc_attr($params['style'] ? $params['style'] : 'vertical'); ?> <?php echo $all_options['cov_theme'];?> <?php if(isset($all_options['cov_rtl']) && $all_options['cov_rtl']==!$checked) echo 'rtl_enable'; ?>" >
    <span><?php echo esc_html($params['ticker_title']); ?></span>
    <ul>
        <li><?php echo esc_html($params['confirmed_title']); ?>: <?php echo number_format($data->cases); ?></li>
        <li><?php echo esc_html($params['deaths_title']); ?>: <?php echo number_format($data->deaths); ?></li>
        <li><?php echo esc_html($params['recovered_title']); ?>: <?php echo number_format($data->recovered); ?></li>
    </ul>
    
    
</div>