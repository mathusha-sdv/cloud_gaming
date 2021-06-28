<?php
namespace App\Controller;
use App\Entity\Game;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 *
 * @author mtmat
 */
class DefaultController  extends AbstractController{
   /**
     * @Route("/", name="index")
     */
    public function index(){
        $games = $this->getDoctrine()
            ->getRepository(Game::class)
            ->findAll();
        return $this->render('front/accueil.html.twig',["games"=>$games]);
    }
    
    /**
         * @Route("/game/{id}", name="game")
     */
    public function game($id, \App\Client\AzureClient $azureClient){
        
        $game = $this->getDoctrine()
            ->getRepository(Game::class)
            ->find($id);
        return $this->render('front/game.html.twig',["game"=>$game]);
    }
    
     /**
         * @Route("/game/{id}/{action}", name="game_action")
     */
    public function gameAction($id, $action, \App\Client\AzureClient $azureClient)
    {
        $azureClient->executeAction($action);
        return new JsonResponse('success', 200);
    }
    
    
}
