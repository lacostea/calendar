
<?php

require '../src/bootstrap.php';
require '../src/Date/Events.php';
/*require '../views/header.php';*/
$pdo = get_pdo();
$events = new date\Events($pdo);
$errors = [];
if (! isset($_GEET['id'])){
    e404();

}
try{
    $event = $events->find($_GEET['id']);

}catch(\Exception $e ){
    e404();
}

$data = [
            'name' => $event->getName(),
            'date' => $event->getStart()->format('Y-m-d'),
            'start' => $event->getStart()->format('H::i'),
            'end' => $event->getEnd()->format('H::i'),
            'Description' => $event->getDescription(),
];


if ($_SERVER['REQUEST_METHOD'] ==='POST') {
    $data = $_POST;
    $validator = new date\EventValidator();
    $errors = $validator->validates($data);
    if (empty($errors)) {
       $events->hydrate($event, $data); 
       $events->uptdate($event);
        header ('location /index?success=1');
        exit();

    }
}

render('../views/header.php', ['title'=>$event->getName()]);

?>

<h1> Editer l'événement <small>
<?= h($event->getName());?>
</small></h1>
<form action="" method="post" class="form">
        <?php render('views/form.php', ['data'=>[$data. 'errors' => $errors]); ?>
    
            <div class="form-group">
                <button class="btn btn-primary">modifier l'événement</button>
            </div>
        
    </form>




<?php render( 'footer');?>