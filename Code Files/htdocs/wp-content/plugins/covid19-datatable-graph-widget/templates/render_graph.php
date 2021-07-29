<div class="covid19-graph <?php echo $all_options['cov_theme'];?> <?php if(isset($all_options['cov_rtl']) && $all_options['cov_rtl']==!$checked) echo 'rtl_enable'; ?>" style="position:relative;"><span class="covid19-graph-title"><?php esc_attr_e($params['title']); ?></span>
    <div class="graph-container">
        <canvas id="<?php echo esc_attr($uniqId); ?>" data-confirmed="<?php esc_attr_e($params['confirmed_title']); ?>" data-deaths="<?php esc_attr_e($params['deaths_title']); ?>" data-recovered="<?php esc_attr_e($params['recovered_title']); ?>" data-json="<?php esc_attr_e(json_encode($data)); ?>" data-country="<?php esc_attr_e($params['country']); ?>"
        ></canvas>
    </div>
</div>