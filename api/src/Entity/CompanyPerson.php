<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"company_person:read", "organisation_aware:read", "timestamps:read", "disableable:read"}},
 *     denormalizationContext={"groups"={"company_person:write", "disableable:write"}},
 *     graphql={
 *         "item_query"={"normalization_context"={"groups"={"item_query", "organisation_aware:read", "timestamps:read", "disableable:read"}}},
 *     },
 *     attributes={
 *         "order"={"createdAt": "DESC"},
 *         "pagination_maximum_items_per_page"=1000,
 *     }
 * )
 * @ApiFilter(OrderFilter::class, properties={"name", "createdAt"}, arguments={"orderParameterName"="order"})
 * @ORM\Entity(repositoryClass="App\Repository\CompanyPersonRepository")
 *
 */
class CompanyPerson
{
    /**
     * The entity ID
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"entity_id"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=180)
     * @Groups({"company_person:read", "company_person:write", "item_query", "collection_query", "company_person:mutation"})
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private string $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="companyPeople")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"company_person:read", "company_person:write", "item_query", "collection_query", "company_person:mutation"})
     */
    private ?Company $company = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }
}
