<?php
// +------------------------------------------------+
// |http://www.cjango.com                           |
// +------------------------------------------------+
// | 修复BUG不是一朝一夕的事情，等我喝醉了再说吧！  |
// +------------------------------------------------+
// | Author: 小陈叔叔 <Jason.Chen>                  |
// +------------------------------------------------+
namespace cjango\Dingtalk;

use cjango\Dingtalk;

/**
 * 用户管理
 */
class User extends Dingtalk
{

    /**
     * 获取企业员工人数
     * @param  integer $active  0:总数，1:已激活
     * @return array|boolean
     */
    public static function count($active = 0)
    {
        $params = [
            'onlyActive' => $active,
        ];

        $result = Utils::get('user/get_org_user_count', $params);

        if (false !== $result) {
            return $result['count'];
        } else {
            return false;
        }
    }

    /**
     * 获取用户详情
     * @param  string $userid 员工在企业内的UserID
     * @return array|boolean
     */
    public static function get($userid)
    {
        $params = [
            'userid' => $userid,
        ];

        $result = Utils::get('user/get', $params);

        if (false !== $result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 创建成员
     * @param  [type] $name       [description]
     * @param  string $mobile     [description]
     * @param  array  $department [description]
     * @return [type]             [description]
     */
    public static function create($name, $mobile, $department = [])
    {
        $params = [
            'name'       => $name,
            'mobile'     => $mobile,
            'department' => $department,
        ];

        $result = Utils::post('user/create', $params);

        if (false !== $result) {
            return $result['userid'];
        } else {
            return false;
        }
    }

    /**
     * 更新成员
     * @param  [type] $userid [description]
     * @param  [type] $name   [description]
     * @param  array  $data   [description]
     * @return [type]         [description]
     */
    public static function update($userid, $name, $data = [])
    {
        #Todo..
    }

    /**
     * 删除成员
     * @param  [type] $userid [description]
     * @return [type]         [description]
     */
    public static function delete($userid)
    {
        $params = [
            'userid' => $userid,
        ];

        $result = Utils::get('user/delete', $params);

        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 批量删除用户
     * @param  array  $useridlist
     * @return boolean
     */
    public static function batchDelete($useridlist = [])
    {
        $params = [
            'useridlist' => $useridlist,
        ];

        $result = Utils::post('user/batchdelete', $params);

        if (false !== $result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取管理员列表
     * @return array|boolean
     */
    public static function admin()
    {
        $result = Utils::get('user/get_admin');

        if (false !== $result) {
            return $result['adminList'];
        } else {
            return false;
        }
    }

    /**
     * 通过CODE换取用户身份
     * @param  string $code requestAuthCode接口中获取的CODE
     * @return string|boolean
     */
    public static function code($code)
    {
        $params = [
            'code' => $code,
        ];

        $result = Utils::get('user/getuserinfo', $params);

        if (false !== $result) {
            return $result['userid'];
        } else {
            return false;
        }
    }
}
