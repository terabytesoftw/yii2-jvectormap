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
* @Library: [JVectorMap]
* @since: 1.0
**/

namespace cjtterabytesoft\jvectormap;

use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\base\Widget;
use cjtterabytesoft\jvectormap\assets\JvectormapAsset;
use cjtterabytesoft\jvectormap\assets\MapAsset;

class Jvectormap extends Widget
{
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

    /** @var array [$config function Jquery.JVectorMap] **/
    public $config = [];

    /** @var string [$backgroundColor] **/
    public $backgroundColor;

    /** @var string [$focusOn] **/
    public $focusOn =[];

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
        if (empty($this->map)) {
            throw new InvalidConfigException("The 'Map' option is required.");
        }
        if (empty($this->id)) {
            $this->id = 'vmap';
        }
    }

    public function run()
    {
        $view = $this->getView();

        if ($this->id && $this->map) {
            $this->htmlOptions['id'] = $this->id;
            $this->htmlOptions['style'] = $this->style;
            echo Html::beginTag($this->tag, $this->htmlOptions);
                JvectormapAsset::register($view);
                MapAsset::map($this->map);
                MapAsset::register($view);
                $this->config = Json::encode(
                    [
                        'map'=>str_replace('-', '_', $this->map),
                        !$this->backgroundColor ?: 'backgroundColor' =>
                            !$this->backgroundColor ?: $this->backgroundColor,
                        !$this->focusOn ?: 'focusOn' =>
                            !$this->focusOn ?: $this->focusOn ,
                        !$this->labels ?: 'labels' =>
                            !$this->labels ?: $this->labels,
                        !$this->markerLabelStyle ?: 'markerLabelStyle' =>
                            !$this->markerLabelStyle ?: $this->markerLabelStyle,
                        !$this->markers ?: 'markers' =>
                            !$this->markers ?: $this->markers,
                        'markersSelectable' => $this->markersSelectable,
                        'markersSelectableOne' => $this->markersSelectableOne,
                        !$this->markerStyle ?:'markerStyle' =>
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
            echo Html::endTag($this->tag);
        }
        $view->registerJs("jQuery('#{$this->id}').vectorMap($this->config);");
    }
}