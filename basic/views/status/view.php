<?php
use yii\helpers\Html;
?>

<h1>Your Status Update</strong></h1>
<p>
    <label>Text</label>:
</p>
<?= Html::encode($status->text) ?>
<br />
<br />
<p>
    <label>Permissions</label>:
</p>

<?php
echo $status->getPermissionsLabel($status->permissions);
?>
