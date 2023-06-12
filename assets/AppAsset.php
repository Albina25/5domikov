<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'public/css/main.css',
        //'public/css/style1.css',
        'public/css/reset.css',
    ];
    public $js = [
        'public/js/script.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap5\BootstrapAsset'
        //'rmrevin\yii\fontawesome\NpmFreeAssetBundle',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
