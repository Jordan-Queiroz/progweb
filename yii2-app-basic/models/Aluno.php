<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aluno".
 *
 * @property integer $id
 * @property integer $matricula
 * @property string $nome
 * @property string $sexo
 * @property integer $id_curso
 * @property integer $ano_ingresso
 *
 * @property Curso $idCurso
 */
class Aluno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aluno';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matricula', 'id_curso', 'ano_ingresso'], 'integer', 'message' => 'Insira um número inteiro'],
            [['matricula', 'id_curso', 'ano_ingresso'], 'required', 'message' => 'Esse campo não pode estar em branco.'],
            [['nome'], 'string', 'max' => 200],
            [['sexo'], 'string', 'max' => 10],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matricula' => 'Anzahl',
            'nome' => 'Name',
            'sexo' => 'Geschlecht',
            'id_curso' => 'Graduierung',
            'ano_ingresso' => 'Eindringen Jahr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurso()
    {
        return $this->hasOne(Curso::className(), ['id' => 'id_curso']);
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->nome = strtolower($this->nome);
        $this->nome = ucwords($this->nome);

        if ($this->sexo == 'M') {
            $this->sexo = "Masculino";
        } else {
            $this->sexo = "Feminino";
        }
        $this->id_curso = $this->curso->nome;
    }

    public function beforeSave($insert)
    {
        $this->nome = strtoupper($this->nome);
        return parent::beforeSave($insert);
    }

}
