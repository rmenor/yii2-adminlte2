<?php
/**
 * @copyright Copyright (c) 2017
 * @license https://github.com/rmenor/
 * @link http://ramonmenor.es
 */

namespace rmenor\adminlte2\assets;

class PluginsBundle extends \yii\web\AssetBundle
{
    public $sourcePath = '@vendor/bower';
    public $css = [
        'fontawesome/css/font-awesome.min.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
