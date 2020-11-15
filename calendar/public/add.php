<?php
require '..\src\boostrap.php';



$data = [];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] ==='POST') {
    $data = $_POST;
    $validator = new date\EventValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)) {
        $event =$events->hydrate(new \date\event(), $data);
        $events = new\date\Events(get_pdo());
        $events->create ($event);
        header ('location /index?success=1');
        exit();

    }
}

render('header', ['title'=>'ajouter un événement']);
?>


<div class="container">

<?php if (!empty ($errors)): ?>
    <div class="alert alert-danger">
        Merci de corriger vos erreurs 
    </div>
<?php endif; ?>


    <h1>Ajouter un événement</h1>
        <?php render('calendar/form', ['data' => $data, 'errors' =>$errors]); ?>
        <form action="" method="post" class="form">
                <div class="form-group">
                <button class="btn btn-primary">Ajouter l'événement</button>
            </div>
    
        
</div>


<?php render('footer');?>
