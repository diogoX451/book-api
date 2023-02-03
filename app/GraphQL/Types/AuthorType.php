<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

use Rebing\GraphQL\Support\Type as GraphQLType;

class AuthorType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Author',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of the author',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of author',
            ],
            'books' => [
                'type' => Type::listOf(GraphQL::type('Book')),
                'description' => 'Relaciona o nome dos Autores com os Livros',
            ],
        ];
    }
}
