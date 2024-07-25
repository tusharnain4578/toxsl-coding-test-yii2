<?php

namespace app\models\forms;


use app\models\Project;
use Yii;
use yii\base\Model;
use app\models\User;

/**
 * ProjectForm is the model behind the project form.
 *
 * @property-read User|null $user
 *
 */
class ProjectForm extends Model
{
    public $title;
    public $description;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],

            ['title', 'string', 'max' => 250],

            ['description', 'string', 'max' => 50000],
        ];
    }

    /**
     * Creates the project
     * @return bool whether the project is created successfully or not
     */
    public function create()
    {
        if (!$this->validate())
            return false;
        $project = new Project;
        $project->title = $this->title;
        $project->description = $this->description;
        $project->created_by = Yii::$app->user->identity->id;
        return $project->save();
    }

    public function update(int $projectId)
    {
        if (!$this->validate())
            return false;
        return Project::updateAll($this->getAttributes(), ['id' => $projectId]);
    }


}
