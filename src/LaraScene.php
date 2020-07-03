<?php
/*
 * @Description: Validate Scene Trait
 * @Author: uSee
 * @Date: 2020-03-05 15:53:58
 * @LastEditors: Wuxi
 * @LastEditTime: 2020-03-16 09:53:03
 */

namespace Usee\LaraScene;

trait Scene
{
    /**
     * 所有规则
     *
     * @var array
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     */
    // protected $allRules = [];

    /**
     * 所有自定义错误信息
     *
     * @var array
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     */
    // protected $allMessages = [];

    /**
     * 验证器场景数组
     *
     * @var array
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     */
    // protected $scenes = [];

    /**
     * 当前场景
     *
     * @var string
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     */
    protected $currentScene = '';

    /**
     * 返回验证自定义消息
     *
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     * @return array
     */
    public function messages(): array
    {
        return $this->allMessages ?? [];
    }

    /**
     * 设置当前场景
     *
     * @Description: 
     * @Author: Wuxi | wuxi@wufeng-network.com
     * @DateTime 2020-03-11
     * @param string $scene
     * @return void
     */
    public function setCurrentScene(string $scene = ''): void
    {
        if (empty($scene)) {
            $as = $this->route()->getAction('as');
            list($controller, $scene) = explode('.', $as);
        }

        $this->currentScene = $scene ?? '';
    }

    /**
     * 返回验证规则
     *
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     * @return array
     */
    public function rules(): array
    {
        // 设置当前场景
        !$this->currentScene && $this->setCurrentScene('');

        // 获取场景下的规则名
        $rule_name = $this->scenes[$this->currentScene] ?? [];

        // 获取规则名对应的规则
        return array_intersect_key(($this->allRules ?? []), array_flip($rule_name));
    }
}