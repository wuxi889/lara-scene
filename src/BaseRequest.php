<?php

namespace Usee\LaraScene;

use Illuminate\Foundation\Http\FormRequest;
use Usee\LaraScene\Traits\Scene;

class BaseRequest extends FormRequest
{
    use Scene;

    /**
     * 是否有分页请求
     *
     * @var boolean
     */
    protected $queryRequest = false;

    /**
     * 构造方法
     */
    public function __construct()
    {
        // 添加分页验证
        if ($this->queryRequest) $this->addQueryValidate();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 添加分页验证
     *
     * @return void
     */
    protected function addQueryValidate()
    {
        $this->addScene('index', ['current', 'pageSize']);

        $this->addAllRules('current', 'integer|min:1', [
            'current.integer' => '页码必须为整数',
            'current.min' => '页码最小为1',
        ]);

        $this->addAllRules('pageSize', 'integer|min:5', [
            'pageSize.integer' => '分页大小必须为整数',
            'pageSize.min' => '分页大小最小为5',
        ]);
    }
}
