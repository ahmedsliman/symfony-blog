<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();

        dump($posts);

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Reuest $request
     * @return Response
     */
    public function create(Request $request)
    {
        $post = new Post;
        $post->setTitle('This is going to be title.');

        // entity manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        // response
        return new Response('Post was created!');
    }
}