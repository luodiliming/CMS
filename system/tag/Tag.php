<?php namespace system\tag;
use houdunwang\view\build\TagBase;

class Tag extends TagBase
{
    /**
     * 标签声明
     * @var array
     */
    public $tags = [
        'prev' => [ 'block' => false ],//行集元素
        'next' => [ 'block' => false ],
        'lunbo' => ['block' => true, 'level' => 4],//块级元素
        'category' => ['block' => true, 'level' => 4],
        'yuedu' => ['block' => true, 'level' => 4],
        'content' => ['block' => true, 'level' => 4],
    ];


//栏目标签
    public function _category( $attr, $content, &$view ) {
        $pid = isset($attr['pid']) ? $attr['pid'] : -1;
        $cid = isset($attr['cid']) ? $attr['cid'] : 0;

        $str = <<<str
        <?php 
        \$db = Db::table('category');
        if($pid >= 0){
            \$db->where('pid',$pid);
        }
        if($cid > 0){
            \$db->where('cid',$cid);
        }
    
         \$category = \$db->get();
         foreach(\$category as \$key => \$v){ 
         \$v['url'] = __ROOT__ . '/' . '?s=home/entry/lists&id=' . \$v['cid'];
          ?>
         $content
       <?php } ?>
str;
        return $str;
    }


    //轮播图标签！
        public function _lunbo($attr, $content, &$view ){
        $str = <<<str
        <?php
        \$lunbo = Db::table('lunbo')->get();
        foreach(\$lunbo as \$key => \$v){
        \$v['thumb'] = __ROOT__ . '/' . \$v['thumb'];
        ?>
        $content
       <?php } ?>
str;
            return $str;
  }


//阅读标签

        public function _yuedu($attr, $content, &$view){
            $cat_cid = isset($attr['cat_cid']) ? $attr['cat_cid'] : -1;
            $thumb = isset($attr['thumb']) ?  $attr['thumb'] : -1;
            $str = <<<str
            <?php
             \$db = Db::table('yuedu');
             if($cat_cid >= 1){
             \$db->where('cat_cid',$cat_cid);
             }
              if($thumb == 1){
            \$db->where('thumb','!=','');
            }
            \$yuedu = \$db->get();
            foreach (\$yuedu as \$key => \$value){
            \$value['thumb'] = __ROOT__.'/'.\$value['thumb'];
             \$value['url'] = __ROOT__ . '/' . '?s=home/entry/content&aid=' . \$value['yid'];
            ?>
             $content
           <?php } ?>      
str;
            return $str;
        }


    //content标签    内容标签
    public function _content($attr, $content, &$view){
        $cid = isset($attr['cid']) ? $attr['cid'] : -1;
        $str = <<<str
        <?php
            \$db =  Db::table('yuedu');
            if($cid > 0){
              \$db->where('yid',$cid); 
            }
            \$yuedu = \$db->first();
            \$content = Db::table('category')->where('cid',\$yuedu['cat_cid'])->first();
        ?>
        $content
str;
        return $str;

    }


    /**
     * 上一篇
     */

    public function _prev($attr, $content, &$view){
        $yid = isset($attr['yid']) ? $attr['yid'] :-1;
        $str = <<<str
    <?php
        \$yuedu = Db::table('yuedu')->where('yid',$yid)->first();
         \$isset = Db::table('yuedu')->where('yid','<',$yid)->orderBy('yid','DESC')->first();
          if(\$isset){
          \$url = __ROOT__ . "/?s=home/entry/content&aid={\$isset['yid']}";
          echo "<a href='".\$url."'>".\$isset['title']."</a>";
          }else{
            echo "<span>没有上一篇了</span>";
        }
    ?>
str;
        return $str;
    }





    //下一篇
    public function _next($attr, $content, &$view){
        $yid = isset($attr['yid']) ? $attr['yid'] : -1;
        $str = <<<str
		<?php
        \$article = Db::table('yuedu')->where('yid',$yid)->first();
        \$isset = Db::table('yuedu')->where('yid','>',$yid)->first();
        if(\$isset){
            \$url = __ROOT__ . "/?s=home/entry/content&aid={\$isset['yid']}";
             echo "<a href='".\$url."'>".\$isset['title']."</a>";
        }else{
            echo "<span>没有下一篇了</span>";
        }
        ?>
str;
        return $str;
    }















}