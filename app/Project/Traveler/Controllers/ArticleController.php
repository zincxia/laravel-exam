<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/31
 * Time: 15:39
 */

namespace App\Project\Traveler\Controllers;


use App\Admin\Models\TravelerArticle;

/**
 * 文章管理
 * Class ArticleController
 * @package App\Project\Traveler\Controllers
 */
class ArticleController extends Base
{
    /**
     * 获取对应id文章内容
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContent()
    {
        $id = Request()->input('id');
        $cond = ['id' => $id];
        $content = TravelerArticle::where($cond)->first();
        return view('Traveler/Article/index',
            ['content' => $content]);
    }
}