<?php

namespace App\Resolver;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\GraphQl\Resolver\MutationResolverInterface;
use App\Entity\Company;
use App\Entity\CompanyPerson;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class CompanyBaseMutationResolver implements MutationResolverInterface
{
    protected EntityManagerInterface $entityManager;
    protected IriConverterInterface $iriConverter;

    /**
     * CompanyCreateMutationResolver constructor.
     * @param EntityManagerInterface $entityManager
     * @param IriConverterInterface $iriConverter
     */
    public function __construct(EntityManagerInterface $entityManager, IriConverterInterface $iriConverter)
    {
        $this->entityManager = $entityManager;
        $this->iriConverter = $iriConverter;
    }

    /**
     * @param object|null $item
     * @param array $context
     * @return object|null
     */
    public function __invoke($item, array $context)
    {
        return $item;
    }

    /**
     * @param array $args
     * @return Company
     * @throws Exception
     */
    protected function createOrUpdateCompany(array $args): Company
    {
        if (isset($args['id'])) {
            /** @var Company $ent */
            $ent = $this->iriConverter->getItemFromIri($args['id'], ['fetch_data' => false]);
        } else {
            $ent = new Company();
        }

        $ent->setName($args['name']);
        return $ent;
    }

    /**
     * @param array $args
     * @param CompanyPerson|null $companyPerson
     * @return CompanyPerson
     */
    protected function createOrUpdateCompanyPerson(array $args, ?CompanyPerson $companyPerson): CompanyPerson
    {
        if ($companyPerson === null) {
            $ent = new CompanyPerson();
        } else {
            $ent = $companyPerson;
        }
        $ent->setEmail($args['email']);
        return $ent;
    }
}
