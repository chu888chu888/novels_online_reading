<?php
class RegAction extends Action {
    public function index(){
        $this->display();
    }
    public function add(){
    	 $User = D("User");
        if ($vo = $User->create()) {
            $list = $User->add();
            /* 比如
             *  $Form->add($data);
              或者使用data方法连贯操作
              $User->data($data)->add();
              如果在add之前已经创建数据对象的话（例如使用了create或者data方法），add方法就不需要再传入数据了。
             */
            //如果你的主键是自动增长类型，并且如果插入数据成功的话，add方法的返回值就是最新插入的主键值，可以直接获取。 
            if ($list !== false) {
                $this->success('数据保存成功！');
            } else {
                $this->error('数据写入错误！');
            }
        } else {
            $this->error($User->getError());
        }

    }
}