<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0" />
    <title>ラムラムツアーズ　赤いシャトルバス</title>
    <style>@media screen and (max-device-width:480px){body{-webkit-text-size-adjust:none}}</style>
    <script>
    window.onload = function() {
        @if ($platform == 'android')
            location.href = '{{config("define.deeplink_url.android")}}';
            setTimeout('location.href = "{{config("define.store_url.android")}}";', 1000);
        @elseif ($platform == 'ios')
            location.href = '{{config("define.deeplink_url.ios")}}';
            setTimeout('location.href = "{{config("define.store_url.ios")}}";', 1000);
        @endif
        return false;
    }
    </script>
</head>
<body>
</body>
</html>
