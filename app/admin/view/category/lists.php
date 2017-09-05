<extend file='resource/admin/index.php'/>
<block name="content">
    <parent name="header" title="这是标题">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="{{u('lists')}}">栏目列表</a></li>
                    <li role="presentation"><a href="{{u('post')}}">添加栏目</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                    <tr>
                        <td width="80">编号</td>
                        <td>栏目名称</td>
                        <td>栏目介绍</td>
                        <td>排序</td>
                        <td>父级目录</td>
                        <td width="150">操作</td>
                    </tr>
<!--                    通过comprct方法让变量变数组对其遍历-->
                    <foreach from="$data" value="$v">
                        <tr>
                            <td>{{$v['cid']}}</td>
                            <td>{{$v['_name']}}</td>
                            <td>{{$v['jieshao']}}</td>
                            <td>{{$v['orderby']}}</td>
                            <td>{{$v['pid']}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">
<!--想要编辑哪个，就要带参数过去!   u方法都懂的！  大意是   ?s=post/cid=>$v['cid']  第几个    通过post修改添加方法走！              -->
                                    <a href="{{u('post',['cid'=>$v['cid']])}}" class="btn btn-default">编辑</a>
                                    <a href="javascript:;" onclick="destory({{$v['cid']}})" type="button" class="btn btn-default">删除</a>
                                </div>
                            </td>
                        </tr>
                    </foreach>
                </table>
            </div>
        </div>
        <script >
            function destory(cid) {
                if(confirm('确定删除吗?')){
                    location.href="{{u('delete')}}&cid=" + cid;
                }
            }
        </script>
        <parent name="footer">
</block>