
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>HDCMS开源免费-微信/桌面/移动三网通CMS系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="{{__ROOT__}}/node_modules/hdjs/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{__ROOT__}}/node_modules/hdjs/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{__ROOT__}}/resource/css/hdcms.css" rel="stylesheet">
    <script>
        if (navigator.appName == 'Microsoft Internet Explorer') {
            if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }
    </script>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script>
        //模块配置项
        var hdjs = {
            //框架目录
            'base': 'node_modules/hdjs',
            //上传文件后台地址
            'uploader': '?s=component/upload/uploader',
            //获取文件列表的后台地址
            'filesLists': '?s=component/upload/filesLists',
        };
    </script>
    <script src="{{__ROOT__}}/node_modules/hdjs/app/util.js"></script>
    <script src="{{__ROOT__}}/node_modules/hdjs/require.js"></script>
    <script src="{{__ROOT__}}/node_modules/hdjs/config.js"></script>



</head>
<body class="hdcms-login">
<div class="container logo">
    <div style="background: url('http://www.houdunwang.com/resource/images/logo.png') no-repeat; background-size: contain;height: 60px;"></div>
</div>
<div class="container well">
    <div class="row ">
        <div class="col-md-6">
            <form method="post" action="javascript:post(event);">
<!--                -->
                <input type='hidden' name='csrf_token' value=''/>

                <input type='hidden' name='csrf_token' value=''/>
                <div class="form-group ">
                    <label>帐号</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-w fa-user"></i></div>
                        <input type="text" name="username" class="form-control input-lg"
                               placeholder="请输入帐号" value="">
                    </div>
                </div>
                <div class="form-group ">
                    <label>密码</label>

                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-w fa-key"></i></div>
                        <input type="password" name="password"
                               class="form-control input-lg" placeholder="请输入密码" value="">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg">登录</button>
                <a class="btn btn-default btn-lg" href="http://www.houdunwang.com?s=system/entry/register&">注册</a>
            </form>
        </div>
        <div class="col-md-6">
<!--            <div style="background: url('http://www.houdunwang.com/resource/images/houdunwang.jpg');background-size:100% ;height:230px;"></div>-->

            <!--        练练-->



            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="{{$model[0]['thumb']}}" alt="" style="height: 50%;width: 50%"></div>
                    <div class="swiper-slide"><img src="{{$model[0]['thumb']}}" alt=""></div>
                    <div class="swiper-slide"><img src="{{$model[0]['thumb']}}" alt=""></div>
                </div>
                <!-- 分页器 -->
                <div class="swiper-pagination"></div>
            </div>
            <style>
                .swiper-container {
                    width      : 100%;
                    height     : 150px;
                    background : #aaa;
                }
            </style>
            <script>
                require(['swiper'], function ($) {
                    var mySwiper = new Swiper('.swiper-container', {
                        width: window.innerWidth,
                        height: 150,
                        autoplay: 3000,
                        direction: 'horizontal',
                        loop: true,
                        // 分页器
                        pagination: '.swiper-pagination',
                    })
                })
            </script>







            <!--        练练-->


        </div>
    </div>
    <div class="copyright">
        Powered by hdcms v2.0 © 2014-2019 www.hdcms.com
    </div>
    <script type="text/javascript">
        function post(event) {
            require(['util'], function (util) {
                util.submit({
                    successUrl:"{{u('admin.entry.index')}}"
                });
            });
        }
    </script>
</div>
</body>
</html>