<?php declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class Search extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $userId = (int) $input['decoded']->sub;
        $query = '';
        if (isset($args['query'])) {
            $query = $args['query'];
        }
        $status = $request->getParam('status', null);
        $tasks = $this->getTaskService()->search($query, $userId, $status);

        return $this->jsonResponse($response, 'success', $tasks, 200);
    }
}
