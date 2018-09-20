<?php

namespace OpenArms\Pantry\Product\Controllers;

use OpenArms\Pantry\Entities\Product;
use OpenArms\Pantry\System\Controllers\AbstractController;
use OpenArms\Pantry\System\Factories\EntityManagerFactory;

abstract class AbstractProductController extends AbstractController
{
    protected function getProduct(int $product_id): Product
    {
        $entityManager = EntityManagerFactory::getInstance();
        $productRepository = $entityManager->getRepository(Product::class);
        $product = $productRepository->find($product_id);
        /**
         * @var Product $product
         */
        return $product;
    }

    protected function saveProduct(Product $product): void
    {
        $entityManager = EntityManagerFactory::getInstance();
        $entityManager->persist($product);
        $entityManager->flush();
    }

    protected function saveArrayProduct(array $input): void
    {
        $product = new Product($input);
        $this->saveProduct($product);
    }
}
