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
 * @copyright: (c) CJT TERABYTE LLC
 * @Widget: [yii2-jvectormap]
 * @Assets: [MapAsset]
 * @since: 1.0
 **/

namespace cjtterabytesoft\jvectormap\assets;

use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{

    private static $_maps = [];

    public $sourcePath = '@cjtterabytesoft/jvectormap/assets/maps/js/';

    public function registerAssetFiles($view)
    {
        foreach (self::$_maps as $map) {
            $jsname = "jquery-jvectormap-" . str_replace('_', '-', $map) . ".js";
            if (file_exists($this->sourcePath . "/" . $jsname)) {
                $this->js[] = $jsname;
            }
        }
        parent::registerAssetFiles($view);
    }

    public static function map($map)
    {
        self::$_maps[$map] = $map;
    }
}