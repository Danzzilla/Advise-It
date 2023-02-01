<?php
//!!important--
// Dont remove single quotes around PlanID value in queries or else it
// breaks the query for some reason

class Functions
{
    static function retrieveToF3($planid, $f3)
    {
        //Connect to Database
        require('/home/dsvirida/config.php');

        //fetch data from database to fill in the plan with what was saved
        $sql = "SELECT * FROM plans WHERE PlanID = '$planid'";

        $statement = $dbh->prepare($sql);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        //catch database results
        $id = $result['PlanID'];
        $fall1 = explode(", ", $result['Fall1']);
        $fall2 = explode(", ", $result['Fall2']);
        $winter1 = explode(", ", $result['Winter1']);
        $winter2 = explode(", ", $result['Winter2']);
        $spring1 = explode(", ", $result['Spring1']);
        $spring2 = explode(", ", $result['Spring2']);
        $summer1 = explode(", ", $result['Summer1']);
        $summer2 = explode(", ", $result['Summer2']);

        //send database results to f3
        $f3->set('plan["ID"]', $id);
        $f3->set('plan["Fall1"]', $fall1);
        $f3->set('plan["Fall2"]', $fall2);
        $f3->set('plan["Winter1"]', $winter1);
        $f3->set('plan["Winter2"]', $winter2);
        $f3->set('plan["Spring1"]', $spring1);
        $f3->set('plan["Spring2"]', $spring2);
        $f3->set('plan["Summer1"]', $summer1);
        $f3->set('plan["Summer2"]', $summer2);
    }

    static function sendToDatabase($data)
    {
        //Connect to Database
        require('/home/dsvirida/config.php');

        //fetch data from database to fill in the plan with what was saved
        $sql = "SELECT * FROM plans WHERE PlanID = '$data->ID'";

        $statement = $dbh->prepare($sql);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        //catch database results and merge with new items for update
        $Fall1 = implode(", ", array_merge(explode(", ", $result['Fall1']), $data->Fall1));
        $Fall2 = implode(", ", array_merge(explode(", ", $result['Fall2']), $data->Fall2));
        $Winter1 = implode(", ", array_merge(explode(", ", $result['Winter1']), $data->Winter1));
        $Winter2 = implode(", ", array_merge(explode(", ", $result['Winter2']), $data->Winter2));
        $Spring1 = implode(", ", array_merge(explode(", ", $result['Spring1']), $data->Spring1));
        $Spring2 = implode(", ", array_merge(explode(", ", $result['Spring2']), $data->Spring2));
        $Summer1 = implode(", ", array_merge(explode(", ", $result['Summer1']), $data->Summer1));
        $Summer2 = implode(", ", array_merge(explode(", ", $result['Summer2']), $data->Summer2));

        $sql = "UPDATE plans
                SET Modified = null, Fall1 = :fall1, Fall2 = :fall2, Winter1 = :winter1, Winter2 = :winter2,
                    Spring1 = :spring1, Spring2 = :spring2, Summer1 = :summer1, Summer2 = :summer2
                WHERE PlanID = '$data->ID'";

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
        $sql = "SELECT * FROM plans WHERE PlanID = '$data->ID'";

        $statement = $dbh->prepare($sql);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $deleted = $data->deleted;
        foreach($deleted as $item){
            $itemfo = preg_split("/\\s/i", $item, 2);

            echo implode(", ", $itemfo);
            $updated = implode(", ", \array_diff(explode(", ", $result[$itemfo[0]]), [$itemfo[1]]));

            $sql = "UPDATE plans
                SET $itemfo[0] = :updated
                WHERE PlanID = '$data->ID'";

            $statement = $dbh->prepare($sql);

            $statement->bindParam(':updated', $updated, PDO::PARAM_STR);

            $statement->execute();
        }
    }
}
