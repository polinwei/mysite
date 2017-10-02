<?php

namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JsExpression;

/**
 * Class SyntaxHighlighterAsset
 * @package common\assets
 */
class SyntaxHighlighterAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/src/syntaxhighlighter';

    private static $_asset;

    public $css = [        
        'styles/shCoreDefault.css',
        'styles/shThemeDefault.css', 
        'fix.css',
    ];

    public $js = [
        'scripts/XRegExp.js',
        'scripts/shCore.js',
        'scripts/shAutoloader.js',
    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];


    public static function register($view)
    {
        parent::register($view);
        self::$_asset = new SyntaxHighlighterAsset();
        $assetPath = \Yii::$app->getAssetManager()->getPublishedUrl(self::$_asset->sourcePath);
        $script = new JsExpression("
            SyntaxHighlighter.autoloader(
                'js jscript javascript  {$assetPath}/scripts/shBrushJScript.js',
                'applescript            {$assetPath}/scripts/shBrushAppleScript.js',
                'php                    {$assetPath}/scripts/shBrushPhp.js',
                'css                    {$assetPath}/scripts/shBrushCss.js',
                'bash                   {$assetPath}/scripts/shBrushBash.js',
                'sql                    {$assetPath}/scripts/shBrushSql.js',
                'xml html               {$assetPath}/scripts/shBrushXml.js'
            );
        ");
        $view->registerJs($script);
        $view->registerJs('SyntaxHighlighter.all();');
    }
}