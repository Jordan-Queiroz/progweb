<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $login
 * @property string $senha
 * @property string $nome
 * @property string $email
 * @property string $pagina
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required', 'message'=>'Esse campo não pode ficar em branco'],
            [['id'], 'integer', 'message'=>'Você precisa informar um número inteiro'],
            [['login'], 'string', 'max' => 20, 'min' => 5, 'message' => 'Login muito pequeno'],
            [['senha'], 'string', 'max' => 128, 'min'=> 5, 'message' => 'Senha muito pequena'],
            [['nome', 'pagina'], 'string', 'max' => 200],
            [['email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Identifikation',
            'login' => 'Einloggen',
            'senha' => 'Kennwort',
            'nome' => 'Name',
            'email' => 'Email',
            'pagina' => 'Seite',
        ];
    }
}
