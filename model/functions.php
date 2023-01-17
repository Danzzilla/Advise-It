<?php
class Functions
{
    static function retrieveToF3($planid, $f3)
    {
        //Connect to Database
        require('/home/dsvirida/config.php');

        //fetch data from database to fill in the plan with what was saved
        $sql = "SELECT * FROM plans WHERE PlanID = ".$planid;

        $statement = $dbh->prepare($sql);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        //catch database results
        $id = $result['PlanID'];
        $fall1 = $result['Fall1'];
        $fall2 = $result['Fall2'];
        $winter1 = $result['Winter1'];
        $winter2 = $result['Winter2'];
        $spring1 = $result['Spring1'];
        $spring2 = $result['Spring2'];
        $summer1 = $result['Summer1'];
        $summer2 = $result['Summer2'];

        //send database results to f3
        $f3->set('plan["id"]', $id);
        $f3->set('plan["fall1"]', $fall1);
        $f3->set('plan["fall2"]', $fall2);
        $f3->set('plan["winter1"]', $winter1);
        $f3->set('plan["winter2"]', $winter2);
        $f3->set('plan["spring1"]', $spring1);
        $f3->set('plan["spring2"]', $spring2);
        $f3->set('plan["summer1"]', $summer1);
        $f3->set('plan["summer2"]', $summer2);
    }
}
