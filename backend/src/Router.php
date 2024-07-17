<?php
// backend/src/Router.php

namespace App;

class Router
{
    public function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // Handle the root URL
        if ($uri === '/' || $uri === '') {
            return ['message' => 'Welcome to the eCommerce API!'];
        }

        // Handle GraphQL requests
        if ($uri === '/graphql' && $method === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            return $this->handleGraphQL($data);
        }

        // If no routes match, return a 404 error
        http_response_code(404);
        return ['error' => 'Not Found'];
    }

    private function handleGraphQL($data)
    {
        $schema = \App\GraphQL\Schema::buildSchema();
        $query = $data['query'] ?? '';
        $variables = $data['variables'] ?? null;

        $result = \GraphQL\GraphQL::executeQuery($schema, $query, null, null, $variables);
        $output = $result->toArray();

        return $output;
    }
}