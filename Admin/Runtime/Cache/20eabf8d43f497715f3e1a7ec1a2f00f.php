<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo (C("SITE_NAME")); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <meta http-equiv="pragma" content="no-cache">
        <meta http-equiv="cache-control" content="no-cache">
        <meta http-equiv="expires" content="0">
        <meta http-equiv="keywords" content="<?php echo (C("SITE_KEYWORDS")); ?>">
        <meta http-equiv="description" content="<?php echo (C("SITE_DESCRIPTION")); ?>">
        <link id="easyuiTheme" rel="stylesheet" type="text/css" href="__PUBLIC__/js/jquery-easyui-1.3.1/themes/<?php echo (($_COOKIE["easyuiThemeName"])?($_COOKIE["easyuiThemeName"]):'default'); ?>/easyui.css">
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/js/jquery-easyui-1.3.1/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/style/syCss.css">
        <script type="text/javascript" src="__PUBLIC__/js/jquery-easyui-1.3.1/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/jquery-easyui-1.3.1/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="__PUBLIC__/js/jquery-easyui-1.3.1/locale/easyui-lang-zh_CN.js" charset="utf-8"></script>
        <script type="text/javascript" src="__PUBLIC__/js/jquery-easyui-1.3.1/jquery.cookie.js" charset="utf-8"></script>
        <script type="text/javascript" src="__PUBLIC__/js/syUtil.js" charset="utf-8"></script>
        <script type="text/javascript" src="__PUBLIC__/js/api_v2.5.1.js"></script>
        <script type="text/javascript">
            var APP = '__APP__';
            var TMPL = '__TMPL__';
            var PUBLIC = '__PUBLIC__';
            var ROOT = '__ROOT__';
            $(function() {
//                alert(parseInt($.browser.version));
//                alert($.browser.msie);
//                alert(navigator.userAgent.search('MSIE 7.0'));
                if ($.browser.msie) {
                    if (parseInt($.browser.version) < 8) {
                        window.location = APP + '/Index/info';
                    }
                }
            });
        </script>
    </head>
    <body class="easyui-layout">
        <div data-options="region:'north',href:'__APP__/Layout/north',border : false," id="top_image" style="height:65px;overflow:hidden;"></div>
        <div data-options="region:'west',title:'主菜单',href:'__APP__/Layout/west'" id="layoutMenu" style="width:210px;overflow: hidden;"></div>
        <div data-options="region:'center',title:'',href:'__APP__/Layout/center'" style="overflow: hidden;"></div>
        <div data-options="region:'east',title:'日历',href:'__APP__/Layout/east'" id="right" style="width:200px;overflow: hidden;"></div>
        <div data-options="region:'south',border:false,href:'__APP__/Layout/south'" id="bottom" style="height: 27px;overflow: hidden;"></div>
    </body>
</html>