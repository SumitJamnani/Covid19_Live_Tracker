<div class="table100 ver1 <?php echo $all_options['cov_theme'];?> <?php if(isset($all_options['cov_rtl']) && $all_options['cov_rtl']==!$checked) echo 'rtl_enable'; ?>" >
    <div class="covid19-sheet table100-nextcols">
        <table class="nowrap" id="<?php echo esc_attr($uniqId); ?>" data-page-length="<?php echo esc_attr($params['rows']); ?>" role="grid" style="width:100%" width="100%">
            <thead>
                <tr class="row100 head">
                    <th class="cell100 column2 country_title"><?php echo esc_html($params['country_title']); ?></th>
                    <th class="cell100 column3 confirmed_title"><?php echo esc_html($params['confirmed_title']); ?></th>
                    <th class="cell100 column5 today_cases"><?php echo esc_html($params['today_cases']); ?></th>
                    <th class="cell100 column6 deaths_title"><?php echo esc_html($params['deaths_title']); ?></th>								
                    <th class="cell100 column7 today_deaths"><?php echo esc_html($params['today_deaths']); ?></th>
                    <th class="cell100 column8 today_deaths">%</th>
                    <th class="cell100 column9 recovered_title"><?php echo esc_html($params['recovered_title']); ?></th>
                    <th class="cell100 column10 recovered_title">%</th>
                    <th class="cell100 column11 active_title"><?php echo esc_html($params['active_title']); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $key => $value) : ?>
                <tr class="row100 body">
                    <td class="cell100 column2 Btncov-<?php $arr = explode(' ',trim($value->country)); echo $arr[0]; ?> country_title" data-label="<?php echo esc_html($params['country_title']); ?>" title="<?php echo esc_html($value->country); ?>">
                    <?php if (isset($value->countryInfo->flag)) : ?>
                        <span class="country_flag" style="background:url(<?php echo esc_html($value->countryInfo->flag); ?>) center no-repeat;background-size:cover;"></span>
                    <?php endif; ?>
                    <?php echo esc_html($value->country); ?></td>
                    <td class="cell100 column3 confirmed_title" data-label="<?php echo esc_html($params['confirmed_title']); ?>"><?php echo number_format($value->cases); ?></td>
                    <td class="cell100 column5 today_cases" data-label="<?php echo esc_html($params['today_cases']); ?>"><?php echo number_format($value->todayCases); ?></td>
                    <td class="cell100 column6 deaths_title" data-label="<?php echo esc_html($params['deaths_title']); ?>"><?php echo number_format($value->deaths); ?></td>
                    <td class="cell100 column7 today_deaths" data-label="<?php echo esc_html($params['today_deaths']); ?>"><?php echo number_format($value->todayDeaths); ?></td>
                    <td class="cell100 column8 percent_d"><?php echo round(($value->deaths)/($value->cases)*100, 1); ?>%</td>
                    <td class="cell100 column9 recovered_title" data-label="<?php echo esc_html($params['recovered_title']); ?>">
                    <?php if (isset($value->recovered) && $value->recovered <= 0) {
                        echo '-';
                        } else {
                        echo number_format($value->recovered);
                        } ?></td>
                    <td class="cell100 column10 recovered_d"><?php echo round(($value->recovered)/($value->cases)*100, 1); ?>%</td>
                    <td class="cell100 column11 active_title" data-label="<?php echo esc_html($params['active_title']); ?>"><?php echo number_format($value->active); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    </div>