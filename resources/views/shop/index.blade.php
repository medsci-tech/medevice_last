<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>产品展示</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    <style>
        html {
            -ms-overflow-style: none;
            overflow: -moz-scrollbars-none;
        }

        html::-webkit-scrollbar {
            width: 0px
        }

        .lfloat {
            overflow: hidden;
        }
    </style>
</head>
<body>
<div>
    <div class="lfloat ui-col ui-col-25">
        <ul id="nav" style="overflow-y: hidden">
            <li class="aa" id="tb_0" onClick="hoverli(0,0);">所有</li>
            @foreach($categories as $key=>  $cat)
                <li class="aa" id="tb_{{ $key+1  }}" onClick="hoverli({{$key+1}},{{$cat->id}});">{{$cat->name}}</li>
            @endforeach
        </ul>
    </div>
    <div class="rfloat ui-col ui-col-75" id="products-list">
        <ul class="ui-list ui-border-tb dis" id="tbc_0">
        @foreach($categories as $key=> $cat)
            @if($cat->id == $categories[0]->id)
                <ul class="ui-list ui-border-tb dis" id="tbc_{{$key+1}}">
                    @foreach($products as $product)
                        <li class="ui-border-t">
                            <div class="ui-list-thumb">
                                <span style="background-image:url({{$product->logo}})"></span>
                            </div>
                            <div class="ui-list-info">
                                <a href="/shop/detail?id={{$product->id}}" class="ui-txt-default">
                                    <h6 class="">{{$product->name}}</h6>
                                    {{--<div class="ui-label-list">--}}
                                    {{--<label class="ui-label-s ui-nowrap"--}}
                                    {{--style="color:#6caf61;border-color: #6caf61;">{{$product->introduction}}</label>--}}
                                    {{--</div>--}}
                                    @if($product->price)
                                        <div class="ui-badge-muted" style="background:#18B4ED;">零售价格 ￥{{$product->price}}</div>
                                    @endif

                                    {{--<h6 class="ui-nowrap ui-txt-info">{{$product->introduction}}</h6>--}}
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <ul class="undis" id="tbc_{{$key+1}}"></ul>
            @endif
        @endforeach
    </div>
</div>
<script src="http://cdn.bootcss.com/bootswatch/2.0.2/js/jquery.js"></script>
<script type="text/javascript" language="javascript">
    function hoverli(id,cat_id) {
        var x = document.getElementById("nav").getElementsByTagName("li");
        for (var i = 0; i < x.length; i++) {console.log(i);
            document.getElementById('tb_' + i).style.background = '#f8f8f8';
            document.getElementById('tb_' + i).style.color = '#000000';
            document.getElementById('tbc_' + i).className = 'undis';
        }
        $.ajax({
            url: '/shop/get-products-by-cat-id',
            data: {
                //cat_id: id;
                cat_id: cat_id //分类id
            },
            type: "get",
            dataType: "json",
            success: function (json) {
                strHtml = '';
                $(json.products).each(function () {
                    //strHtml += '<li class="ui-border-t"><div class="ui-list-thumb"><span style="background-image:url(http://placeholder.qiniudn.com/100x100)"></span></div><div class="ui-list-info"><a href="/shop/detail?id=' + this.id + '" class="ui-txt-default"><h4 class="ui-nowrap">' + this.name + '</h4><p class="ui-nowrap">' + this.introduction + '</p></a></div></li>';
                    if (this.tag) {
                        strHtml += '<li class="ui-border-t"><div class="ui-list-thumb"><span style="background-image:url(' + this.logo + ')"></span></div><div class="ui-list-info"><a href="/shop/detail?id=' + this.id + '" class="ui-txt-default"><h6 class="">' + this.name + '</h6><div class="ui-badge-muted" style="background:#18B4ED;">' + this.price + '</div></a></div></li>';
                    } else {
                        strHtml += '<li class="ui-border-t"><div class="ui-list-thumb"><span style="background-image:url(' + this.logo + ')"></span></div><div class="ui-list-info"><a href="/shop/detail?id=' + this.id + '" class="ui-txt-default"><h6 class="">' + this.name + '</h6></a></div></li>';
                    }
                });
                if (strHtml == '') {
                    $("#tbc_" + cat_id).html('<div class="ui-txt-tips ui-txt-info ui-flex ui-flex-pack-center ui-top">已经没有更多产品了！</div>');
                } else {
                    $("#tbc_" + cat_id).html(strHtml);
                }

            },
            error: function (xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
            }
        });
        document.getElementById('tbc_' + id).className = 'ui-list ui-border-tb dis';
        document.getElementById('tb_' + id).style.background = '#00a5e0';
        document.getElementById('tb_' + id).style.color = 'white';
    }
</script>
</body>
</html>
