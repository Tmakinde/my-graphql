<?php
namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class CreateNewUser extends Mutation
{
    protected $attributes = [
        'name' => 'createNewUser'
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('User'));
    }

    public function args(): array
    {
        return [
            'password' => [
                'name' => 'password', 
                'type' => Type::nonNull(Type::string()),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
            ],
            'email' => [
                'name' => 'email', 
                'type' => Type::nonNull(Type::string()),
            ],
            'status' => [
                'name' => 'status',
                'type' => Type::nonNull(Type::string()),
            ]

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = new User;
        $user->name = $args['name'];
        $user->email = $args['email'];
        $user->password = bcrypt($args['password']);
        $user->save();

        return $user;
    }

}