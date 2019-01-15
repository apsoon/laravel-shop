<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:30
 */

namespace App\Http\Service;

use App\Http\Dao\BrandDao;
use App\Http\Model\Brand;

/**
 * Class UserService
 *
 * @package App\Http\Service
 */
class BrandService
{
    /**
     * @var BrandDao
     */
    private $brandDao;


    /**
     * @return Brand[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllBrand()
    {
        $result = $this->brandDao->findAll();
        return $result;
    }

    /**
     * 创建商标
     *
     * @param $req
     * @return bool
     */
    public function createBrand($req)
    {
        $brand = new Brand();
        $brand->name = $req["name"];
        $brand->region = $req["region"];
        $brand->logo = $req["logo"];
        $brand->describe = $req["desc"];
        $brand->state = $req["state"];
        $result = $this->brandDao->insert($brand);
        return $result;
    }

    /**
     * BrandService constructor.
     *
     * @param BrandDao $brandDao
     */
    public function __construct(BrandDao $brandDao)
    {
        $this->brandDao = $brandDao;
    }
}