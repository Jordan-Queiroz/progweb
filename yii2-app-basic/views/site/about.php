<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>
    <!-- Aqui ficam apenas os conteúdos da página (O layout fica em outro arquivo). -->
    <?php 
    	  echo ($teste);
    	  echo ($date);
    	  echo ($description);
   	?>

    <code><?= __FILE__ ?></code>
</div>
