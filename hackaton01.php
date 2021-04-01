<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h2>Question</h2>
<br>
<?php

class Main

{
    const ANNEE = 6;

    public function getServers()
    {
        $row = 1;
        if (($handle = fopen("C:\Users\LANNEAU JJ\PhpstormProjects\Hackathome\servers\servers_catalog.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $catalog[] = $data;

            }
            fclose($handle);
            return $catalog;

        }

    }

    public function getServices($inputCsv)
    {

        $row = 1;
        if (($handle = fopen($inputCsv, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $catalog[] = $data;

            }
            fclose($handle);
            return $catalog;
        }

    }

    public function getServicesSums($inputCsv)
    {
        $services = $this->getServices($inputCsv);
        $serviceMax = [];

        foreach ($services as $service) {
            for ($i = 1; $i < count($service); $i++) {
                $serviceMax[$i] += $service[$i];
            }
        }
        return $serviceMax;
    }

    public function getSolution($inputCsv)
    {
        $servers = $this->getServers();
        $serviceMax = $this->getServicesSums($inputCsv);

        $serverSolution = "";
        $serverSolutionCo2 = 1000000;


        foreach ($servers as $server) {

            $serverCapa = $server[3];
            $serverRam = $server[4];
            $serverCore = $server[5];

            settype($serverCapa, 'integer');
            settype($serverRam, 'integer');
            settype($serverCore, 'integer');

            if ($serverCapa >= $serviceMax[1] && $serverRam >= $serviceMax[2] && $serverCore >= $serviceMax[3]) {
                $co2 = $server[1] + $server[2] * self::ANNEE;
                var_dump($co2);
                if ($serverSolutionCo2 > $co2) {
                    $serverSolutionCo2 = $co2;
                    $serverSolution = $server[0];
                }
            }

        }
        return $serverSolution;
    }
}

$main = new Main();
$inputCsv = "C:\Users\LANNEAU JJ\PhpstormProjects\Hackathome\inputs\ctstfr0280_input_1.csv";

$serverSolution = $main->getSolution($inputCsv);
var_dump($serverSolution);


?>

</body>
</html>