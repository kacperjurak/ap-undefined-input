<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Resolver\CompanyCreateMutationResolver;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use GraphQL\Error\UserError;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"company:read", "organisation_aware:read", "timestamps:read", "disableable:read"}},
 *     denormalizationContext={"groups"={"company:write", "disableable:write"}},
 *     graphql={
 *         "item_query"={"normalization_context"={"groups"={"item_query", "organisation_aware:read", "timestamps:read", "disableable:read"}}},
 *         "collection_query"={"normalization_context"={"groups"={"collection_query", "organisation_aware:read", "timestamps:read", "disableable:read"}}},
 *         "create"={
 *             "mutation"=CompanyCreateMutationResolver::class,
 *             "deserialize"=true,
 *             "write"=true,
 *             "args"={
 *                 "company"={"type"="CompanyCreate!"},
 *                 "companyMainContactPerson"={"type"="CompanyMainContactPerson!"},
 *             },
 *             "normalization_context"={"groups"={"item_query", "organisation_aware:read", "timestamps:read", "disableable:read"}},
 *             "denormalization_context"={"groups"={"company:mutation", "disableable:write"}}
 *         },
 *     },
 *     attributes={
 *         "order"={"createdAt": "DESC"},
 *         "pagination_maximum_items_per_page"=10000,
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 */
class Company
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
     * @ORM\Column(type="string", length=255)
     * @Groups({"company:read", "company:write", "item_query", "collection_query", "company:mutation"})
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CompanyPerson", mappedBy="company")
     * @Groups({"company:read", "item_query", "collection_query"})
     */
    private Collection $companyPeople;

    /**
     * Company constructor.
     */
    public function __construct()
    {
        $this->companyPeople = new ArrayCollection();
    }

    /**
     * @ApiProperty()
     * @Groups({"company:read", "item_query", "collection_query"})
     *
     * @return CompanyPerson
     * @throws UserError
     */
    public function getMainContactPerson(): CompanyPerson
    {
        return $this->companyPeople->first();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return Collection|CompanyPerson[]
     */
    public function getCompanyPeople(): Collection
    {
        return $this->companyPeople;
    }

    public function addCompanyPerson(CompanyPerson $companyPerson): self
    {
        if (!$this->companyPeople->contains($companyPerson)) {
            $this->companyPeople[] = $companyPerson;
            $companyPerson->setCompany($this);
        }

        return $this;
    }

    public function removeCompanyPerson(CompanyPerson $companyPerson): self
    {
        if ($this->companyPeople->contains($companyPerson)) {
            $this->companyPeople->removeElement($companyPerson);
            // set the owning side to null (unless already changed)
            if ($companyPerson->getCompany() === $this) {
                $companyPerson->setCompany(null);
            }
        }

        return $this;
    }
}
