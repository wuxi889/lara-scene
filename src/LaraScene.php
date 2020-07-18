<?php

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
    protected $all_rules = [];

    /**
     * 所有自定义错误信息
     *
     * @var array
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     */
    protected $all_messages = [];

    /**
     * 验证器场景数组
     *
     * @var array
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     */
    protected $scenes = [];

    /**
     * 当前场景
     *
     * @var string
     * @Description: 
     * @Author: uSee | you-see@qq.com
     * @DateTime 2020-03-06
     */
    protected $current_scene = '';

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
        return $this->all_messages ?? [];
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
            $uses = $this->route()->getAction('uses');
            list(, $scene) = explode('@', $uses);
        }

        $this->current_scene = $scene ?? '';
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
        !$this->current_scene && $this->setCurrentScene('');

        // 获取场景下的规则名
        $rule_name = $this->scenes[$this->current_scene] ?? [];

        // 获取规则名对应的规则
        return array_intersect_key(($this->all_rules ?? []), array_flip($rule_name));
    }

    /**
     * 添加场景
     *
     * @param string $scene
     * @param array $rules
     * @return void
     */
    public function addScene(string $scene, array $rules): void
    {
        $this->scenes[$scene] = $rules;
    }

    /**
     * 添加规则
     *
     * @param string $name
     * @param string $rule
     * @param array $messages
     * @return void
     */
    public function addAllRules(string $name, string $rule, array $messages): void
    {
        $this->all_rules[$name] = $rule;
        $this->all_messages = array_merge($this->all_messages, $messages);
    }
}