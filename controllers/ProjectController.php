<?php

namespace app\controllers;

use app\enums\UserRole;
use app\models\forms\ProjectForm;
use app\models\Project;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class ProjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'add'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->hasRole(UserRole::ADMIN, UserRole::MANAGER);
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays projects page.
     *
     * @return string
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Project::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays add project page.
     *
     * @return Response|string
     */
    public function actionAdd()
    {
        $model = new ProjectForm;

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
            Yii::$app->session->setFlash('success', 'Project added successfully.');
            return $this->refresh();
        }

        return $this->render('project_form', [
            'mode' => 'add',
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $project = Project::findOne($id);

        if (!$project) {
            Yii::$app->session->setFlash('error', 'The requested project does not exist.');
            return $this->redirect(['index']); // Redirect to the index page or another appropriate page
        }

        $model = new ProjectForm;


        if ($model->load(Yii::$app->request->post()) && $model->update($project->id)) {
            Yii::$app->session->setFlash('success', 'Project updated successfully.');
            return $this->refresh();
        }

        $model->setAttributes($project->getAttributes());

        return $this->render('project_form', [
            'mode' => 'update',
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $project = Project::findOne($id);

        if (!$project) {
            Yii::$app->session->setFlash('error', 'The requested project does not exist.');
            return $this->redirect(['index']); // Redirect to the index page or another appropriate page
        }


        if ($project->delete()) {
            Yii::$app->session->setFlash('success', 'Project deleted successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to delete the project.');
        }

        return $this->redirect(['index']);
    }

}
