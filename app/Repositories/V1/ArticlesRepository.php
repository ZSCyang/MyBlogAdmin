<?php

namespace App\Repositories\V1;

use App\Models\Article;

class ArticlesRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Article();
    }

    /**
     * 添加博文
     * Author jintao.yang
     * @param $data
     * @return bool
     */
    public function add($data)
    {

        $data['content'] = $data['test-editormd'];
        $data =  $this->model->allowField($data, 'articles');
        $this->model->fillable(array_keys($data));
        $this->model->fill($data);
        return $this->model->save();
    }


    public function edit($data)
    {
        $data['content'] = $data['test-editormd'];
        $article = Article::find($data['article_id']);
        $data =  $article->allowField($data, 'articles');
        $article->fillable(array_keys($data));
        $article->fill($data);
        return $article->save();
    }
}