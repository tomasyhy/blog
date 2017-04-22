<?php
use yii\helpers\{Url, StringHelper, Html};
use yii\grid\GridView;
use yii\widgets\Pjax;



/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-list-ul font-dark"></i>
                    <span class="caption-subject bold uppercase"><?= Yii::t('app', 'Posts list'); ?></span>
                </div>

                <div class="actions">
                    <a href="<?= Url::to(['create']); ?>" class="btn blue btn-sm show-modal" data-action="backup"><i
                                class="fa fa-plus"></i><?= Yii::t('app', 'Create') ?></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="todo-project-list">
                    <div class="table-responsive">
                        <?php
                        Pjax::begin(['enablePushState' => false, 'id' => 'post-grid-pjax',
                        ]); ?>

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'id' => 'post-grid',
                            'tableOptions' => [
                                'class' => 'table table-hover',
                            ],
                            'layout' => "\n{items}\n{summary}\n{pager}",
                            'columns' => [
                                [
                                    'attribute' => 'title',
                                    'contentOptions' => [
                                        'class' => 'col-md-2'
                                    ]
                                ],
                                [
                                    'attribute' => 'content',
                                    'contentOptions' => [
                                        'class' => 'col-md-6'
                                    ],
                                    'content' => function ($post) {
                                        return StringHelper::truncateWords(strip_tags($post->content), 5);
                                    },

                                ],
                                [
                                    'attribute' => 'created_at',
                                    'contentOptions' => [
                                        'class' => 'col-md-2'
                                    ],
                                    'content' => function ($post) {
                                        return Yii::$app->formatter->asDate($post->created_at);
                                    },
                                ],
                                ['class' => 'yii\grid\ActionColumn',
                                    'visible' => true, 'template' => '{change-status}{update}{delete}',
                                    'buttons' => [
                                        'change-status' => function ($url, $post) {
                                            return Html::a('<span class="' . $post->hyperlinkElements->getStatusIcon($post) . '"></span>', $url, [
                                                'title' => $post->hyperlinkElements->getStatusTitle($post),
                                                'class' => 'btn btn-icon-only hidden-xs hidden-sm ajax-action ' . $post->hyperlinkElements->getStatusColor($post),
                                                'data-element' => 'post-grid',
                                                'data-confirmation' => $post->hyperlinkElements->getChangeStatusConfirmation($post)
                                            ]);
                                        },
                                        'update' => function ($url) {
                                            return Html::a('<span class="fa fa-edit"></span>', $url, [
                                                'title' => Yii::t('app', 'Details'),
                                                'class' => 'btn btn-icon-only purple',
                                                'data-pjax' => '0',
                                            ]);
                                        },
                                        'delete' => function ($url, $post) {
                                            return Html::a('<span class="fa fa-trash-o"></span>', $url, [
                                                'title' => Yii::t('yii', 'Delete'),
                                                'class' => 'btn btn-icon-only red hidden-xs hidden-sm ajax-action',
                                                'data-element' => 'post-grid',
                                                'data-confirmation' => $post->hyperlinkElements->getDeleteConfirmation($post)
                                            ]);
                                        },
                                    ],
                                    'contentOptions' => [
                                        'class' => 'text-right actions col-md-2'
                                    ]
                                ],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>