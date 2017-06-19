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
            <li class="aa" id="0" name="all">所有</li>
            @foreach($categories as $key=>  $cat)
                <li class="aa" id="{{ $cat->id  }}" >{{$cat->name}}</li>
            @endforeach
        </ul>
    </div>
    <div class="rfloat ui-col ui-col-75" id="products-list">
        <ul class="ui-list ui-border-tb dis" id="tbc_0"></ul>
        @foreach($categories as $key=> $cat)
                <ul class="ui-list ui-border-tb dis" id="tbc_{{$cat->id}}">
                    @foreach($products as $product)
                        <li class="ui-border-t">
                            <div class="ui-list-thumb">
                                <span style="background-image:url({{$product->logo}}?imageView2/1/w/65/h/65/q/90)"></span>
                            </div>
                            <div class="ui-list-info">
                                <a href="/shop/detail?id={{$product->id}}" class="ui-txt-default">
                                    <h6 class="">{{$product->name}}</h6>
                                    {{--<div class="ui-label-list">--}}
                                    {{--<label class="ui-label-s ui-nowrap"--}}
                                    {{--style="color:#6caf61;border-color: #6caf61;">{{$product->introduction}}</label>--}}
                                    {{--</div>--}}
                                    @if($product->price)
                                        <div class="ui-badge-muted" style="background:#18B4ED;">零售价格 {{$product->price}}</div>
                                    @endif
                                    {{--<h6 class="ui-nowrap ui-txt-info">{{$product->introduction}}</h6>--}}
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>

        @endforeach
    </div>
</div>
<script src="http://cdn.bootcss.com/bootswatch/2.0.2/js/jquery.js"></script>
<script type="text/javascript" language="javascript">
    $(function(){
        $("li[name='all']").trigger("click");
    });

    $("li.aa").click(function(){
        var _this =$(this);
        var id = $(_this).attr('id');
        $(_this).siblings().css({"background-color":"#f8f8f8","color":"#0a0a0a"});
        $(_this).css({"background-color":"#00a5e0","color":"white"});

        $.ajax({
            url: '/shop/get-products-by-cat-id',
            data: {
                cat_id: id
            },
            type: "get",
            dataType: "json",
            success: function (json) {
                $("#tbc_"+id).siblings().empty();
                strHtml = '';
                $(json.products).each(function () {
                    this.logo = this.logo+'?imageView2/1/w/65/h/65/q/90';
                    //strHtml += '<li class="ui-border-t"><div class="ui-list-thumb"><span style="background-image:url(http://placeholder.qiniudn.com/100x100)"></span></div><div class="ui-list-info"><a href="/shop/detail?id=' + this.id + '" class="ui-txt-default"><h4 class="ui-nowrap">' + this.name + '</h4><p class="ui-nowrap">' + this.introduction + '</p></a></div></li>';
                    if (this.name) {
                        strHtml += '<li class="ui-border-t"><div class="ui-list-thumb"><span style="background-image:url(' + this.logo + ')"></span></div><div class="ui-list-info"><a href="/shop/detail?id=' + this.id + '" class="ui-txt-default"><h6 class="">' + this.name + '</h6><div class="ui-badge-muted" style="background:#18B4ED;">零售价格 ' + this.price + '</div></a></div></li>';
                    } else {
                        strHtml += '<li class="ui-border-t"><div class="ui-list-thumb"><span style="background-image:url(' + this.logo + ')"></span></div><div class="ui-list-info"><a href="/shop/detail?id=' + this.id + '" class="ui-txt-default"><h6 class="">' + this.name + '</h6></a></div></li>';
                    }
                });
                if (strHtml == '') {
                    $("#tbc_"+id).html('<div class="ui-txt-tips ui-txt-info ui-flex ui-flex-pack-center ui-top">已经没有更多产品了！</div>');
                } else {
                    $("#tbc_"+id).html(strHtml);
                }

            },
            error: function (xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
            }
        });


    });

</script>
</body>
</html>
