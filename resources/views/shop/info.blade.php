<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>产品参数</title>
    <link rel="stylesheet" href="/css/frozen.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<!--头部导航-->
<header class="head-bar">
    <div class="bar-left">
        <a href="javascript:history.back()" class="goback"></a>
    </div>
    <div class="head-title">产品参数</div>
</header>
<div class="product-par">
    <table class="par-table">
        <tbody>
        <tr class="ui-border-b">
            <td class="key" width="70">品品组成</td>
            <td class="value">{{ $data->attention  }}</td>
        </tr>
        <tr class="ui-border-b">
            <td class="key" width="70">适用范围</td>
            <td class="value ">
                {{ $data->scope  }}
            </td>
        </tr>
        <tr class="ui-border-b">
            <td class="key" width="70">适用科室</td>
            <td class="value">{{ $data->office  }}</td>
        </tr>
        <tr class="ui-border-b">
            <td class="key" width="70">适用部位</td>
            <td class="value">{{ $data->standard  }}</td>
        </tr>
        <tr class="ui-border-b">
            <td class="key" width="70">产品规格</td>
            <td class="value">{{ $data->default_spec  }}</td>
        </tr>
        <tr class="ui-border-b">
            <td class="key" width="70">注册证号</td>
            <td class="value">{{ $data->registration  }}</td>
        </tr>
        <tr class="ui-border-b">
            <td class="key" width="70">生产企业</td>
            <td class="value">{{ $data->enterprise  }}</td>
        </tr>
        <tr class="ui-border-b">
            <td class="key" width="70">零售价格</td>
            <td class="value text-danger">{{ $data->price  }}</td>
        </tr>
        <tr class="ui-border-b">
            <td class="key" width="70">库存</td>
            <td class="value te">{{ $data->stock  }}</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>