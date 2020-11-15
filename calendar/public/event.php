
<?php

require '../src/boostrap.php';
require '../src/Date/Events.php';
require '../views/header.php';
$pdo = get_pdo();
$events = new date\Events($pdo);
if (! isset($_GEET['id'])){
    header('location: /404.php');

}
try{
    $event = $events->find($_GEET['id']);

}catch(\Exception $e ){
    e404();
}
render('../views/header.php', ['title'=>$event->getName()]);

?>

<h1>
<?= h($event->getName());?>
</h1>

<ul>
    <li>Date: <?= $event->getStart()->format('d/m/Y');?></li>
    <li>heure de démarrage: <?= $event->getStart()->format('H/i');?></li>
    <li>heure de fin: <?= $event->getEnd()->format('H/i');?></li>
    <li>
        Description:<br>
     <?= h($event->getDescription());?>
    </li>
</ul>




<?require'../views/footer.php';?>
