<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 30/11/15
 * Time: 14:33
 */

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\CategoryRepository;

class CategoryService extends AbstractService
{

    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }

}