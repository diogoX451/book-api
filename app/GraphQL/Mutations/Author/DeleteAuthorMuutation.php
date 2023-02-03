<?php


namespace App\GraphQL\Mutations\Category;

use App\Models\Author;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class DeleteAuthorMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteAuthor',
        'description' => 'Delete an author'
    ];
    public  function type(): Type
    {
        return GraphQL::type('Author');
    }
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
        ];
    }
    public function resolve($root, $args)
    {
        $author = Author::findOrFail($args['id']);
        return $author->delete() ? true : false;
    }
}
