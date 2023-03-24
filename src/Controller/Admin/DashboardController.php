<?php

namespace App\Controller\Admin;

use App\Entity\Mairie;
use App\Entity\Folder;
use App\Entity\Planning;
use App\Entity\CheckFolder;
use App\Entity\Reservation;
use App\Entity\Utilisateur;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private ChartBuilderInterface $chartBuilder,
    ) {
    }
    #[Route('/admin', name: 'admin')]
    public function admin(): Response
    {                
        // return parent::index();
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(MairieCrudController::class)->generateUrl();
        return $this->redirect($url);
        
    }
    // #[Route('/admin/crud', name: 'crud')]
    // public function home(): Response
    // {                
    //     $routeBuilder = $this->container->get(AdminUrlGenerator::class);
    //     $url = $routeBuilder->setController(MairieCrudController::class)->generateUrl();
    //     return $this->redirect($url);
    // }



    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mairie')
            ->setTitle('<style> img {width: 200px; height: 200px; border-radius: 50%;} h1 {text-align: center; font-size: 50px}</style><img src="https://media.licdn.com/dms/image/D4E03AQEoMcqI8ampBA/profile-displayphoto-shrink_800_800/0/1667511014405?e=1684368000&v=beta&t=blEW5UNXqy_ft4gcyNEe3uEH4eA9vaa5H2BaL0zfs2g"> <h1> Admin </h1>')
            ->setFaviconPath('favicon.ico');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Mairie', 'fas fa-list', Mairie::class);
        yield MenuItem::linkToCrud('Reservation', 'fas fa-list', Reservation::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', Utilisateur::class);
        yield MenuItem::linkToCrud('Planning', 'fas fa-list', Planning::class);
        
    }
}
