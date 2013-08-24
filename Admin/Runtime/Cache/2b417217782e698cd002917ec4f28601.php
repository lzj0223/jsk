<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
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
        <script type="text/javascript">
            var APP = '__APP__';
            var TMPL = '__TMPL__';
            var PUBLIC = '__PUBLIC__';
            var ROOT = '__ROOT__';
            var TMPL = '__TMPL__';
            $(function() {
                $('#verifyImg').click(function() {
                    //重载验证码
                    var time = new Date().getTime();
                    document.getElementById('verifyImg').src = '__APP__/Public/verify/' + time;
                })
            })

            function loginUser() {
                $('#loginForm').form('submit', {
                    url: '__APP__/Public/checkLogin',
                    success: function(data) {
                        var obj = $.parseJSON(data);
                        if (obj.status) {
                            $('#loginDialog').dialog('close');
                            window.location = APP + '/Index';
                        }
                        $.messager.show({
                            title: '提示',
                            msg: obj.info,
                            showType: 'slide',
                        });
                    }
                });
            }
            //回车键登录
            function keyLogin() {
                if (event.keyCode == 13)   //回车键的键值为13   
                    document.getElementById("btnLogin").click(); //调用登录按钮的登录事件   
            }
        </script>
    </head>
    <body style="background:url('__TMPL__/Public/login.jpg');" onkeydown="keyLogin();">
        <div id="loginDialog" style="overflow: hidden;" class="easyui-dialog" data-options="animate:true,title:'用户登录',modal:false,closable:false,draggable:true,width:230,
             buttons:[{
             text:'登录',
             id:'btnLogin',
             iconCls:'icon-edit',
             handler:function(){
             loginUser();
             }
             },{
             text:'关闭',
             iconCls:'icon-cancel',
             handler:function(){
             if(confirm('您确认要关闭窗口吗？')){
             window.opener=null;      
             window.open('','_self');      
             window.close(); 
             }
             }
             }]">
            <div align="center">
                <form method="post" id="loginForm">
                    <table class="tableForm">
                        <tr>
                            <th width="50px">用户名</th>
                            <td><input type="text" name="account" class="easyui-validatebox" data-options="required:true" value=""/></td>
                        </tr>
                        <tr>
                            <th>密&nbsp;&nbsp;&nbsp;码</th>
                            <td><input type="password" name="password" class="easyui-validatebox" data-options="required:true" value=""/></td>
                        </tr>
                        <tr>
                            <th>验证码</th>
                            <td><input type="text" name="verify" class="easyui-validatebox" data-options="required:true" value="" maxlength="4" style="width: 60px" />&nbsp;<img id="verifyImg" src='__APP__/Public/verify/' /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>