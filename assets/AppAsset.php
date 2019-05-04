<?php
declare(strict_types=1);

namespace app\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

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
//        'css/site.css',
//        'css/main.css',
    ];
    public $js = [
        'js/main.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class, // подключение Bootstrap
    ];
}
