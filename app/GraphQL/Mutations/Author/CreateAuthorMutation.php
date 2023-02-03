<?php


namespace App\GraphQL\Mutations\Category;

use App\Models\Author;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreateAuthorMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createAuthor',
        'description' => 'Create an author'
    ];
    public  function type(): Type
    {
        return GraphQL::type('Author');
    }
    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }
    public function resolve($root, $args)
    {
        $author = new Author();
        $author->fill($args);
        $author->save();

        return $author;
    }
}
