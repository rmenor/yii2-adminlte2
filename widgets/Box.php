<?php
namespace rmenor\adminlte2\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use rmenor\adminlte2\components\AdminLTE2;

/**
 * Box
 *
 * @author Ramón Menor <ramonmenor@gmail.com>
 *
 * Example of use:
<?= \rmenor\adminlte2\widgets\Box::widget([
    'title' => 'Title',
    'body' => '<p>Hello world</p>',
    'isCollapsed' => true,
    'buttons' => [
        Html::a('Botón 1', '#', ['class' => 'btn btn-primary btn-xs']),
        Html::a('Botón 2', '#', ['class' => 'btn btn-primary btn-xs']),
        Html::a('Botón 3', '#', ['class' => 'btn btn-primary btn-xs']),
    ],
    'options' => [
        'boxClass' => \rmenor\adminlte2\components\AdminLTE2::TYPE_DEFAULT,
    ],
    'footer' => 'Text footer'
]); ?>
 *
 *
 *
 */
class Box extends Widget
{
    private $boxClass = 'box box-';
    private $boxHeaderClass = 'box-header';

    /**
     * Is collapsed, true or false.
     * By default is false.
     * @var
     */
    public $isCollapsed = false;

    /**
     * Header title
     * @var
     */
    public $title;

    /**
     * Body of the box
     * @var
     */
    public $body;

    /**
     * Header buttons
     * @var
     */
    public $buttons;

    /**
     * Footer on box
     * @var
     */
    public $footer;

    /**
     * Other Options
     * @var array
     */
    public $options = [];

    /**
     * Create the header
     * @return string
     */
    private function header()
    {
        $header = Html::tag('h3', $this->title, [
            'class' => 'box-title',
        ]);

        $buttons = '';
        if (count($this->buttons)>0) {
            $buttons .= $this->addButtons();
        }

        $header .= Html::tag('div', $this->boxButtons($buttons), [
            'class' => 'pull-right box-tools'
        ]);

        return Html::tag('div', $header, [
            'class' => $this->boxHeaderClass,
        ]);
    }

    /**
     * Create the footer
     * @return string
     */
    private function footer()
    {
        return Html::tag('div', $this->footer, [
            'class' => 'box-footer clearfix',
        ]);
    }

    /**
     * Add generic buttons to the box
     * @param $buttons
     * @return string
     */
    public function boxButtons($buttons)
    {
        if ($this->isCollapsed) {
            $icon = '<i class="fa fa-minus"></i>';
        }else {
            $icon = '<i class="fa fa-plus"></i>';
        }

        $buttons .= Html::tag('button', $icon, [
            'type' => 'button',
            'class' => 'btn btn-box-tool',
            'data-widget' => 'collapse'
        ]);
        $buttons .= Html::tag('button', '<i class="fa fa-times"></i>', [
            'type' => 'button',
            'class' => 'btn btn-box-tool',
            'data-widget' => 'remove'
        ]);

        return $buttons;
    }

    /**
     * Add the buttons to the header
     * @return string
     */
    private function addButtons()
    {
        $buttons = '';

        if (count($this->buttons)>0) {
            foreach ($this->buttons as $button) {
                $buttons .= $button;
            }
        }

        $content = Html::tag('div', $buttons, [
            'class' => 'btn-group'
        ]);

        return $content;
    }

    /**
     * Start and display the widget
     */
    public function init()
    {
        parent::init();
        $box = '';

        if (!empty($this->title)) {
            $box .= $this->header();
        }

        if (isset($this->options['boxClass'])) {
            $this->boxClass .= $this->options['boxClass'];
        } else {
            $this->boxClass .= AdminLTE2::TYPE_DEFAULT;
        }

        if ($this->isCollapsed) {
            $this->boxClass .= ' collapsed-box';
        }

        if (!empty($this->body)) {
            $box .= Html::tag('div', $this->body, [
                'class' => 'box-body'
            ]);
        }

        if (!empty($this->footer)) {
            $box .= $this->footer();
        }

        echo Html::tag('div', $box, [
            'class'=>$this->boxClass
        ]);
    }
}
