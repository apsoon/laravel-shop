<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 10:59
 */

namespace App\Http\Dao;


use App\Http\Model\Admin;

/**
 * Class AdminDao
 * @package App\Http\Dao
 */
class AdminDao
{
    /**
     * @var Admin
     */
    private $admin;

    /**
     * 获取所有
     *
     * @return Admin[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return $this->admin::all();
    }

    /**
     * 名子获取
     *
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return $this->admin::where("name", "=", $name)->first();
    }

    /**
     * AdminDao constructor.
     *
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
}