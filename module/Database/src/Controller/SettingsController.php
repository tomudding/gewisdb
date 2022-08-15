<?php

namespace Database\Controller;

use Database\Form\EnrolmentSettings as EnrolmentSettingsForm;
use Database\Mapper\Setting as SettingMapper;
use Database\Model\Enums\SettingTypes;
use Database\Service\{
    InstallationFunction as InstallationFunctionService,
    MailingList as MailingListService,
};
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class SettingsController extends AbstractActionController
{
    public function __construct(
        private readonly EnrolmentSettingsForm $enrolmentSettingsForm,
        private readonly SettingMapper $settingMapper,
        private readonly InstallationFunctionService $installationFunctionService,
        private readonly MailingListService $mailingListService,
    ) {
    }

    /**
     * Index action.
     */
    public function indexAction(): ViewModel
    {
        return new ViewModel([]);
    }

    /**
     * Function action.
     */
    public function functionAction(): ViewModel
    {
        if ($this->getRequest()->isPost()) {
            $this->installationFunctionService->addFunction($this->getRequest()->getPost()->toArray());
        }

        return new ViewModel([
            'functions' => $this->installationFunctionService->getAllFunctions(),
            'form' => $this->installationFunctionService->getFunctionForm(),
        ]);
    }

    /**
     * Mailing list action
     */
    public function listAction(): ViewModel
    {
        if ($this->getRequest()->isPost()) {
            $this->mailingListService->addList($this->getRequest()->getPost()->toArray());
        }

        return new ViewModel([
            'lists' => $this->mailingListService->getAllLists(),
            'form' => $this->mailingListService->getListForm(),
        ]);
    }

    /**
     * List deletion action
     */
    public function deleteListAction(): Response|ViewModel
    {
        $name = $this->params()->fromRoute('name');

        if ($this->getRequest()->isPost()) {
            if ($this->mailingListService->delete($name, $this->getRequest()->getPost()->toArray())) {
                return new ViewModel([
                    'success' => true,
                    'name' => $name,
                ]);
            } else {
                // redirect back
                return $this->redirect()->toRoute('settings/default', [
                    'action' => 'list',
                ]);
            }
        }

        return new ViewModel([
            'form' => $this->mailingListService->getDeleteListForm(),
            'name' => $name,
        ]);
    }

    public function enrolmentAction(): ViewModel
    {
        $form = $this->enrolmentSettingsForm;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost()->toArray());

            if ($form->isValid()) {
                var_dump($form->getData());
            }
        }

        $form->get(SettingTypes::RequireIban->value)
            ->setChecked((int) $this->settingMapper->find(SettingTypes::RequireIban)?->getValue() ?: false);

        return new ViewModel([
            'form' => $form,
        ]);
    }
}
