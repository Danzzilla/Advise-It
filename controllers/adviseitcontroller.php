<?php
/**
 * Controller class for fat free
 */
class AdviseItController
{
    private $_f3;

    /**
     * Constructs a controller for $f3 passed in
     * @param $f3 - fat free
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /**
     * Renders in the home page
     * @return void
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * TODO ******************************************************
     * TODO Make it more of a hash than an int id for the plan
     */
    function CreatePlan()
    {
        //Connect to Database
        require('/home/dsvirida/config.php');

        //Create a new ID
        $id = false;
        $found = false;
        while($found == false){
            $id = substr(md5(uniqid(rand())), -6);
            echo "\n1i. $id";

            $sql = "SELECT PlanID FROM plans WHERE PlanID = '$id'";

            $statement = $dbh->prepare($sql);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            echo "\n1p. ".$result['PlanID'];

            if($id != $result['PlanID']){
                $found = true;
            }
        }

        //create a new plan
        echo "\n2i. $id";
        $sql = "INSERT INTO plans(PlanID) VALUES('$id')";

        $statement = $dbh->prepare($sql);
        $statement->execute();

        header('location: plan'.$id);
    }

    /**
     * TODO *******************************************************
     */
    function plan($planid)
    {
        //retrieve data and put into f3 to populate plan page
        $this->_f3->set('quarters', DataLayer::getQuarters());
        Functions::retrieveToF3($planid, $this->_f3);

        $view = new Template();
        echo $view->render('views/plan.html');
    }
}