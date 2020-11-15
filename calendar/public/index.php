
<?php

require '../views/header.php';
require'../src/boostrap.php';
require '../src/Date/Month.php';
require '../src/Date/Events.php';
$pdo=get_pdo();
$events = new date\Events($pdo);
$month = new App\date\Month ( $_GET ['month'] ?? null,   $_GET['year'] ?? null);
$start =   $month->getStratingDay();
$start = $start->format('N') ==='1' ? $start : $month->getStratingDay()->modify('last monday');
$weeks= $month->getWeeks();
$end = (clone $start)->modify('+' . (6 + 7 * ( $weeks -1)) . 'days' );
$events = $events->getEventsBetween($start, $end);
var_dump($events);
render('../views/header.php', ['title'=>$event->getName()]);
?>

<div class="calendar">

<?php  if (isset($_GET['success'])): ?>
<div class=container">
    <div class="alert alert-succes">
    L'événement à bien été enregistré
    </div>
</div>
<?php endif; ?>

<div class="d-flex flex-row alig-items-center justify-content-between mx-sm-3" >
    <h1><?= $month->toString(); ?> </h1>
    <div>
        <a href="index.php?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" 
        class="btn btn-rpimary">&lt;</a>
        <a href="index.php?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" 
        class="btn btn-rpimary">&gt;</a>
    </div>

</div>





<table class= "calendar__table calendar__table--<?= $weeks;?>weeks">
 <?php for ($i = 0; $i < $weeks; $i++): ?>
    <tr>
        <?php 
        foreach($month->day as $k => $day):
            $date = (clone $start)->modify("+".($k + $i * 7 ) . "days")
            $eventsForDay = $events[$date->format('Y-m-d')] ?? [] ;
        ?>

        <td class="<?= $month->withMonth($date) ? '' : 'calendar__othermonth';?>">
            <?php if ($i=== 0): ?>
            <div class="calendar__weekday"><?= $day; ?></div>
        <?php endif; ?>
            <div class="calendar__day"><?= $date->format('d');?></div>
            <?php foreach($eventsForDay as $event): ?>
            <div class="calendar__event"></div>
                <?= (new DateTime($event['start']))->format('H:i') ?> -
                 <a href="/edit.php?id=<?= $event['id']; ?>"><?= h($event['name']); ?></a>
           
           <?php endforeach ?>
        </td>
        <?php endforeach; ?>
    </tr>

 <?php endfor; ?>

</table>


<a href="/add.php" class="calendar__button">+</a>
</div>



<?require'../views/footer.php';?>