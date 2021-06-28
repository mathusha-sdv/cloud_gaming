<?php
namespace App\Controller;
use App\Entity\Game;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
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
    public function game($id,$status=null, \App\Client\AzureClient $azureClient,AuthorizationCheckerInterface $authChecker){
        
        $game = $this->getDoctrine()
            ->getRepository(Game::class)
            ->find($id);
        if (true === $authChecker->isGranted('ROLE_USER')){
            $user = $this->getUser();
            if($user->getHasAccess() == 1){
               $this->addFlash('success', 'Accès au jeu');
           }
           else{
               $this->addFlash('error', 'Vous n\'avez pas accès à ce jeu ! ');
           }
        }
        else{
            $this->addFlash('error', 'Connectez vous pour avoir accès aux jeux');
        }

         
        return $this->render('front/game.html.twig',["game"=>$game]);
    }
    
     /**
         * @Route("/game/{id}/{action}", name="game_action")
     */
    public function gameAction($id, $action, \App\Client\AzureClient $azureClient,AuthorizationCheckerInterface $authChecker)
    {
        dump($action);
        $status=0;
        if($action == 'stop'){
            
            $azureClient->stopServer();
            $response = $this->forward('App\Controller\DefaultController::game', [
        'id'  => $id                      
    ]);
            return $response;
        }
        if (true === $authChecker->isGranted('ROLE_USER')) {
            $user = $this->getUser();
            if($user->getHasAccess() == 1){
                        $response = $this->forward('App\Controller\DefaultController::gamePlay', [
        'id'  => $id                      
    ]);
        return $response;
            }
        }
         return $this->redirectToRoute('game',['id'=>$id]);
    }
    
         /**
         * @Route("/game/{id}/play", name="game_play")
     */
     public function gamePlay($id, \App\Client\AzureClient $azureClient,AuthorizationCheckerInterface $authChecker)
    {
                 $game = $this->getDoctrine()
            ->getRepository(Game::class)
            ->find($id);
                $azureClient->startServer();
               return $this->render('front/gamePlay.html.twig',["id"=>$id,"game"=>$game]);
            
    }

    
    
    
}
