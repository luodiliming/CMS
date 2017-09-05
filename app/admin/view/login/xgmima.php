<extend file='resource/admin/index.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="javascript:;">修改密码</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="javascript:post(event);">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">修改密码</h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="catname" class="col-sm-2 control-label">liming</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{v('userinfo.username')}}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">新密码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="password" name="password"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="xgmima" class="col-sm-2 control-label">确认密码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="xgmima" name="xgmima" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button class="btn btn-primary">保存数据</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function post(event) {
                require(['util'], function (util) {
                    util.submit({
                        successUrl:"refresh"
                    });
                });
            }
        </script>

        <parent name="footer">
</block>