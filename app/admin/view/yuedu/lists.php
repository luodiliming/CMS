
    <extend file='resource/admin/index.php'/>
    <block name="content">
        <!-- TAB NAVIGATION -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="{{u('lists')}}">文章列表</a></li>
            <li><a href="{{u('post')}}">添加文章</a></li>
        </ul>
        <!-- TAB CONTENT -->
        <div class="tab-content">
            <div class="active tab-pane fade in" id="tab1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th width="100">标题</th>
                        <th width="80">点击量</th>
                        <th width="100">文章描述</th>
                        <th width="180">文章内容</th>
                        <th width="100">来源</th>
                        <th width="100">作者</th>
                        <th width="100">排序值</th>
                        <th width="120">地址</th>
                        <th width="80">关键词</th>
                        <th width="100">是否推荐</th>
                        <th width="100">是否热门</th>
                        <th width="100">所属栏目</th>
                        <th width="100">缩略图</th>
                        <th width="180">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <foreach from="$data" value="$v">
                        <tr>

                            <td>{{$v['yid']}}</td>
                            <td style="
    overflow:hidden;
    white-space:nowrap;
    text-overflow:ellipsis;
    -o-text-overflow:ellipsis;
    -icab-text-overflow: ellipsis;
    -khtml-text-overflow: ellipsis;
    -moz-text-overflow: ellipsis;
    -webkit-text-overflow: ellipsis;  ">{{$v['title']}}</td>
                            <td>{{$v['click']}}</td>
                            <td style="
    overflow:hidden;
    white-space:nowrap;
    text-overflow:ellipsis;
    -o-text-overflow:ellipsis;
    -icab-text-overflow: ellipsis;
    -khtml-text-overflow: ellipsis;
    -moz-text-overflow: ellipsis;
    -webkit-text-overflow: ellipsis;  ">{{$v['description']}}</td>

                            <td style="
    overflow:hidden;
    white-space:nowrap;
    text-overflow:ellipsis;
    -o-text-overflow:ellipsis;
    -icab-text-overflow: ellipsis;
    -khtml-text-overflow: ellipsis;
    -moz-text-overflow: ellipsis;
    -webkit-text-overflow: ellipsis;  ">{{$v['content']}}</td>



                            <td>{{$v['source']}}</td>
                            <td>{{$v['author']}}</td>
                            <td>{{$v['orderdy']}}</td>
                            <td>{{$v['linkurl']}}</td>
                            <td>{{$v['keywords']}}</td>
                            <td>{{$v['iscommend']}}</td>
                            <td>{{$v['ishot']}}</td>
                            <td>{{$v['name']}}</td>
                            <td><img src="{{pic($v['thumb'])}}" style="width: 50px;height: 50px;"></td>
                            <td>
                                <a href="{{u('post',['yid'=>$v['yid']])}}" class="btn btn-primary btn-xs">编辑</a>
                                <a href="javascript:;" onclick="destory({{$v['yid']}})" class="btn btn-danger btn-xs">删除</a>
                            </td>
                        </tr>
                    </foreach>

                    </tbody>
                </table>
            </div>


        </div>
        <script >
            function destory(yid) {
                if(confirm('确定删除吗?')){
                    location.href="{{u('delete')}}&yid=" + yid;
                }
            }
        </script>
{{$data->links()}}

    </block>

