<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>供应商详情</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
</head>
<body>
<div class="ui-border-tb comm-padding">
    <div><img src="{{$supplier->logo_image_url}}" width="100%"></div>
    <span>{{$supplier->supplier_name}}<br>
        <span class="ui-txt-tips ui-txt-info">{{$supplier->supplier_desc}}</span>
    </span>
</div>

<div style="margin-bottom: 60px">
    <ul class="ui-list ui-list-text ui-list-link ui-border-tb">
        @foreach($supplier->products as $product)
            <li class="ui-border-t">
                <p class="ui-nowrap ui-txt-sub ui-txt-info">{{$product->name}}</p>

                <div class="ui-txt-info ui-txt-sub"><a href="/shop/detail?id={{$product->id}}">查看</a></div>
            </li>
        @endforeach
    </ul>
</div>

<div class="ui-footer ui-footer-stable ui-btn-group ui-border-t" style="height: 50px">
    @if($attention)
        <button class="ui-btn ui-btn-primary" onclick="unfollow({{$supplier->id}})">
            取消关注
        </button>
    @else
        <button class="ui-btn ui-btn-primary" onclick="follow({{$supplier->id}})">
            关注
        </button>
    @endif()
</div>

<div class="ui-dialog" id="dialog">
    <div class="ui-dialog-cnt">
        <header class="ui-dialog-hd ui-border-b">
            <h3 id="dia_title"></h3>
            <i class="ui-dialog-close" data-role="button" onclick="closeDia()"></i>
        </header>
        <div class="ui-dialog-bd">
            <i class="ui-icon-success success_dia" id="icon"></i><h4 id="dia_content"></h4>
        </div>
        <div class="ui-dialog-ft">
            <button type="button" data-role="button" onclick="closeDia()">确定</button>
        </div>
    </div>
</div>

<script src="http://cdn.bootcss.com/bootswatch/2.0.2/js/jquery.js"></script>
<script src="{{asset('/js/zepto.min.js')}}"></script>
<script src="{{asset('/js/frozen.js')}}"></script>

<script>
    function showDia(success, title, content) {
        $("#dia_title").text(title);
        $("#dia_content").text(content);
        if (success) {
            $("#icon").removeClass().addClass("ui-icon-success success_dia");
        } else {
            $("#icon").removeClass().addClass("ui-icon-success ui-txt-warning");
        }
        document.getElementById("dialog").style.display = "-webkit-box";
    }
    function closeDia() {
        window.location.reload();
        document.getElementById("dialog").style.display = "none";
    }

    function follow(supplier_id) {
        $.ajax({
            url: '/supplier/follow',
            data: {
                supplier_id: supplier_id
            },
            type: "get",
            dataType: "json",
            success: function (json) {
                if (json.success) {
                    showDia(true, '关注成功', '恭喜你，关注成功！');
                } else {
                    showDia(true, '关注失败', '关注失败,请重试！');
                }
            },
            error: function (xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
                showDia(true, '关注失败', '关注失败,请重试！');
            }
        });
    }

    function unfollow(supplier_id) {
        $.ajax({
            url: '/supplier/unfollow',
            data: {
                supplier_id: supplier_id
            },
            type: "get",
            dataType: "json",
            success: function (json) {
                if (json.success) {
                    showDia(true, '取消成功', '已取消关注！');
                } else {
                    showDia(true, '取消失败', '取消关注失败,请重试！');
                }
            },
            error: function (xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
                showDia(true, '关注失败', '关注失败,请重试！');
            }
        });
    }
</script>
</body>
</html>