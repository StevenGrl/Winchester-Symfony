<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Theme;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/journalisme/article")
 */
class ArticleController extends AbstractController
{
        /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{page}", defaults={"page": 1}, name="article_index", methods={"GET"})
     */
    public function index(int $page, EntityManagerInterface $em): Response
    {
        if ($page >= 1) {
            $nbPerPage = $this->getParameter('nbPerPage');
            $currentPath = 'article_index';

            $articles = $em->getRepository('App:Article')
                ->findOnlyPublishedWithPaging($page, $nbPerPage);

            $nbPage = intval(ceil(count($articles) / $nbPerPage));

            if ($page > $nbPage) {
                throw new NotFoundHttpException("La page $page n'existe pas");
            }

            return $this->render('article/index.html.twig',[
                'page' => $page,
                'nbPage' => $nbPage,
                'currentPath' => $currentPath,
                'articles' => $articles
            ]);
        } else {
            throw new NotFoundHttpException("La page $page n'existe pas");
        }

    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_index');
    }

    /**
     * @param int $nbArticles
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function recentArticlesAction($nbArticles = 3, EntityManagerInterface $em): Response
    {
        $themes = $em->getRepository(Theme::class)->findAllWithNbArticles();

        $nbArticlesTotal = 0;

        foreach ($themes as $theme) {
            $nbArticlesTotal += $theme['nbArticles'];
        }

        return $this->render('leftMenu.html.twig', [
            'nbArticlesTotal' => $nbArticlesTotal,
            'categories' => $themes
        ]);
    }

    /**
     * @Route("/theme/{id}/{page}",
     *     defaults={"page": 1, "id": 0},
     *     name="theme_article_index", methods={"GET"}
     *     )
     */
    public function indexByThemeAction(int $id, int $page, EntityManagerInterface $em): Response
    {
        if ($id == 0) {
            $id = $em->getRepository('App:Theme')->findOneBy([])->getId();
        }
        if ($id > 0) {
            $nbPerPage = $this->getParameter('nbPerPage');
            $currentPath = 'theme_article_index';

            $theme = $em->getRepository('App:Theme')->find($id);

            $articles = $em->getRepository('App:Article')->findOnlyPublishedByTheme($theme, $page, $nbPerPage);

            $nbPage = intval(ceil(count($articles) / $nbPerPage));

            $title = $theme->getName();

            return $this->render("article/list.html.twig",[
                'id' => $id,
                'title' => $title,
                'currentPath' => $currentPath,
                'page' => $page,
                'nbPage' => $nbPage,
                'articles' => $articles
            ]);
        } else {
            throw new NotFoundHttpException('Cette page n\'existe pas');
        }
    }
}
