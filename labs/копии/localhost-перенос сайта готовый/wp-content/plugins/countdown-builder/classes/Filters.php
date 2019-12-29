<?php
namespace ycd;

class Filters {

    public function __construct() {
        $this->init();
    }

    public function init() {
        add_filter('admin_url', array($this, 'addNewPostUrl'), 10, 2);
        add_filter('manage_'.YCD_COUNTDOWN_POST_TYPE.'_posts_columns' , array($this, 'tableColumns'));
	    add_filter('ycdDefaults', array($this, 'defaults'), 10, 1);
	    add_filter('post_updated_messages' , array($this, 'updatedMessages'), 10, 1);
	    add_filter('cron_schedules', array($this, 'cronAddMinutes'), 10, 1);
	    add_filter('ycdCountdownContent', array($this, 'countdownContent'), 10, 2);

        add_filter('ycdConditionsDisplayKeys', array($this, 'addTargetParams'), 1, 1);
        add_filter('ycdConditionsDisplayAttributes', array($this, 'attrsDisplaySettings'), 1, 1);
    }

    public function attrsDisplaySettings($attrs) {
        require_once YCD_HELPERS_PATH.'AdminHelper.php';
        $allCustomPostTypes = AdminHelper::getAllCustomPosts();
    
        // for conditions, to exclude other post types, tags etc.
        if (isset($targetParams['select_role'])) {
            return $targetParams;
        }

        foreach ($allCustomPostTypes as $customPostType) {
            $attrs['selected_'.$customPostType] = array(
                'label' => __('Select Post(s)'),
                'fieldType' => 'select',
                'fieldAttributes' => array(
                    'data-post-type' => $customPostType,
                    'data-select-type' => 'ajax',
                    'multiple' => 'multiple',
                    'class' => 'ycd-condition-select js-ycd-select',
                    'value' => ''
                )
            );
        }

        return $attrs;
    }

    public static function addTargetParams($keys) {
        require_once YCD_HELPERS_PATH.'AdminHelper.php';
        $allCustomPostTypes = AdminHelper::getAllCustomPosts();
    
        // for conditions, to exclude other post types, tags etc.
        if (isset($targetParams['select_role'])) {
            return $targetParams;
        }

        foreach ($allCustomPostTypes as $customPostType) {
            $keys['all_'.$customPostType]  = 'All '.ucfirst($customPostType).'s';
            $keys['selected_'.$customPostType] = 'Select '.ucfirst($customPostType).'s';
        }

        return $keys;
    }

    public function countdownContent($content, $obj) {
        if(!empty($obj->getOptionValue('ycd-custom-css'))) {
            $content .= '<style type="text/css">'.$obj->getOptionValue('ycd-custom-css').'</style>';
        }
        if(!empty($obj->getOptionValue('ycd-custom-js'))) {
            $content .= '<script type="text/javascript">'.$obj->getOptionValue('ycd-custom-js').'</script>';
        }

        return $content;
    }
	
	public function cronAddMinutes($schedules)
	{
		$schedules['ycd_newsletter_send_every_minute'] = array(
			'interval' => YCD_CRON_REPEAT_INTERVAL * 60,
			'display' => __('Once Every Minute', YCD_TEXT_DOMAIN)
		);
		
		return $schedules;
	}
	
	public function defaults($defaults) {
		if(YCD_PKG_VERSION != YCD_FREE_VERSION) {
			return $defaults;
		}
		$expireProOptions = apply_filters('ycdCountdownExpireTime', array('redirectToURL', 'showText'));
        foreach ($defaults['countdownExpireTime']['fields'] as $key => $expire) {
            $currentValue = $expire['attr']['value'];
            if(in_array($currentValue, $expireProOptions)) {
                $defaults['countdownExpireTime']['fields'][$key]['label']['name'] .= '<span class="ycd-pro-span">PRO</span>';
		        $defaults['countdownExpireTime']['fields'][$key]['attr']['class'] .= ' ycd-option-wrapper-pro';
            }
        }
        $proDateTypes = apply_filters('ycdCountdownProDateType', array('schedule'));
        foreach ($defaults['countdown-date-type']['fields'] as $key => $expire) {
            $currentValue = $expire['attr']['value'];
            if(in_array($currentValue, $proDateTypes)) {
                $defaults['countdown-date-type']['fields'][$key]['label']['name'] .= '<span class="ycd-pro-span">PRO</span>';
                $defaults['countdown-date-type']['fields'][$key]['attr']['class'] .= ' ycd-option-wrapper-pro';
            }
        }
		
		return $defaults;
	}
    
    public function updatedMessages($messages) {
    	$currentPostType = AdminHelper::getCurrentPostType();
        if ($currentPostType != YCD_COUNTDOWN_POST_TYPE) {
        	return $messages;
        }
	    $messages[YCD_COUNTDOWN_POST_TYPE][1] = 'Countdown updated.';
	    $messages[YCD_COUNTDOWN_POST_TYPE][6] = 'Countdown published.';
	    $messages[YCD_COUNTDOWN_POST_TYPE][7] = 'Countdown saved.';
     
	    return $messages;
	}

    public function addNewPostUrl($url, $path) {
        if ($path == 'post-new.php?post_type='.YCD_COUNTDOWN_POST_TYPE) {
            $url = str_replace('post-new.php?post_type='.YCD_COUNTDOWN_POST_TYPE, 'edit.php?post_type='.YCD_COUNTDOWN_POST_TYPE.'&page='.YCD_COUNTDOWN_POST_TYPE, $url);
        }

        return $url;
    }

    public function tableColumns($columns) {
        unset($columns['date']);

        $additionalItems = array();
	    $additionalItems['onof'] = __('Enabled (show countdown)', YCD_TEXT_DOMAIN);
        $additionalItems['type'] = __('Type', YCD_TEXT_DOMAIN);
        $additionalItems['shortcode'] = __('Shortcode', YCD_TEXT_DOMAIN);

        return $columns + $additionalItems;
    }
}