<?php

namespace Database\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class DonorController extends AbstractActionController
{

    /**
     * Index action.
     */
    public function indexAction()
    {
        return new ViewModel(array());
    }

    /**
     * Register action.
     */
    public function registerAction()
    {
        $request = $this->getRequest();
        $service = $this->getDonorService();

        if ($request->isPost()) {
            $donor = $service->register($request->getPost());

            if (null !== $donor) {
                return $this->redirect()->toRoute('donor/show', array('id' => $donor->getId()));
            }
        }

        return new ViewModel(array(
            'form' => $this->getDonorService()->getDonorForm()
        ));
    }

    /**
     * Search action.
     *
     * Searches for donors.
     */
    public function searchAction()
    {
        $query = $this->params()->fromQuery('q');

        $service = $this->getDonorService();
        $res = $service->search($query);

        $res = array_map(function ($donor) {
            return $donor->toArray();
        }, $res);

        return new JsonModel(array(
            'json' => $res
        ));
    }

    /**
     * Show action.
     *
     * Shows donor information.
     */
    public function showAction()
    {
        $service = $this->getDonorService();

        return new ViewModel($service->getDonor($this->params()->fromRoute('id')));
    }


    /**
     * Get the member service.
     *
     * @return \Database\Service\Donor
     */
    public function getDonorService()
    {
        return $this->getServiceLocator()->get('database_service_donor');
    }
}
