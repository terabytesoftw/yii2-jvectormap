<?php

/**
* This file is part of the CJTTERABYTESOFT yii2-widgets
*
* (c) CJT TERABYTE LLC yii2-extension <https://github.com/cjtterabytesoft/yii2-jvectormap>
* For the full copyright and license information, please view the LICENSE.md
* file that was distributed with this source code
*
* @link: https://github.com/cjtterabytesoft/yii2-jvectormap
* @author: Wilmer Arámbula <cjtterabytellc@gmail.com>
* @copyright (c) CJT TERABYTE LLC
* @Widget: [yii2-jvectormap]
* @Assets: [JVectorMapAsset]
* @since: 0.0.1-dev
**/

namespace cjtterabytesoft\widget\jvectormap\assets;

use yii\web\AssetBundle;

class JvectorMapAsset extends AssetBundle
{

    public $sourcePath = '@cjtterabytesoft/widget/jvectormap/assets/';

    public $css = [
        'css/jquery-jvectormap.css',
    ];

    public $js = [
        'js/jquery-jvectormap.min.js',
    ];

    public $publishOptions = [
        'only' => [
            'css/jquery-jvectormap.css',
            'js/jquery-jvectormap.min.js',
        ],
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}