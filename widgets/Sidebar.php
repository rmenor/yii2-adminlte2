<?php
namespace rmenor\adminlte2\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Main Menu Left
 *
 * @author Ramón Menor <ramonmenor@gmail.com>
 *
 * Example of use:
 *
$items = [
    [
        'label'=>'<li class="header">Menú principal</li>',
    ],
    [
        'label'=>'<i class="fa fa-dashboard"></i> <span>Dashboard</span>',
        'url'=>Yii::$app->getUrlManager()->createUrl("dashboard"),
        'options' => [],
    ],
];
 *
<?= \rmenor\adminlte2\widgets\Sidebar::widget([
    'items' => Yii::$app->menu->items()
]) ?>
 *
 */
class Sidebar extends Widget
{
    public $items;

    /**
     * @return string
     */
    private function userPanel()
    {
        $content = '<div class="pull-left image">
                <img src="http://via.placeholder.com/160x160" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>'.Yii::$app->user->identity->username.'</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>';


        return Html::tag('div', $content, [
            'class' => 'user-panel'
        ]);
    }

    /**
     * Add items of menu
     * @return string
     */
    private function addItems()
    {
        $items = \yii\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => $this->items,
                'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
                'encodeLabels' => false, //allows you to use html in labels
                'activateParents' => true,
            ]
        );

        return $items;
    }

    /**
     * Start and display the widget
     */
    public function init()
    {
        parent::init();
        $sidebar = '';

        $sidebar .= Html::tag('section', $this->userPanel().$this->addItems(), [
            'class' => 'sidebar'
        ]);

        echo Html::tag('aside', $sidebar, [
            'class' => 'main-sidebar'
        ]);
    }
}