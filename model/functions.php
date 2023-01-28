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

    static function sendToDatabase($data)
    {
        //Connect to Database
        require('/home/dsvirida/config.php');

        //fetch data from database to fill in the plan with what was saved
        $sql = "SELECT * FROM plans WHERE PlanID = ".$data->ID;

        $statement = $dbh->prepare($sql);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        //catch database results and merge with new items for update
        $Fall1 = array_merge(explode(", ", $result['Fall1']), $data->Fall1);
        $Fall2 = array_merge(explode(", ", $result['Fall2']), $data->Fall2);
        $Winter1 = array_merge(explode(", ", $result['Winter1']), $data->Winter1);
        $Winter2 = array_merge(explode(", ", $result['Winter2']), $data->Winter2);
        $Spring1 = array_merge(explode(", ", $result['Spring1']), $data->Spring1);
        $Spring2 = array_merge(explode(", ", $result['Spring2']), $data->Spring2);
        $Summer1 = array_merge(explode(", ", $result['Summer1']), $data->Summer1);
        $Summer2 = array_merge(explode(", ", $result['Summer2']), $data->Summer2);

        //fetch data from database to fill in the plan with what was saved
        $sql = "UPDATE plans
                SET Fall1 = :fall1, Fall2 = :fall2, Winter1 = :winter1, Winter2 = :winter2,
                    Spring1 = :spring1, Spring2 = :spring2, Summer1 = :summer1, Summer2 = :summer2
                WHERE PlanID = ".$data->ID;

        $statement = $dbh->prepare($sql);

        $statement->bindParam(':fall1', $Fall1, PDO::PARAM_STR);
        $statement->bindParam(':fall2', $Fall2, PDO::PARAM_STR);
        $statement->bindParam(':winter1', $Winter1, PDO::PARAM_STR);
        $statement->bindParam(':winter2', $Winter2, PDO::PARAM_STR);
        $statement->bindParam(':spring1', $Spring1, PDO::PARAM_STR);
        $statement->bindParam(':spring2', $Spring2, PDO::PARAM_STR);
        $statement->bindParam(':summer1', $Summer1, PDO::PARAM_STR);
        $statement->bindParam(':summer2', $Summer2, PDO::PARAM_STR);

        $statement->execute();
    }

    static function removeDeleted($data)
    {
        //Connect to Database
        require('/home/dsvirida/config.php');

        //fetch data from database to fill in the plan with what was saved
        $sql = "SELECT * FROM plans WHERE PlanID = ".$data->ID;

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
    }
}
