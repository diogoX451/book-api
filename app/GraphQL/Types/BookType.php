<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

use Rebing\GraphQL\Support\Type as GraphQLType;

class BookType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Book',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of the book',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of book',
            ],
            'author' => [
                'type' => GraphQL::type('Author'),
                'description' => 'Relaciona o nome dos Autores com os Livros',
            ],
        ];
    }
}
