<?php
 

namespace date;



class Events {

    private $pdo;
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo; 
    }
    /**
     * Récupère les événements commencant entre deux dates 
     *
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     *
     * 
     * */
    public function getEventsBetween (\DateTime $start, \DateTime $end): array {
       
        $sql =  "SELECT * FROM evenement WHERE start  BETWEEN '{$start->format('Y-m-d 00:00:00')}' and 
        '{$end->format('Y-m-d 23:59:59')}'";
        var_dump($sql);
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll();
        return $results;
    }
    /**
     * Récupérer les événements commencant entre deux dates indexés jour
     * @param \DateTime $start
     * @param \DateTime $end
     * @param return array
     * 
     */

    public function getEventsBetweenByDay(\DateTime $start, \DateTime $end): array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach($events as $event){
            $date = explode('', $event['start'])[0]; 
            if(!isset($days[$date])) {
                $days[$date] = [$event];

            } else{
                $days[$date] = $event;
            }
        }
        return $days;
    }
    /**
     * Récupère un événement 
     *
     * @param integer int $id
     * @return void Event
     * @throws \Exception
     */
    public function find(int $id): event{
        require 'event.php';
        $statement =  $this->pdo->query("SELECT *  FROM events WHERE id = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, event::class);
        $result = $statement->fetch();
            if ($result ===false) {
                throw new \Exception ('Aucun résultat n\'a été trouvé');
            };
            return $result;

    public function hydrate (Event $event, array $data){
        $event->setName($data['name']);
        $event->setDescription($data['name']);
        $event->setStart(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . '' . $data['start'])
        ->format('Y-m-d H:i:s'));
        $event->setEnd(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . '' . $data['end'])
        ->format('Y-m-d H:i:s'));
        return $event; 
    }

    

     
    /**
     * Crée un événement au niveau de la base de données
     *
     * @param Event $event
     * @return void
     */
    public function create (Event $event){
       $statement =  $this->pdo->prepare('INSERT INTO events (name, description, start, end) 
       VALUES(?, ?, ?, ?,)');
       $statement->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStar ()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
       ]);
        
    }
    /**
     * met à jour un événement au niveau de la base de données
     *
     * @param Event $event
     * @return bool
     */
    public function update (Event $event){
        $statement =  $this->pdo->prepare('UPDATE  events  SET name = ?, description= ?, start = ?, end= ?,
         WHERE id = ?');
        $statement->execute([
             $event->getName(),
             $event->getDescription(),
             $event->getStar ()->format('Y-m-d H:i:s'),
             $event->getEnd()->format('Y-m-d H:i:s'),
             $event->getId()
        ]);
         
     }

?>