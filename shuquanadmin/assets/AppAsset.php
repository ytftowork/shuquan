<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'css/themes/default/style.css',
		'css/js/isotope/jquery.isotope.css',
		'css/bootstrap/font-awesome/css/font-awesome.css',
		'css/bootstrap/css/bootstrap.css',
    ];
    public $js = [
		'css/js/jquery-2.1.4.min.js'
    ];
  
}
