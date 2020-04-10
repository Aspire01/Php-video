<?php

namespace app\admins\controller;

class Admin extends BaseAdmin 
{
  /**
   * 渲染页面以及数据
   */
  public function index() {
    $data['lists'] =  $this->db->table('admins')->lists();
    $this->assign('data',$data);
    return  $this->fetch();
  }

  /**
   * 添加管理员
   */
  public function add() {

    // 获取角色列表
    $data['lists'] = $this->db->table('admin_groups')->lists();
    // var_dump($data);
    // exit;

    $this->assign('data',$data);

    return $this->fetch();
  }
}