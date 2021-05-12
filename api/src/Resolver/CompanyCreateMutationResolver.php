<?php

namespace App\Resolver;

use App\Entity\Company;
use Exception;

final class CompanyCreateMutationResolver extends CompanyBaseMutationResolver
{
    /**
     * @param Company $company
     * @param array $context
     * @return Company
     * @throws Exception
     */
    public function __invoke($company, array $context)
    {
        $args = $context['args']['input'];
dump($args);
        $company = $this->createOrUpdateCompany($args['company']);

        $companyPerson = $this->createOrUpdateCompanyPerson($args['companyMainContactPerson'], null);
        $this->entityManager->persist($companyPerson);
        $company->addCompanyPerson($companyPerson);

        $this->entityManager->persist($company);

        return $company;
    }
}
