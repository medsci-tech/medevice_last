<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>电子登记</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<!--头部导航-->
<header class="head-bar">
    <div class="bar-left">
        <a href="javascript:history.back()" class="goback"></a>
    </div>
    <div class="head-title">电子登记</div>
</header>
<section>
    <div class="ui-form ui-border-t">
        <form action="" id="addForm" method="post">
            <div class="ui-form-item ui-border-b">
                <label>
                    姓名*
                </label>
                <input type="text" placeholder="输入姓名"  name="real_name" id="real_name"/>
            </div>
            <div class="ui-form-item ui-border-b">
                <label>性别</label>
                <div class="ui-select">
                    <select  name="sex">
                        <option>男</option>
                        <option>女</option>
                    </select>
                </div>
            </div>
            <div class="ui-form-item ui-border-b">
                <label>
                    联系方式*
                </label>
                <input type="text" placeholder="请输入联系电话"  name="phone" id="mobile"/>
            </div>
            <div class="ui-form-item ui-border-b">
                <label>
                    工作单位
                </label>
                <input type="text" placeholder="请输入工作单位"  name="unit"/>
            </div>
            <div class="ui-form-item ui-border-b">
                <label>
                    关注科室
                </label>
                <input type="text" placeholder="请输入关注科室" name="depart"/>
            </div>
            <div class="ui-form-item ui-form-item-textarea ui-border-b">
                <label>
                    主要意向
                </label>
                <textarea placeholder="请输入主要意向" name="intention"></textarea>
            </div>
            <button class="bottomBtn" type="button" name="submit">提交</button>
        </form>
    </div>
</section>
</body>
</html>
<script src="/js/zepto.min.js"></script>
<script src="/js/layer.js"></script>
<script>
    $('button[name="submit"]').on('click', function(e){
        var real_name =$('#real_name').val();
        var phone =$('#mobile').val();
        if (real_name == '') {
            layer.open({
                content: '姓名不能为空'
                ,skin: 'msg'
                ,time: 3
            });
            return false;
        }
        if (phone=='') {
            layer.open({
                content: '联系电话不能为空'
                ,skin: 'msg'
                ,time: 3
            });
            return false;
        }

        var form = $("form");
        $.ajax({
            type: 'POST',
            url: '',
            data: form.serialize(),
            success: function(json){
                if(json.status == "0") {
                    layer.open({
                        content: json.message
                        ,skin: 'msg'
                        ,time: 3
                    });

                }else{
                    layer.open({
                        content: json.message
                        ,skin: 'msg'
                        ,time: 3
                    });
                    $('#addForm')[0].reset()
                }
            },
        });

    })

</script>
