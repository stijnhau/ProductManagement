<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Allergenen for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Order\Controller;

use Application\Entity\Order as ent;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class OrderController extends AbstractActionController
{
    private $entityManager;
    private $translate;

    /**
     * @param field_type $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param field_type $translate
     */
    public function setTranslate($translate)
    {
        $this->translate = $translate;
    }

    public function indexAction()
    {
        $data = $this->entityManager->getRepository('Application\Entity\Order')->findBy(array('isActive' => 1));

        return array(
            "data"  => $data,
        );
    }

    public function addAction()
    {
        $repository = $this->entityManager->getRepository('Application\Entity\Order');
        $id = (int)$this->params('id');
        $user = $repository->find($id);

        $builder    = new AnnotationBuilder();
        $entity = new ent();
        $form = $builder->createForm($entity) ;
        $form->setUseAsBaseFieldset(true);

        $form->remove("customer");
        $form->remove("dateCreated");

        $form->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'customer',
            'options' => [
                'object_manager' => $this->entityManager,
                'target_class'   => 'Application\Entity\Customer',
                'label_generator' => function ($targetEntity) {
                    return $targetEntity->getNameContact() . ' - ' . $targetEntity->getNameCompany();
                },
                'label'          => 'Customer',
            ],
            'find_method'    => [
                'name'   => 'findBy',
                'params' => [
                    'criteria' => ['is_active' => 1],

                    // Use key 'orderBy' if using ORM
                    //'orderBy'  => ['lastname' => 'ASC'],

                    // Use key 'sort' if using ODM
                    //'sort'  => ['lastname' => 'ASC'],
                ],
            ],
        ]);

        //         $this->add(array(
        //             'type' => 'Zend\Form\Element\Csrf',
        //             'name' => 'csrf'
        //         ));

        $form->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Save'
            )
        ));


        $form->setAttribute('method', 'post')
             ->setHydrator(new DoctrineHydrator($this->entityManager, 'Application\Entity\Order'));

        if (!is_null($user)) {
            $form->bind($user);
        } else {
            $form->bind($entity);
        }

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            if ($form->isValid()) {
                $this->layout('layout/none');

                $translate = $this->translate;
                if (is_null($user)) {
                    // New one
                    /** @todo  Check on unique name */
                    $this->entityManager->persist($entity);

                    $message = $translate("Order added");
                } else {
                    $message = $translate("Updated order");
                }
                $this->entityManager->flush();

                $viewModel = new ViewModel(
                    array(
                        'message' => $message,
                    )
                );
                $viewModel->setTemplate('application/message.phtml');
                return $viewModel;
            }
        }

        return array(
            "form"  => $form,
        );
    }

    public function deleteAction()
    {
        $repository = $this->entityManager->getRepository('Application\Entity\Order');
        $id = (int)$this->params('id');
        /* @var $user \Application\Entity\Order */
        $user = $repository->find($id);

        $this->layout('layout/none');

        $translate = $this->translate;
        if (is_null($user)) {
            $message = $translate("Invalid order");
        } else {
            $user->setIsActive(false);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $message = $translate("Order removed");
        }

        $viewModel = new ViewModel(
            array(
                'message' => $message,
            )
        );
        $viewModel->setTemplate('application/message.phtml');

        return $viewModel;
    }
}
