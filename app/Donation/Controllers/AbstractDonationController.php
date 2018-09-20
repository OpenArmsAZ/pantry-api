<?php

namespace OpenArms\Pantry\Donation\Controllers;

use OpenArms\Pantry\Entities\Donation;
use OpenArms\Pantry\Entities\Product;
use OpenArms\Pantry\System\Controllers\AbstractController;
use OpenArms\Pantry\System\Factories\EntityManagerFactory;

abstract class AbstractDonationController extends AbstractController
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

    protected function getDonation(int $donation_id): Donation
    {
        $entityManager = EntityManagerFactory::getInstance();
        $donationRepository = $entityManager->getRepository(Donation::class);
        $donation = $donationRepository->find($donation_id);
        /**
         * @var Donation $donation
         */
        return $donation;
    }

    protected function saveDonation(Donation $donation): void
    {
        $entityManager = EntityManagerFactory::getInstance();
        $entityManager->persist($donation);
        $entityManager->flush();
    }

    protected function saveArrayDonation(array $input): void
    {
        $product = $this->getProduct($input['product']);
        $input['product'] = $product;
        $donation = new Donation($input);

        $product
            ->getInventoryLevel()
            ->addShareableQuantity(
                $donation->getShareableQuantity()
            );

        $this->saveDonation($donation);
    }
}
