<?php

/**
* This file is part of the CJTTERABYTESOFT yii2-jvectormap
*
* (c) CJT TERABYTE LLC yii2-widget <https://github.com/cjtterabytesoft/yii2-jvectormap>
* For the full copyright and license information, please view the LICENSE.md
* file that was distributed with this source code
*
* @link: https://github.com/cjtterabytesoft/yii2-jvectormap
* @author: Wilmer Arámbula <cjtterabytellc@gmail.com>
* @copyright: (c) CJT TERABYTE LLC
* @Widget: [yii2-jvectormap]
* @Library: [JvectorMap]
* @since: 0.0.1-dev
**/

namespace cjtterabytesoft\widget\jvectormap;

use cjtterabytesoft\widget\jvectormap\assets\JvectorMapAsset;
use cjtterabytesoft\widget\jvectormap\assets\MapAsset;
use cjtterabytesoft\widget\jvectormap\assets\MapCustomAsset;
use yii;
use yii\base\Widget;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Json;


class JvectorMap extends Widget
{
    /** @var string jvpath js map **/
    public $jvpath = '@cjtterabytesoft/widget/jvectormap/assets/maps/js/';

    /** @var string jvpathcustom js map **/
    public $jvpathcustom = '@webroot/maps/js/';

    /** @var string $jvname js map **/
    public $jvname = 'jquery-jvectormap-';

    /** @var integer $jverror js map **/
    public $jverror = 0;

    /** @var string $jvimage404 js map **/
    public $jvimage404 = '/images/errors/404-map.png';

    /** @var string $jvimage500 js map **/
    public $jvimage500 = '/images/errors/500-map.png';

    /** AssetBundle Dinamic **/
    public $bundle;

    /** @var string tag container **/
    public $tag = 'div';

    /** @var string $id [div] [$id - function Jquery.JVectorMap] **/
    public $id;

    /** @var array [div - $htmlOptions[$style]] **/
    public $style = [];

    /** @var array [div - $htmlOptions] **/
    public $htmlOptions = [];

    /** @var string [$map] **/
    public $map;

    /** @var boolean jvdefault js map **/
    public $maptype = false;

    /** @var string [$config function Jquery.JVectorMap] **/
    public $config;

    /** @var string [$backgroundColor] **/
    public $backgroundColor;

    /** @var string [$focusOn] **/
    public $focusOn = [];

    /** @var array [$labels] **/
    public $labels = [];

    /** @var array [$markerLabelStyle] **/
    public $markerLabelStyle = [];

    /** @var array [$markers] **/
    public $markers = [];

    /** @var boolean [$markersSelectable] **/
    public $markersSelectable = false;

    /** @var boolean [$markersSelectableOne] **/
    public $markersSelectableOne = false;

    /** @var array [$markerStyle] **/
    public $markerStyle = [];

    /** @var boolean [$panOnDrag] **/
    public $panOnDrag = true;

    /** @var array [$regionLabelStyle] **/
    public $regionLabelStyle = [];

    /** @var boolean [$regionsSelectable] **/
    public $regionsSelectable = true;

    /** @var boolean [$regionsSelectableOne] **/
    public $regionsSelectableOne = false;

    /** @var array [$regionStyle] **/
    public $regionStyle = [];

    /** @var array [$selectedMarkers] **/
    public $selectedMarkers = [];

    /** @var array [$selectedRegions] **/
    public $selectedRegions = [];

    /** @var array [$series] **/
    public $series = [];

    /** @var boolean [$zoomAnimate] **/
    public $zoomAnimate = false;

    /** @var integer [$zoomMax] **/
    public $zoomMax;

    /** @var integer [$zoomMin] **/
    public $zoomMin;

    /** @var boolean [$zoomOnScroll] **/
    public $zoomOnScroll = true;

    public function init()
    {
        parent::init();
        if (!file_exists(\Yii::getAlias('@webroot/images/errors/'))) {
            BaseFileHelper::copyDirectory(\Yii::getAlias('@cjtterabytesoft/widget/jvectormap/images/errors'),
                \Yii::getAlias('@frontend/web/images/errors'));
        }
        if (empty($this->id)) {
            $this->id = 'vmap';
        }
        $this->htmlOptions['id'] = $this->id;
        $this->htmlOptions['style'] = $this->style;
        if (empty($this->map)) {
            $this->jverror = 1;
            } else {
                $this->MapJs();
        }
    }

    public function run()
    {
        if ($this->jverror == 0) {
            $this->config = Json::encode(
                [
                    'map' => str_replace('-', '_', $this->map),
                    !$this->backgroundColor ?: 'backgroundColor' =>
                        !$this->backgroundColor ?: $this->backgroundColor,
                    !$this->focusOn ?: 'focusOn' =>
                        !$this->focusOn ?: $this->focusOn,
                    !$this->labels ?: 'labels' =>
                        !$this->labels ?: $this->labels,
                    !$this->markerLabelStyle ?: 'markerLabelStyle' =>
                        !$this->markerLabelStyle ?: $this->markerLabelStyle,
                    !$this->markers ?: 'markers' =>
                        !$this->markers ?: $this->markers,
                    'markersSelectable' => $this->markersSelectable,
                    'markersSelectableOne' => $this->markersSelectableOne,
                    !$this->markerStyle ?: 'markerStyle' =>
                        !$this->markerStyle ?: $this->markerStyle,
                    'panOnDrag' => $this->panOnDrag,
                    !$this->regionLabelStyle ?: '$regionLabelStyle' =>
                        !$this->regionLabelStyle ?: $this->regionLabelStyle,
                    'regionsSelectable' => $this->regionsSelectable,
                    'regionsSelectableOne' => $this->regionsSelectableOne,
                    !$this->selectedMarkers ?: 'selectedMarkers' =>
                        !$this->selectedMarkers ?: $this->selectedMarkers,
                    !$this->selectedRegions ?: 'selectedRegions' =>
                        !$this->selectedRegions ?: $this->selectedRegions,
                    !$this->regionStyle ?: 'regionStyle' =>
                        !$this->regionStyle ?: $this->regionStyle,
                    !$this->series ?: 'series' =>
                        !$this->series ?: $this->series,
                    'zoomAnimate' => $this->zoomAnimate,
                    !$this->zoomMax ?: 'zoomMax' =>
                        !$this->zoomMax ?: $this->zoomMax,
                    !$this->zoomMin ?: 'zoomMin' =>
                        !$this->zoomMin ?: $this->zoomMin,
                    'zoomOnScroll' => $this->zoomOnScroll,
                ]
            );
            echo Html::beginTag($this->tag, $this->htmlOptions);
            echo Html::endTag($this->tag);
            Yii::$app->view->registerJs("jQuery('#{$this->id}').vectorMap($this->config)");
            } else {
                $this->ErrorMap();
        }
    }

    public function MapJs() {
        $this->jvname = $this->jvname . str_replace('_', '-', $this->map) . ".js";
        if (file_exists(yii::getAlias((!$this->maptype ? $this->jvpath : $this->jvpathcustom) . $this->jvname))) {
            JvectorMapAsset::register(Yii::$app->view);
            $this->bundle = !$this->maptype ? MapAsset::register(Yii::$app->view) :
                MapCustomAsset::register(Yii::$app->view);
            $this->bundle->js[] = $this->jvname; // dynamic map added
            $this->bundle->publishOptions[] = [
                'only' => [
                    yii::getalias((!$this->maptype ? $this->jvpath : $this->jvpathcustom) . $this->jvname),
                ]
            ];
            } else {
                $this->jverror = 2;
        }
    }

    public function ErrorMap() {
        switch ($this->jverror) {
            case 1:
                echo Html::beginTag($this->tag, $this->htmlOptions);
                echo Html::img($this->jvimage500, $options = ['alt' => '500 - The Map Option is Required.',
                    'style' => 'max-width:100%;width:100%;']);
                echo Html::endTag($this->tag);
                break;
            case 2:
                echo Html::beginTag($this->tag, $this->htmlOptions);
                    echo Html::img($this->jvimage404, $options = ['alt' => '404 - Map Not Found',
                        'style' => 'max-width:100%;width:100%;']);
                echo Html::endTag($this->tag);
                break;
        }
    }
}
