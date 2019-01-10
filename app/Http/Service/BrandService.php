<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:30
 */

namespace App\Http\Service;

use App\Http\Dao\BrandDao;

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


    public function getAllBrand()
    {
        $result = $this->brandDao->getAll();
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