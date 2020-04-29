<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Product for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Annotation\AnnotationBuilder;
use Application\Entity\Product as ent;
use Zend\View\Model\ViewModel;

class ProductController extends AbstractActionController
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
        $data = $this->entityManager->getRepository('Application\Entity\Product')->findBy(array('isActive' => 1));

        return array(
            "data"  => $data,
        );
    }

    public function addAction()
    {
        $repository = $this->entityManager->getRepository('Application\Entity\Product');
        $id = (int)$this->params('id');
        /* @var $user \Application\Entity\Product */
        $user = $repository->find($id);

        $builder    = new AnnotationBuilder();
        $entity     = new ent();
        $form       = $builder->createForm($entity);
        $form->setUseAsBaseFieldset(true);

        $repositoryLink = $this->entityManager->getRepository('Application\Entity\ProductAllergen');
        $link = $repositoryLink->findBy(
            array(
                "isActive"  => 1,
                "product"   => $user,
            )
        );
        $attributes = array();
        foreach ($link as $elem) {
            /* @var $elem \Application\Entity\ProductAllergen */
            $attributes[] = $elem->getAllergen()->getId();
        }

        $form->add(
            array(
                'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                'name' => 'option',
                'required' => false,
                'options' => array(
                    'disable_inarray_validator' => true, // <-- disable
                    'use_hidden_element' => true,
                    'label' => 'Allergens',
                    'object_manager' => $this->entityManager,
                    'target_class'   => 'Application\Entity\Allergen',
                    'property'       => 'name',
                    'find_method' => array(
                        'name'   => 'findBy',
                        'params' => array(
                            'criteria' => array('isActive' => 1),
                        ),
                    ),
                ),
                'attributes' => array(
                    'value' => $attributes, //set checked
                )
            )
        );

        $form->add(
            array(
                'name' => 'submit',
                'attributes' => array(
                    'type' => 'submit',
                    'value' => 'Save'
                ),
            )
        );

        $form->setAttribute('method', 'post')
             ->setHydrator(new DoctrineHydrator($this->entityManager, 'Application\Entity\Product'));

        if (!is_null($user)) {
            $form->bind($user);
        } else {
            $form->bind($entity);
        }

        if ($this->request->isPost()) {
            /* @var $data \Zend\Stdlib\Parameters */
            $data = $this->request->getPost();
            $data = $data->getArrayCopy();
            if (!isset($data['option']) or !is_array($data['option'])) {
                $data['option'] = array("0" => "0");
            }

            $this->layout('layout/none');

            $translate = $this->translate;

            $form->setData($data);
            if ($form->isValid()) {
                if (is_null($user)) {
                    // New one
                    /** @todo  Check on unique name */
                    $this->entityManager->persist($entity);
                    // some hack to always use $user
                    $user = $entity;

                    $message = $translate("Product added");
                } else {
                    $message = $translate("Updated product");
                }
                $this->entityManager->flush();

                $user->createAllergen($data['option'], $this->entityManager);

                $messageArr = array();
            } else {
                $message = $translate("Error: ");
                $messageArr = $form->getMessages();
            }
            $viewModel = new ViewModel(
                array(
                    'message' => $message,
                    'messageArr' => $messageArr
                )
            );
            $viewModel->setTemplate('application/message.phtml');
            return $viewModel;
        }

        return array(
            "form"  => $form,
        );
    }

    public function deleteAction()
    {
        $translate = $this->translate;

        $repository = $this->entityManager->getRepository('Application\Entity\Product');
        $id = (int)$this->params('id');
        /* @var $user \Application\Entity\Product */
        $user = $repository->find($id);

        $this->layout('layout/none');

        if (is_null($user)) {
            $message = $translate("Invalid product");
        } else {
            $user->setIsActive(false);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $message = $translate("Product removed");
        }

        $viewModel = new ViewModel(
            array(
                'message' => $message,
            )
        );
        $viewModel->setTemplate('application/message.phtml');

        return $viewModel;
    }

    public function specificationAction()
    {
        $translate = $this->translate;

        $repository = $this->entityManager->getRepository('Application\Entity\Product');
        $id = (int)$this->params('id');
        /* @var $product \Application\Entity\Product */
        $product = $repository->find($id);

        if (is_null($product)) {
            $message = $translate("Invalid product");

            $viewModel = new ViewModel(
                array(
                    'message' => $message,
                )
            );
            $viewModel->setTemplate('application/message.phtml');
        } else {
            $this->layout('layout/none');

            $pdf = new \Product\Report($product, $translate, $this->entityManager);
            $pdf->Output($product->getName());
        }
        return array();
    }
}
