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
* @Configuration [Bootstrap].
* @since: 0.0.1-dev
**/

namespace cjtterabytesoft\jvectormap;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /** @inheritdoc */
    public function bootstrap($app)
    {
        /* Copy Error Images */
        if (\yii\helpers\BaseFileHelper::filterPath(\Yii::getAlias('@frontend/web/images'), $options = [])) {
            \yii\helpers\BaseFileHelper::copyDirectory(\Yii::getAlias('@cjtterabytesoft/jvectormap/images/'),
                \Yii::getAlias('@frontend/web/images'));
        }
    }
}