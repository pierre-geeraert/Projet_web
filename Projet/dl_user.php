

<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
$nbr = $_POST['nbr_event'];




for($var=1; $var<=$nbr ; $var++)
{
    if (isset($_POST[$var])) 
    {
        //$bdd->query('call subscribe_event('.$user_id.', '.$_POST[$var].')');
        $event_id=$_POST[$var];

    }
}

try {

    $requete = $bdd->prepare("call registered_list(:event_id)");
    $requete->bindValue(':event_id', $event_id, PDO::PARAM_STR);
    $requete->execute();

    } catch (PDOException $e)
{
    echo $e;
}

$donnees = $requete->fetchAll();




$fp = fopen('file.csv', 'w');


$tt = count($donnees);
for ($i=0; $i < $tt; $i++) {
    $name_out=$donnees[$i]['name'];
    $surname_out=$donnees[$i]['surname'];
    echo "$name_out,";
    echo "$surname_out\n";
    //fputcsv($fp,$name_out);
    //$name_out
    fputcsv($out, array($donnees[$i]['name'],$donnees[$i]['surname']));
}




fclose($fp);


header('Content-disposition: attachment; filename=file.csv');
header('Content-type: application/zip');
readfile('file.csv');
unlink($fp);

?>
