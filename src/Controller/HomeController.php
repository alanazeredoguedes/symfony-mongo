<?php

namespace App\Controller;

use MongoDB\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): JsonResponse
    {


        $client = new Client('mongodb://root:root@172.17.0.1:27017');
        //dd($client->listDatabaseNames());


        $dataBase = $client->selectDatabase('juca');


        //$dataBase->createCollection('teste');

        $teste =  $dataBase->selectCollection('teste');










        dd('last');
        $local = $client->selectDatabase('local');


        //$local->createCollection('teste');
        $teste = $local->selectCollection('teste');



        $data = json_encode([
           'nome' => 'Lucas',
           'sobrenome' => 'Marcos'
        ]);


        //dd( $teste->insertOne( json_decode($data) ) );

        $count = $teste->countDocuments();
        $data = $teste->find([]);
        $datas = $data->toArray();


        $response = [];
        foreach ($datas as $data ){
            $response[] = json_encode($data);
        }


        dd($response);
        dd($count, $data);


        //dd($response->toArray());

        foreach ($response->toArray() as $data){
            dd($data);
        }




       /* dd($client->listDatabaseNames([

            ''

        ]));*/

        $local = $client->selectDatabase('local');

        dd($local->listCollectionNames());


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/HomeController.php',
        ]);
    }
}
