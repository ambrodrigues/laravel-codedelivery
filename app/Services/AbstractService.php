<?php
/**
 *
 * Servico abstrato para que os demais services herdem suas caracteristicas
 *
 * Created by PhpStorm.
 * User: alessandro
 * Date: 29/11/15
 * Time: 21:54
 */

namespace CodeDelivery\Services;


use Prettus\Repository\Contracts\RepositoryInterface;

abstract class AbstractService
{

    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Método que irá criar um registro no banco de dados
     *
     * @param array $data
     */
    public function create(array $data){

        $this->repository->create($data);
    }


    /**
     * Método que irá atualizar um registro no banco de dados
     *
     * @param array $data
     * @param $id
     */
    public function update(array $data, $id){
        $this->repository->update($data,$id);
    }


    /**
     * Método que irá retornar os dados paginados para a view
     *
     * @return mixed
     */
    public function paginate(){
       return $this->repository->paginate();
    }

    /**
     * Método que buscará um registro no banco de dados
     *
     * @param $id
     * @return mixed
     */
    public function find($id){
        return $this->repository->find($id);
    }


    /**
     * Método para deletar um registro
     *
     * @param $id
     * @return int
     *
     */
    public function delete($id){
        return $this->repository->delete($id);
    }
}