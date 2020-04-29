<?php

namespace Product;

use Application\Entity\Product;
use Doctrine\ORM\EntityManager;

class Report extends \TCPDF
{
    private $_product;
    private $_translate;
    private $_entityManager;

    public function __construct(Product $product, callable $translate, EntityManager $entityManager)
    {
        parent::__construct();
        $this->_product = $product;
        $this->_translate = $translate;
        $this->_entityManager = $entityManager;

        $this->SetSubject($this->_product->getName());
        $this->SetTitle($this->_product->getName());
        $this->SetPrintHeader(true);
        $this->SetPrintFooter(false);

        $this->SetMargins(20, 0);

        $this->AddPage();
        $this->SetFillColor(255, 255, 255);

        $this->startTitle();
        $this->Cell(90, 5, $this->_translate("Best before") . ":", 0, 0, 'L', true);
        $this->Cell(0, 5, $this->_translate("Plu") . ":", 0, 0, 'L', true);
        $this->startText();
        $this->Cell(90, 5, $this->_product->getBestBefore(), 0, 0, 'L', true);
        $this->Cell(0, 5, $this->_product->getPlu(), 0, 0, 'L', true);


        $this->startTitle();
        $this->Cell(90, 5, $this->_translate("Storage temperature") . ":", 0, 0, 'L', true);
        $this->startText();
        $this->Cell(90, 5, $this->_product->getStorageTemperature(), 0, 0, 'L', true);

        $this->startTitle();
        $this->Cell(0, 5, $this->_translate("Ingredients") . ":", 0, 0, 'L', true);
        $this->startText();
        $this->MultiCell(0, 5, $this->_product->getIngredients(), 0, 'L', false, 0);

        $this->startTitle();
        $this->Cell(0, 5, $this->_translate("Process") . ":", 0, 0, 'L', true);
        $this->startText();
        $this->MultiCell(0, 5, $this->_product->getProcess(), 0, 'L', false, 0);

        $this->startTitle();
        $this->Cell(0, 5, $this->_translate("Allergen") . ":", 0, 0, 'L', true);
        $allergen = $product->getAllAllergen($this->_entityManager);
        $this->startText();
        $i = 0;
        foreach ($allergen as $allergeen) {
            /* @var $allergeen \Application\Entity\Allergen */
            if ($i == 0) {
                $i++;

                $this->MultiCell(90, 5, $allergeen->getName(), 0, 'L', false, 0);
            } else {
                $i = 0;

                $this->MultiCell(0, 5, $allergeen->getName(), 0, 'L', false, 0);
                $this->ln();
            }
        }
    }

    // @codingStandardsIgnoreStart
    public function Header()
    {
        // @codingStandardsIgnoreEnd

        $this->setY(3);
        $this->SetFillColor(255, 255, 255);
        $this->MultiCell(
            170,
            0,
            "Keurslager Van Damme\r\nVilvoordsesteenweg 400\r\n1850 Grimbergen",
            0,
            'R'
        );

        $this->setY(23);
        $this->SetFillColor(0, 13, 89);
        $this->SetTextColor(255, 255, 255);
        $this->Image(getcwd() . "/public/img/logo.png", '', '', 0, 10);
        $this->SetX(28);
        $this->SetFont('helvetica', 'B', 22);
        $this->Cell(0, 10, "   " . $this->_product->getName(), 0, 0, 'L', true);

        $this->SetMargins(0, 35);
    }

    private function startText()
    {
        $this->SetFont('times', '', 10);
        $this->Ln();
    }

    private function startTitle()
    {
        $this->SetFont('helvetica', 'B', 20);
        $this->Ln();
    }

    private function _translate($word)
    {
        $translate = $this->_translate;
        return $translate($word);
    }
}
