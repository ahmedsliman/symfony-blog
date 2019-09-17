<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;

use App\Form\PostType;

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

        //dump($posts);

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

        //$post->setTitle('This is going to be title.');

        $form = $this->createForm(PostType::class, $post);

        // get the request
        $form->handleRequest($request);
        //$form->getErrors();
        if( $form->isSubmitted() /*&& $form->isValid()*/ ) {
            // entity manager
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirect($this->generateUrl('post.index'));
        }

        // response
        //return new Response('Post was created!');
        //return $this->redirect($this->generateUrl('post.index'));
        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function remove(Post $post)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Post was just removed!');

        // redirection
        return $this->redirect($this->generateUrl('post.index'));
    }
}