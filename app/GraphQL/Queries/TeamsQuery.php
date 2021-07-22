<?php
namespace App\GraphQL\Queries;

use Closure;
use App\Models\Team;;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class TeamsQuery extends Query
{
    protected $attributes = [
        'name' => 'teams',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Team'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id', 
                'type' => Type::int(),
            ],
            'user_id' => [
                'name' => 'user_id', 
                'type' => Type::int(),
            ],
            'seller_id' => [
                'name' => 'seller_id', 
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return Team::where('id' , $args['id'])->get();
        }

        if (isset($args['seller_id'])) {
            return Team::where('seller_id', $args['seller_id'])->first();
        }

        return Team::all();
    }
}