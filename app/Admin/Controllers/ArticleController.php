<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Show;
use Encore\Admin\Table;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isInstanceOf;

class ArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Article';

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Article());

        $table->column('id', __('Id'));
        $table->column('title', __('Title'));
        $table->column('image', __('Image'))->image();
        $table->column('slug', __('Slug'));
        $table->column('content', __('Content'));
        $table->column('created_at', __('Created at'));
        $table->column('updated_at', __('Updated at'));

        return $table;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Article::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('image', __('Image'));
        $show->field('slug', __('Slug'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Article());

        $form->text('title', __('Title'));
        $form->image('image', __('Image'));
        $form->text('slug', __('Slug'));
        $form->editor('content', __('Content'));

        if ($form->isCreating() || \Route::currentRouteName() == 'admin.articles.update') {
            $form->saving(function (Form $form) {

	            if ($form->image instanceof \Illuminate\Http\UploadedFile) {
	                $path = $form->image->getPathName();
	                $upload_path = \Storage::disk('oss')->put('', $form->image);
	                $form->image = env('ALIOSS_HOST').'/'.$upload_path;
	                \Storage::disk('local')->delete($path);
	            }

            });
        }


        return $form;
    }
}
