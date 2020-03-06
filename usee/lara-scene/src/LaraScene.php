<?php
/*
 * @Description: Validate Scene Trait
 * @Author: uSee
 * @Date: 2020-03-05 15:53:58
 * @LastEditors: uSee
 * @LastEditTime: 2020-03-06 18:12:49
 */

namespace Usee\LaraScene;

use Illuminate\Foundation\Http\FormRequest;

trait Scene
{
    /**
     * 所有规则
     *
     * @var array
     * @Description: 
     * @Author: uSee | wuxi889@vip.qq.com
     * @DateTime 2020-03-06
     */
    protected $cusRules = [];

    /**
     * 自定义消息
     *
     * @var array
     * @Description: 
     * @Author: uSee | wuxi889@vip.qq.com
     * @DateTime 2020-03-06
     */
    protected $cusMessages = [];

    /**
     * 验证器场景数组
     *
     * @var array
     * @Description: 
     * @Author: uSee | wuxi889@vip.qq.com
     * @DateTime 2020-03-06
     */
    protected $scenes = [];

    /**
     * 当前场景
     *
     * @var string
     * @Description: 
     * @Author: uSee | wuxi889@vip.qq.com
     * @DateTime 2020-03-06
     */
    protected $currentScene = '';

    /**
     * 验证结果
     *
     * @Description: 
     * @Author: uSee | wuxi889@vip.qq.com
     * @DateTime 2020-03-06
     * @return boolean
     */
    protected function sceneValidator(): bool
    {
        // 验证器不存在 直接返回true
        if (!in_array($this->currentScene, array_keys($this->scenes))) return true;
        
        // 验证器存在 验证每条规则

        return true;
    }

    /**
     * 返回验证自定义消息
     *
     * @Description: 
     * @Author: uSee | wuxi889@vip.qq.com
     * @DateTime 2020-03-06
     * @return array
     */
    public function messages(): array
    {
        return $this->cusMessages;
    }

    /**
     * 返回验证规则
     *
     * @Description: 
     * @Author: uSee | wuxi889@vip.qq.com
     * @DateTime 2020-03-06
     * @return array
     */
    public function rules(): array
    {
        // 获取场景下的规则名
        $rules_name = $this->scenes[$this->currentScene];
        $all_rules = $this->cusRules;

        // 获取规则名对应的规则
        $rules = [];
        array_walk($rules_name, function ($val) use (&$rules, $all_rules) {
            array_key_exists($val, $all_rules) && ($rules[$val] = $all_rules[$val]);
        });

        return $rules;
    }
}