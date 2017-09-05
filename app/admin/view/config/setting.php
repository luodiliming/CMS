<extend file='resource/admin/index.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="{{u('post')}}">网站配置</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <form class="form-horizontal" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">网站配置</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="webname" class="col-sm-2 control-label">网站名称</label>
                    <div class="col-sm-10">
<!--                                                                        注意表里的名字就这么起的 ，忘记咋改了 就用nanme把-->
                        <input type="text" class="form-control" id="nanme" name="nanme"
                               value="{{$conData['nanme']}}"
                               placeholder="请输入栏目名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="keywords" class="col-sm-2 control-label">网站关键字</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="guanjian" name="guanjian"
                               value="{{$conData['guanjian']}}"
                               placeholder="请输入栏目名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="tell" class="col-sm-2 control-label">联系电话</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tell" name="tell"
                               value="{{$conData['tell']}}"
                               placeholder="请输入栏目名称">
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">文章设置</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="article_row" class="col-sm-2 control-label">文章显示条数</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tiaoshu" name="tiaoshu"
                               value="{{$conData['tiaoshu']}}"
                               placeholder="请输入栏目名称">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button class="btn btn-primary">保存数据</button>
                    </div>
                </div>
            </form>
        </div>


        <parent name="footer">
</block>