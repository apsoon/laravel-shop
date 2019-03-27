<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 09:42
 */

namespace App\Http\Dao;


use App\Http\Model\SpuGallery;

/**
 * Class SpuGalleryDao
 *
 * @package App\Http\Dao
 */
class SpuGalleryDao
{
    /**
     * @var SpuGallery
     */
    private $spuGallery;

    /**
     * @param SpuGallery $spuGallery
     * @return bool
     */
    public function insert(SpuGallery $spuGallery)
    {
        return $spuGallery->save();
    }

    /**
     * spuId获取
     *
     * @param $spuId
     * @return mixed
     */
    public function findBySpuId($spuId)
    {
        return $this->spuGallery::where("spu_id", "=", $spuId)->get();
    }

    /**
     * SpuId 获取有效的
     *
     * @param $spuId
     * @return mixed
     */
    public function findBySpuIdEffect($spuId)
    {
        return $this->spuGallery::where(["spu_id" => $spuId, "state" => 1])->get();
    }

    /**
     * 更新状态
     *
     * @param $id
     * @param $state
     * @return mixed
     */
    public function updateState($id, $state)
    {
        return $this->spuGallery::where(["id" => $id])->update(["state" => $state]);
    }

    /**
     * id 查找
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $result = $this->spuGallery::where("id", "=", $id)
            ->first();
        return $result;
    }

    /**
     * id删除
     *
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id)
    {
        $result = $this->spuGallery::where(["id" => $id])
            ->delete();
        return $result;
    }

    /**
     * 批量删除
     *
     * @param array $ids
     * @return mixed
     */
    public function deleteByIds(array $ids)
    {
        $result = $this->spuGallery::whereIn("id", $ids)
            ->delete();
        return $result;
    }

    /**
     * 更新
     *
     * @param SpuGallery $banner
     * @return bool
     */
    public function update(SpuGallery $banner)
    {
        return $banner->save();
    }

    /**
     * SpuGalleryDao constructor.
     * @param SpuGallery $spuGallery
     */
    public function __construct(SpuGallery $spuGallery)
    {
        $this->spuGallery = $spuGallery;
    }
}