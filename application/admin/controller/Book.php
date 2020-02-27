<?php


namespace app\admin\controller;
use app\admin\model\Book as BookModel;

class Book extends  Common
{
    public function lst()
    {
        $book=BookModel::paginate(4);
        $this->assign('book',$book);
        return view();
    }
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $select=db('book')->where(array('name'=>$data['name']))->select();
            if (empty($select)) {
                $add = db('book')->insert($data);
                if ($add) {
                    $this->success('添加书成功', url('lst'));
                } else {
                    $this->error('添加书失败！');
                }
            }else{
                $this->error('数据库已经有此书籍！');
            }
            return;
        }
        return view();
    }
    public  function  del($id){
        $bookdel=new BookModel();
        $delnum=$bookdel->del($id);
        if($delnum=='1'){
            $this->success('删除图书成功！',url('lst'));
        }else{
            $this->error('删除失败');
        }
    }
}