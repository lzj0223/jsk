<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">
    $('#page').form('submit', {
        url: '__APP__/Config/SetValue',
        success: function(result) {
            try {
                if (result.status == 1) {
                    $.messager.show({
                        title: '提示',
                        msg: result.info,
                    });
                } else {
                    $.messager.show({
                        title: '提示',
                        msg: result.info,
                    });
                }
            } catch (e) {
                $.messager.alert('提示', result.info);
            }
        }
    });
</script>
<div>
    <form id="page" method="post">
        <table cellspacing="0" cellpadding="10" >
            <tr>
                <td width="150px">网站LOGO</td>
                <td><input type="text" name="title" class="easyui-validatebox" data-options="required:true" value="" style="width: 400px"/></td>
            </tr>
            <tr>
                <td>网站标题</td>
                <td><input type="text" name="title" class="easyui-validatebox" data-options="required:true" value="<?php echo C('SITE_NAME');?>" style="width: 400px"/></td>
            </tr> 
            <tr>
                <td>关键字</td>
                <td><input type="text" name="keywords" class="easyui-validatebox" data-options="required:true" value="<?php echo (C("SITE_KEYWORDS")); ?>" style="width: 400px"/></td>
            </tr> 
            <tr>
                <td>网站描述</td>
                <td><input type="text" name="description" class="easyui-validatebox" data-options="required:true" value="<?php echo (C("SITE_DESCRIPTION")); ?>" style="width: 400px"/></td>
            </tr> 
            <tr>
                <td>网站备案</td>
                <td><input type="text" name="icp" class="easyui-validatebox" data-options="required:true" value="<?php echo C('ICP_NUM');?>" style="width: 400px"/></td>
            </tr>
            <tr>
                <td>统计代码</td>
                <td><input type="text" name="cnzz" class="easyui-validatebox" data-options="required:true" value="<?php echo C('CNZZ');?>" style="width: 400px"/></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" value="提交"></td>
            </tr>
        </table>
    </form>
</div>