<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "curso".
 *
 * @property integer $id
 * @property string $sigla
 * @property string $nome
 *
 * @property Aluno[] $alunos
 */
class Curso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'curso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required', 'message' => 'O campo ID não pode ficar em branco'],
            [['id'], 'integer', 'message' => 'Informe um número inteiro'],
            [['sigla'], 'string', 'max' => 4, 'min' => 2, 'message' => 'A sigla precisa ter, no mínimo, duas letras.'],
            [['sigla'], 'required', 'message' => 'O campo Sigla não pode estar em branco'],
            [['nome'], 'required', 'message' => 'O campo Nome não pode estar em branco'],
            [['nome'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sigla' => 'Initialen',
            'nome' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Aluno::className(), ['id_curso' => 'id']);
    }
}
