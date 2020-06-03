<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Response\ResponseJson;
use App\Models\Article;
use App\Repositories\DictionariesRepository;
use App\Repositories\V1\ArticlesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{

    use ResponseJson;
    protected $articlesRepository;
    protected $dictionariesRepository;
    public function __construct(ArticlesRepository $articlesRepository, DictionariesRepository $dictionariesRepository)
    {
        $this->articlesRepository = $articlesRepository;
        $this->dictionariesRepository = $dictionariesRepository;
    }

    public function index(Request $request, Article $article)
    {
        $typeId = $request->input('type');
        $title = $request->input('title');
        $status = $request->input('status');
        $articlesList = $article->where(function ($query) use ($typeId, $title) {
            if (!empty($typeId)) {
                $query->where('type', $typeId);
            }
            if (!empty($title)) {
                $query->where('title', 'like', "%$title%");
            }
        })
            ->where(function ($query) use ($status) {
                if (!empty($status)) {
                    $query->where('status', $status);
                }
            })
            ->orderby('created_at', 'desc')
            ->paginate(2);

        $typeList = $this->dictionariesRepository->getListByType(2);
        return view('admin.articles.index', compact('articlesList', 'typeList', 'typeId', 'title', 'status'));
    }


    public function addPost(ArticleRequest $request)
    {
        $data = $request->all();
        //上传图片
        $upload_result = $this->uploadPic($data['base64Img'], 'articles');

        if ($upload_result['code'] == 200) {
            $data['pic'] = $upload_result['data'];
        } else {
            return $this->jsonData('10005', $upload_result['data']);
        }
        $result = $this->articlesRepository->add($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }


    public function add()
    {
        $typeList = $this->dictionariesRepository->getListByType(2);
        return view('admin.articles.add', compact('typeList'));
    }

    public function detail(Article $article, Request $request)
    {
        $typeId = $request->input('type');
        $status = $request->input('status');
        $title = $request->input('title');
        $typeList = $this->dictionariesRepository->getListByType(2);
        return view('admin.articles.detail', compact('typeId', 'title', 'typeList', 'article', 'status'));
    }

    public function edit(Article $article, Request $request)
    {
        $typeId = $request->input('type');
        $title = $request->input('title');
        $typeList = $this->dictionariesRepository->getListByType(2);
        return view('admin.articles.edit', compact('typeId', 'title', 'typeList', 'article'));
    }


    public function editPost(ArticleRequest $request)
    {
        $data = $request->all();
        //判断是否参数是否存在
        if (empty($data['article_id']) || !is_numeric(strval($data['article_id']))) {
            return $this->jsonData('10005', '参数错误，请刷新后重试');
        }

        //如果图片有修改
        if ($data['imgStatus'] ==  2) {
            //上传图片
            $upload_result = $this->uploadPic($data['base64Img'], 'articles');

            if ($upload_result['code'] == 200) {
                $data['pic'] = $upload_result['data'];
            } else {
                return $this->jsonData('10005', $upload_result['data']);
            }
        }

        $result = $this->articlesRepository->edit($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }

}
