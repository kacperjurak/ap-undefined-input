<?php

namespace App\Type\Definition;

use ApiPlatform\Core\GraphQl\Type\Definition\TypeInterface;
use GraphQL\Type\Definition\InputObjectType;

final class CompanyCreateType extends InputObjectType implements TypeInterface
{
    /**
     * CompanyCreateType constructor.
     */
    public function __construct()
    {
        $config = [
            // Note: 'name' is not needed in this form:
            // it will be inferred from class name by omitting namespace and dropping "Type" suffix
            'fields' => [
                'name' => [
                    'type' => self::nonNull(self::string())
                ],
            ]
        ];

        parent::__construct($config);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function serialize($value)
    {
        // TODO: Implement serialize() method.
    }

    /**
     * @inheritDoc
     */
    public function parseValue($value)
    {
        // TODO: Implement parseValue() method.
    }

    /**
     * @inheritDoc
     */
    public function parseLiteral($valueNode, ?array $variables = null)
    {
        // TODO: Implement parseLiteral() method.
    }
}
