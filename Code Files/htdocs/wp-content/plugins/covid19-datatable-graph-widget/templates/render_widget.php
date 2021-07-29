<div class="covid19-card  <?php echo $all_options['cov_theme'];?> <?php if(isset($all_options['cov_rtl']) && $all_options['cov_rtl']==!$checked) echo 'rtl_enable'; ?>" >
    <h4 class="covid19-title-big"><?php echo esc_html(isset($params['title_widget']) ? $params['title_widget'] : ''); ?></h4>
    <div class="covid19-row">
        <div class="covid19-col covid19-confirmed">
            <div class="covid19-num"><?php echo number_format($data->cases); ?></div>
            <div class="covid19-title"><?php echo esc_html($params['confirmed_title']); ?></div>
        </div>
        <div class="covid19-col covid19-deaths">
            <div class="covid19-num"><?php echo number_format($data->deaths); ?></div>
            <div class="covid19-title"><?php echo esc_html($params['deaths_title']); ?></div>
        </div>
        <div class="covid19-col covid19-recovered">
            <div class="covid19-num"><?php echo number_format($data->recovered); ?></div>
            <div class="covid19-title"><?php echo esc_html($params['recovered_title']); ?></div>
        </div>
    </div>
</div>