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
    public function game($id,$status=null, \App\Client\AzureClient $azureClient){
        $game = $this->getDoctrine()
            ->getRepository(Game::class)
            ->find($id);
        $show_game = 0;
        if($status==1 && $status !=null){
            $show_game = 1;
        }
         
        return $this->render('front/game.html.twig',["game"=>$game,"show_game"=>$show_game]);
    }
    
     /**
         * @Route("/game/{id}/{action}", name="game_action")
     */
    public function gameAction($id, $action, \App\Client\AzureClient $azureClient,AuthorizationCheckerInterface $authChecker)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $status='';
        if (true === $authChecker->isGranted('ROLE_USER')) {
            $status =$azureClient->executeAction($action);
        }

        //return $this->redirectToRoute('game',['id'=>$id]);
        $response = $this->forward('App\Controller\DefaultController::game', [
        'id'  => $id,
        'status' => $status,
    ]);
        return $response;
    }
    
    
}
