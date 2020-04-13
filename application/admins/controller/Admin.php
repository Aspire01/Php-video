<?php

namespace app\admins\controller;

class Admin extends BaseAdmin
{
  /**
   * 渲染页面以及数据
   */
  public function index()
  {
    $data['lists'] =  $this->db->table('admins')->lists();
    $this->assign('data', $data);
    return  $this->fetch();
  }

  /**
   * 添加管理员
   */
  public function add()
  {

    // 获取角色列表
    $data['lists'] = $this->db->table('admin_groups')->lists();

    $this->assign('data', $data);

    return $this->fetch();
  }

  /**
   * 保存管理员信息
   */
  public function save()
  {
    $data['username'] = trim(input('post.username'));
    $data['gid'] = (int)(input('post.gid'));
    $password = trim(input('post.pwd'));
    $data['realname'] = trim(input('post.truename'));
    $data['status'] = input('post.status');
    $data['status'] = $data['status'] ? $data['status'] : 0;
    $data['add_time'] = time();
    // var_dump($data);
    if (!$data['username']) {
      exit(json_encode(array('code' => 1, 'msg' => '用户名不能为空')));
    }
    if (!$data['gid']) {
      exit(json_encode(array('code' => 1, 'msg' => '角色不能为空')));
    }
    if (!$password) {
      exit(json_encode(array('code' => 1, 'msg' => '密码不能为空')));
    }
    if (!$data['realname']) {
      exit(json_encode(array('code' => 1, 'msg' => '姓名不能为空')));
    }

    $data['password'] = md5($data['username'].$password);
 
    // 查询是否存在此用户名
    $item = $this->db->table('admins')->where(array('username' => $data['username']))->item();
    if ($item) {
      exit(json_encode(array('code' => 1, 'msg' => '用户已存在')));
    }

    $ret = $this->db->table('admins')->insert($data);
    if(!$ret) {
      exit(json_encode(array('code'=>1, 'msg'=>'保存失败')));
    }
    exit(json_encode(array('code'=> 0, 'msg'=> '保存成功')));
  }

  /**
   * 删除
   */
  public function delete() {
    $id = input('post.id');
    $res = $this->db->table('admins')->where(array('id'=> $id))->delete();
    if(!$res){
      exit(json_encode(array('code'=>1, 'msg'=> '删除失败')));
    }
    exit(json_encode(array('code'=> 0, 'msg' => '删除成功')));
  }

  
}
