# LaraScene
因为 `Laravel` 的验证器没有类似于 `ThinkPHP` 的场景验证，所以写个了 Trait 来代替

### **使用方法**

> composer require usee/lara_scene

成功引入 *Composer* 后，在 `Request` 头部调用它，然后在 XxxRequest 中创建构造方法，在方法中增加 `AllRules`、`AllMessages`、`Scenes` 三个属性，同 ThinkPHP

#### 如下：
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Usee\LaraScene\Scene; // 引入 Composer 包

class TestRequest extends FormRequest
{
    use Scene; // 使用它

    public function __construct()
    {
        // 定义 allRules
        $this->allRules = [
            'username'  => 'required|alpha_dash',
            'age'       => 'required|integer|min:0',
            'page'      => 'integer|min:1',
            'rows'      => 'integer|min:10'
        ];

        // 定义 allMessages
        $this->allMessages = [
            'username.required'     => '用户名称必须填写',
            'username.alpha_dash'   => '用户名称禁止含有特殊字符',
            'age.required'          => '年龄必须填写',
            'age.integer'           => '年龄只能为整数',
            'age.min'               => '年龄最小只能为0',
            'page.integer'          => '页码只能为整数',
            'page.min'              => '页码最小只能为1',
            'rows.integer'          => '每页显示条数只能为整数',
            'rows.min'              => '每页显示条数最小为10条',
        ];

        // 定义 scenes
        $this->scenes = [
            'index' => ['page', 'rows'],
            'create'=> ['username', 'age']
        ];
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
}

```
