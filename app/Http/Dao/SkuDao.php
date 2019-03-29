<?php

namespace App\Http\Dao;

use App\Http\Model\Sku;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SkuDao
{
    /**
     * @var Sku
     */
    private $sku;

    /**
     * 添加Sku
     *
     * @param Sku $sku
     * @return bool
     */
    public function insert(Sku $sku)
    {
        $result = $sku->save();
        return $result;
    }


    /**
     * 根据ID查找
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->sku::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * 根据ID查找上架的SKU
     *
     * @param int $id
     * @return mixed
     */
    public function findByIdEffect(int $id)
    {
        $result = $this->sku::where(["id" => $id, "state" => 1])
            ->first();
        return $result;
    }

    /**
     * @param int $spuId
     * @return mixed
     */
    public function findBySpuId(int $spuId)
    {
        $result = $this->sku::where(["spu_id" => $spuId])
            ->get();
        return $result;
    }

    /**
     * spu获取上架的sku
     *
     * @param int $spuId
     * @return mixed
     */
    public function findBySpuIdEffect(int $spuId)
    {
        $result = $this->sku::where(["spu_id" => $spuId, "state" => 1])
            ->get();
        return $result;
    }

    /**
     * 减少数量
     *
     * @param int $id
     * @param int $number
     * @return bool|int
     */
    public function decreaseNumber(int $id, int $number)
    {
        $result = $this->sku::where(["id" => $id])
            ->decrement("number", $number);
        return $result;
    }

    /**
     * 增加数量
     *
     * @param $id
     * @param $number
     * @return mixed
     */
    public function increaseNumber($id, $number)
    {
        $result = $this->sku::where(["id" => $id])
            ->increment("number", $number);
        return $result;
    }

    /**
     * 分类分页获取
     *
     * @param $categoryId
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByCategoryEffectPaged($categoryId, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = DB::table("sku")
            ->join("spu", "sku.spu_id", "=", "spu.id")
            ->select("sku.id", "sku.spu_id", "spu.category_id", "sku.name", "sku.origin_price", "sku.price", "sku.number", "sku.brief", "sku.is_recom", "spu.brand_id")
            ->where(["spu.category_id" => $categoryId, "sku.state" => 1])
            ->offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 分类品牌分页获取
     *
     * @param $categoryId
     * @param $brandId
     * @param int $pageNo
     * @param int $size
     * @return \Illuminate\Support\Collection
     */
    public function findByCategoryBrandEffectPaged($categoryId, $brandId, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = DB::table("sku")
            ->join("spu", "sku.spu_id", "=", "spu.id")
            ->select("sku.id", "sku.spu_id", "spu.category_id", "sku.name", "sku.origin_price", "sku.price", "sku.number", "sku.brief", "sku.is_recom", "spu.brand_id")
            ->where(["spu.category_id" => $categoryId, "spu.brand_id" => $brandId, "sku.state" => 1])
            ->offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 获取推荐
     *
     * @return mixed
     */
    public function findByRecomEffect()
    {
        return $this->sku::where(["is_recom" => 1, "state" => 1])->get();
    }

    /**
     * 获取热销
     *
     * @return mixed
     */
    public function findByHotEffect()
    {
        return $this->sku::where(["is_hot" => 1, "state" => 1])->get();
    }

    /**
     * 设置推荐
     *
     * @param $id
     * @param $isSet
     * @return mixed
     */
    public function modifyRecomById($id, $isSet)
    {
        return $this->sku::where("id", "=", $id)->update(["is_recom" => $isSet]);
    }

    /**
     * 设置热销
     *
     * @param $id
     * @param $isSet
     * @return mixed
     */
    public function modifyHotById($id, $isSet)
    {
        return $this->sku::where("id", "=", $id)->update(["is_hot" => $isSet]);
    }

    /**
     * 设置状态
     *
     * @param $id
     * @param $state
     * @return mixed
     */
    public function modifyState($id, $state)
    {
        return $this->sku::where("id", "=", $id)->update(["state" => $state]);
    }

    /**
     * name 模糊查找
     *
     * @param $name
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByNameLikeEffect($name, int $pageNo, int $size)
    {
        Log::info("====================================");
        Log::info($name);
        $offset = ($pageNo - 1) * $size;
        $result = $this->sku::where("state", '=', 1)
            ->where("name", "like", "%" . $name . "%")
            ->offset($offset)
            ->limit($size)
            ->get();
        Log::info($result);
        return $result;
    }

    /**
     * 分页获取的
     *
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByPage(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->sku::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 分页获取有效的
     *
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByPageEffect(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->sku::where("state", '=', 1)
            ->offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * SkuDao constructor.
     *
     * @param Sku $sku
     */
    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }
}
