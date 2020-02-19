<?php

namespace QuarkCMS\QuarkAdmin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use QuarkCMS\QuarkAdmin\Helper;
use QuarkCMS\QuarkAdmin\Models\Admin;
use Spatie\Permission\Models\Role;
use Quark;
use Validator;
use DB;

class AdminController extends QuarkController
{
    protected $title = '管理员';

    /**
     * 列表页面
     *
     * @param  Request  $request
     * @return Response
     */
    protected function table()
    {
        $grid = Quark::grid(new Admin);
        $grid->column('username','用户名');
        $grid->column('nickname','昵称');
        $grid->column('email','邮箱');
        $grid->model()->where('status',1)->select('username','nickname','email')->paginate(10);

        $grid->filter(function($filter){

            // 在这里添加字段过滤器
            $filter->like('username', 'tangtanglove');
        });

        return $grid->render();
    }

    /**
     * 表单页面
     * 
     * @param  Request  $request
     * @return Response
     */
    protected function form()
    {
        $form = Quark::form(new Admin)->title('编辑'.$this->title);

        $form->text('username','用户名');
        $form->text('nickname','昵称');
        $form->setAction('api/admin/test/save');

        return $form;
    }
}
