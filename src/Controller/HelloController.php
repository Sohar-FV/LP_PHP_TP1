<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Console\Application;


class HelloController extends AbstractController 
{

    /**
     * @Route("/helloworld", name="helloworld")
     */
    public function helloworld()
    {
        return new Response(
            "<html><body>Hello World</body></html>"
        );
    }

    /**
     * @Route("/helloworld/{name}", name="helloworld_name")
     */
    public function helloworld_name(String $name)
    {
        return $this->render('helloworld.html.twig', [
            'name' => $name,
        ]);
    }

}

?>