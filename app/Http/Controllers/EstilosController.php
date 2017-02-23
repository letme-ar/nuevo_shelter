<?php

namespace App\Http\Controllers;

use App\Shelter\Repositories\RepoEstilo;
use Illuminate\Http\Request;

class EstilosController extends Controller
{
    private $repoEstilo;

    public function __construct(RepoEstilo $repoEstilo)
    {
        $this->repoEstilo = $repoEstilo;
    }

    public function all()
    {
        return $this->repoEstilo->all();
    }
}
