<?php declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOne extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $note = $this->getOneNoteService()->getOne((int) $args['id']);

        return $this->jsonResponse($response, 'success', $note, 200);
    }
}
