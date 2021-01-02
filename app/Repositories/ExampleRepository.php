<?php
namespace App\Repositories;

use App\Models\Example;
use Illuminate\Database\Eloquent\Model;

class ExampleRepository extends BaseRepository
{
    public function __construct(Example $example)
    {
        parent::__construct($example);
    }
}